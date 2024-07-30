<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Knowledge;
use App\Models\Position;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PositionController extends Controller
{
    public function workArea(): \Illuminate\View\View
    {
        $positions = Position::all();
        return view('position.workArea.administrator.administratorMain', compact('positions'));
    }
    public function redirectToPageBasedOnRole($id)
    {
        // Получаем пользователя с его позициями и ролями
        $user = User::with('positions.roles')->find($id);
        if (!$user) {
            return redirect()->route('home')->with('error', 'User not found');
        }
        // Собираем все роли пользователя
        $roles = $user->positions->flatMap(function ($position) {
            return $position->roles->pluck('name');
        })->unique();

        return redirect()->route('workArea.administrator');

        // Проверяем роли и перенаправляем пользователя
//        if ($roles->contains('administrator')) {
//            return redirect()->route('workArea.administrator');
//        } elseif ($roles->contains('manager')) {
//            return redirect()->route('manager.dashboard');
//        } elseif ($roles->contains('employee')) {
//            return redirect()->route('employee.dashboard');
//        } else {
//            return redirect()->route('home')->with('error', 'No valid role found for the user');
//        }
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

        return redirect()->route('position.createPositionGet');
    }
    public function createPositionGet(): \Illuminate\View\View
    {
        $departments = Department::all();
        return view('position.createPosition', compact('departments'));
    }

    public function createPositionPost(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'name' => 'required|min:2|max:50|unique:positions,name'
        ]);

        Position::create([
            'name' => $request->input('name'),
            'department_id' => $request->input('department_id'),
            'salary' => $request->input('salary'),
            'description' => $request->input('description'),
            'is_vacancy' => $request->has('isVacancy'),
            'is_removed' => false,
        ]);

        return redirect()->route('position.workArea');
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

        return redirect()->route('position.workArea');
    }
}
