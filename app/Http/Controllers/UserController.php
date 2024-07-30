<?php

namespace App\Http\Controllers;

use App\Models\Position;
use App\Models\User;
use App\Models\Role;
use App\Models\Status;
use App\Models\Knowledge;
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
    public function personalArea(): \Illuminate\View\View
    {
        $positions = Position::all();
        return view('user.personalArea', compact('positions'));
    }
}
