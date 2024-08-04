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

        UserPosition::updateOrCreate(
            ['user_id' => $user->id, 'position_id' => $positionId],
            ['status_id' => $candidateStatus->id,]
        );

        return redirect()->route('workArea.HR_manager');
    }
    public function appointStatusSet(Request $request): \Illuminate\Http\RedirectResponse
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);

        $positionId = $request->input('position_id');

        $appointStatus = Status::where('name', 'appointed')->first();

        if (!$appointStatus) {
            $appointStatus = Status::create(['name' => 'appointed']);
        }

        UserPosition::updateOrCreate(
            ['user_id' => $user->id, 'position_id' => $positionId],
            ['status_id' => $appointStatus->id,]
        );

        Position::updateOrCreate(
            ['id' => $positionId],
            ['is_vacancy' => false]
        );

        return redirect()->route('workArea.HR_manager');
    }
    public function rejectStatusSet(Request $request): \Illuminate\Http\RedirectResponse
    {
        $userId = $request->input('user_id');
        $user = User::find($userId);

        $positionId = $request->input('position_id');

        $rejectStatus = Status::where('name', 'rejected')->first();

        if (!$rejectStatus) {
            $rejectStatus = Status::create(['name' => 'rejected']);
        }

        UserPosition::updateOrCreate(
            ['user_id' => $user->id, 'position_id' => $positionId],
            ['status_id' => $rejectStatus->id,]
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

        $appointedStatus = Status::where('name', 'appointed')->first();
        $roles = $user->positions()
            ->where('status_id', $appointedStatus->id)
            ->with('roles')
            ->get()
            ->pluck('roles.*.name')
            ->flatten()
            ->unique();

        if ($roles->count() > 1) {
            return redirect()->route('workArea.manyRoles');
        }

        if ($roles->contains('administrator')) {
            return redirect()->route('workArea.administrator');
        } elseif ($roles->contains('HR_manager')) {
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
    public function editPosition(Request $request)
    {
        $positionId = $request->input('position_id');

        if (!$this->isUserAdmin()) {
            abort(403, 'Unauthorized action.');
        }

        $position = Position::findOrFail($positionId);

        $departments = Department::all();
        $roles = Role::all();

        return view('position.editPosition', compact('position', 'departments', 'roles'));
    }
    public function editPositionPost(Request $request): \Illuminate\Http\RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'department_id' => 'nullable|exists:departments,id',
            'salary' => 'nullable|regex:/^\d+(\.\d{1,2})?$/',
            'description' => 'nullable|string',
            'is_vacancy' => 'required|boolean',
            'roles' => 'nullable|array',
            'roles.*' => 'exists:roles,id',
        ]);

        $position = Position::findOrFail($request->input('position_id'));
        $previousIsVacancy = $position->is_vacancy;

        $position->update([
            'name' => $validated['name'],
            'department_id' => $validated['department_id'] ?: null,
            'salary' => $validated['salary'] ?: null,
            'description' => $validated['description'] ?: null,
            'is_vacancy' => $validated['is_vacancy'],
        ]);

        // Обработка ролей
        $position->roles()->sync($request->input('roles', [])); // Обновление связанных ролей

        // Если is_vacancy изменилось на 1, обновить status_id в user_positions
        if ($previousIsVacancy != $validated['is_vacancy'] && $validated['is_vacancy'] == 1) {
            $statusCandidate = Status::where('name', 'candidate')->first();

            if ($statusCandidate) {
                UserPosition::where('position_id', $position->id)
                    ->update(['status_id' => $statusCandidate->id]);
            }
        }

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
}
