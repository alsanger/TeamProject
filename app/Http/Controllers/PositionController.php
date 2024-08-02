<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Knowledge;
use App\Models\Position;
use App\Models\Role;
use App\Models\Status;
use App\Models\User;
use App\Models\UserPosition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PositionController extends Controller
{
//    public function workArea(): \Illuminate\View\View
//    {
//        $positions = Position::all();
//        return view('position.workArea.administrator.administratorMain', compact('positions'));
//    }
//    public function redirectToPageBasedOnRole($id)
//    {
//        // Получаем пользователя с его позициями и ролями
//        $user = User::with('positions.roles')->find($id);
//        if (!$user) {
//            return redirect()->route('home')->with('error', 'User not found');
//        }
//        // Собираем все роли пользователя
//        $roles = $user->positions->flatMap(function ($position) {
//            return $position->roles->pluck('name');
//        })->unique();
//
//        return redirect()->route('workArea.administrator');
//    }
    public function showPositionDetailsGet($position_id): \Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
    {
        $user = Auth::user();
        $position = Position::findOrFail($position_id);

        // Найдите статус для данного пользователя и должности
        $userPosition = DB::table('user_positions')
            ->where('user_id', $user->id)
            ->where('position_id', $position_id)
            ->first();

        // Если запись найдена, получите статус
        $status = null;
        if ($userPosition) {
            $status = DB::table('statuses')
                ->where('id', $userPosition->status_id)
                ->value('name');
        }

        return view('position.positionDetails', compact('position', 'status'));
    }
    public function seekerStatusSet(Request $request): \Illuminate\Http\RedirectResponse
    {
        $user = Auth::user();
        $positionId = $request->input('position_id');
        $resume = $request->input('resume');
        // Проверьте, существует ли статус "seeker"
        $seekerStatus = Status::where('name', 'seeker')->first();

        if (!$seekerStatus) {
            $seekerStatus = Status::create(['name' => 'seeker']);
        }

        // Используйте модель для записи данных
        UserPosition::updateOrCreate(
            ['user_id' => $user->id, 'position_id' => $positionId],
            [
                'status_id' => $seekerStatus->id,
                'resume' => $resume
            ]
        );

        return redirect()->route('position.showDetails', ['id' => $positionId]);
    }
    public function candidateStatusSet(Request $request): \Illuminate\Http\RedirectResponse
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);

        $positionId = $request->input('position_id');

        $candidateStatus = Status::where('name', 'candidate')->first();

        if (!$candidateStatus) {
            $candidateStatus = Status::create(['name' => 'candidate']);
        }

        // Используйте модель для записи данных
        UserPosition::updateOrCreate(
            ['user_id' => $user->id, 'position_id' => $positionId],
            ['status_id' => $candidateStatus->id,]
        );

        return redirect()->route('workArea.HR_manager');
    }
    public function goToChat(Request $request): \Illuminate\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse
    {
        //$user = Auth::user();
        $userId = $request->input('user_id');
        $positionId = $request->input('position_id');

        $user = DB::table('users')->where('id', $userId)->first();
        $position = DB::table('positions')->where('id', $positionId)->first();

        if (!$position) {
            return redirect()->route('position.showDetails')->with('error', 'Position not found.');
        }

        // Получаем запись из таблицы user_positions
        $userPosition = DB::table('user_positions')
            ->where('user_id', $user->id)
            ->where('position_id', $positionId)
            ->first();

        if (!$userPosition) {
            return redirect()->route('position.showDetails')->with('error', 'User position not found.');
        }

        // Передаем данные в представление с использованием compact
        return view('position.candidateChatShow', compact('userPosition', 'position'));
    }
    public function redirectToPageBasedOnRole()
    {
        $user = Auth::user();
        $roles = $user->positions()->with('roles')->get()->pluck('roles.*.name')->flatten()->unique();
        if ($roles->count() > 1)
            return redirect()->route('workArea.manyRoles');

        if ($roles->contains('administrator')) {
            return redirect()->route('workArea.administrator');
        } elseif ($roles->contains('manager')) {
            return redirect()->route('workArea.HR_manager');
        } elseif ($roles->contains('CEO')) {
            return redirect()->route('workArea.CEO');
        } else {
            return redirect()->route('home')->with('error', 'No valid role found for the user');
        }
    }
    public function createDepartmentGet(): \Illuminate\View\View
    {
        return view('position.createDepartment');
    }
    public function createDepartmentPost(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:2|max:50|unique:departments,name'
        ]);

        Department::create([
            'name' => $request->input('name'),
            'is_removed' => false, // Пример значения по умолчанию
        ]);

        return redirect()->route('position.redirectToPageBasedOnRole');
    }
    public function createPositionGet(): \Illuminate\View\View
    {
        $departments = Department::all();
        return view('position.createPosition', compact('departments'));
    }
    public function createPositionPost(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:2|max:50|unique:positions,name',
            'department_id' => 'nullable|exists:departments,id', // Делаем поле необязательным
            'salary' => 'nullable|regex:/^\d+(\.\d{1,2})?$/|min:0',
            'description' => 'nullable|string|max:255',
        ]);

        Position::create([
            'name' => $request->input('name'),
            'department_id' => $request->input('department_id') ?: null,
            'salary' => $request->input('salary'),
            'description' => $request->input('description'),
            'is_vacancy' => $request->has('isVacancy'),
            'is_removed' => false,
        ]);

        return redirect()->route('position.redirectToPageBasedOnRole');
    }
    public function createRoleGet(): \Illuminate\View\View
    {
        $roles = Role::all();
        return view('position.createRole', compact('roles'));
    }
    public function createRolePost(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:2|max:50|unique:roles,name'
        ]);

        Role::create([
            'name' => $request->input('name'),
            'is_removed' => false,
        ]);

        return redirect()->route('position.redirectToPageBasedOnRole');
    }
    public function createKnowledgeGet(): \Illuminate\View\View
    {
        $knowledges = Knowledge::all();
        return view('position.createKnowledge', compact('knowledges'));
    }
    public function createKnowledgePost(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:2|max:50|unique:positions,name'
        ]);

        Knowledge::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'is_removed' => false,
        ]);

        return redirect()->route('position.redirectToPageBasedOnRole');
    }

}
