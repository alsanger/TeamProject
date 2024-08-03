<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use App\Models\Role;
use App\Models\Status;
use App\Models\Knowledge;
use App\Models\UserPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    // Метод для отображения главной страницы
    public function home(): \Illuminate\View\View
    {
        $users = User::all(); // Получаем всех пользователей из базы данных
        $positions = Position::all();

        return view('home', compact('users', 'positions'));
    }

    // Метод для входа на страницу loginUser.blade.php через GET
    public function loginUserGet(): \Illuminate\View\View
    {
        return view('user.loginUser');
    }

    // Метод для авторизации со страницы loginUser.blade.php через POST
    public function loginUserPost(Request $request)
    {
        $credentials = $request->only('login', 'password');
        $user = User::where('login', $credentials['login'])->first();

        if ($user) {
            if (Auth::attempt($credentials)) {
                // Аутентификация успешна
                return redirect()->route('home');
            } else {
                // Пароль неверный
                return redirect()->route('user.loginUserGet')
                    ->withErrors([
                        'password' => 'Invalid password.',
                    ])
                    ->withInput();
            }
        } else {
            // Логин неверный
            return redirect()->route('user.loginUserGet')
                ->withErrors([
                    'login' => 'Invalid login credentials.',
                ])
                ->withInput();
        }
    }

    // Метод для выхода пользователя
    public function logoutUser(): \Illuminate\Http\RedirectResponse
    {
        Auth::logout();
        return redirect()->route('home');
    }

    // Метод для отображения формы регистрации пользователя
    public function createUserGet(): \Illuminate\View\View
    {
        $knowledges = Knowledge::all();
        return view('user.createUser', compact('knowledges'));
    }

    // Метод для регистрации нового пользователя
    public function createUserPost(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'login' => 'required|min:3|max:20|unique:users,login',
            'password' => 'required|min:6',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'image_link' => 'required',
            'knowledge_ids' => 'array',
        ]);

        // Создание нового пользователя
        $user = User::create([
            'login' => $request->input('login'),
            'password' => Hash::make($request->input('password')), // Хэшируем пароль
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'image_link' => $request->input('image_link'),
            'is_removed' => false,
        ]);

        if ($request->has('knowledge_ids')) {
            $user->knowledges()->sync($request->input('knowledge_ids'));
        }

        // Проверка, является ли это первый пользователь
        if (User::count() == 1) {
            $adminPosition = Position::firstOrCreate(
                ['name' => 'administrator'],
                ['department_id' => null, 'is_removed' => false]
            );

            $adminRole = Role::firstOrCreate(
                ['name' => 'administrator'],
                ['is_removed' => false]
            );

            $appointedStatus = Status::firstOrCreate(
                ['name' => 'appointed'],
                ['is_removed' => false]
            );

            $user->positions()->attach($adminPosition->id, ['status_id' => $appointedStatus->id]);

            $adminPosition->roles()->attach($adminRole->id);
        }

        Auth::attempt([
            'login' => $request->input('login'),
            'password' => $request->input('password')
        ]);

        return redirect()->route('home');
    }
    public function editUser(Request $request): \Illuminate\View\View
    {
        $userId = $request->input('user_id');
        $redirectUrl = $request->input('redirect_url', 'user.personalArea'); // URL по умолчанию если не указан

        // Проверяем, если передан user_id
        if ($userId) {
            // Если пользователь не администратор, проверяем, что редактируется его профиль
            if (!$this->isUserAdmin()) {
                if ($userId != Auth::id()) {
                    abort(403, 'Unauthorized action.');
                }
            }
            // Загружаем пользователя по ID
            $user = User::findOrFail($userId);
        } else {
            // Если user_id не передан, загружаем текущего авторизованного пользователя
            $user = Auth::user();
        }

        $knowledges = Knowledge::all();
        return view('user.editUser', compact('user', 'knowledges', 'redirectUrl'));
    }

    // Метод для обновления данных пользователя
    public function editUserPost(Request $request): \Illuminate\Http\RedirectResponse
    {
        $userId = $request->input('user_id');
        $user = User::findOrFail($userId);

        if ($user->id !== Auth::id() && !$this->isUserAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $request->validate([
            'login' => 'required|min:3|max:20|unique:users,login,' . $user->id,
            'password' => 'nullable|min:6|confirmed',
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone' => 'required|numeric',
            'image_link' => 'required',
            'knowledge_ids' => 'array',
        ]);

        $user->update([
            'login' => $request->input('login'),
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'image_link' => $request->input('image_link'),
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->input('password'))]);
        }

        if ($request->has('knowledge_ids')) {
            $user->knowledges()->sync($request->input('knowledge_ids'));
        }

        $redirectUrl = $request->input('redirect_url');
        return redirect($redirectUrl)->with('success', 'Profile updated successfully.');
    }
    private function isUserAdmin(): bool
    {
        $user = Auth::user();

        if (!$user) {
            return false;
        }

        // Получаем все позиции пользователя, связанные с ролью 'administrator'
        $adminPositions = $user->positions()
            ->whereHas('roles', function ($query) {
                $query->where('name', 'administrator');
            })
            ->get();

        // Проверяем, имеет ли хотя бы одна из позиций статус 'appointed'
        foreach ($adminPositions as $position) {
            $userPosition = UserPosition::where('user_id', $user->id)
                ->where('position_id', $position->id)
                ->whereHas('status', function ($query) {
                    $query->where('name', 'appointed');
                })
                ->first();

            if ($userPosition) {
                return true;
            }
        }

        return false;
    }

    public function personalArea(): \Illuminate\View\View
    {
        $positions = Position::where('is_vacancy', true)->get();
        return view('user.personalArea', compact('positions'));
    }
}
