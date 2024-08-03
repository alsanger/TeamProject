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

class WorkAreaController extends Controller
{
    public function manyRoles(): \Illuminate\View\View
    {
        $user = Auth::user();
        $roles = $user->positions()->wherePivot('status_id', Status::where('name', 'appointed')->first()->id)
            ->get()
            ->flatMap->roles
            ->pluck('name')
            ->unique();

        return view('position.workArea.manyRoles.manyRolesMain', compact('roles'));
    }
    public function administrator(): \Illuminate\View\View
    {
        $user = Auth::user();
        $roles = $user->positions()->with('roles')->get()->pluck('roles.*.name')->flatten()->unique();

        $users = DB::table('users')
            ->leftJoin('user_positions', 'users.id', '=', 'user_positions.user_id')
            ->leftJoin('positions', 'user_positions.position_id', '=', 'positions.id')
            ->leftJoin('statuses', 'user_positions.status_id', '=', 'statuses.id')
            ->leftJoin('departments', 'positions.department_id', '=', 'departments.id')
            ->leftJoin(
                DB::raw('(
                SELECT user_knowledges.user_id, GROUP_CONCAT(knowledges.name SEPARATOR "\n") as knowledges
                FROM user_knowledges
                LEFT JOIN knowledges ON user_knowledges.knowledge_id = knowledges.id
                GROUP BY user_knowledges.user_id
            ) as user_knowledges'),
                'users.id',
                '=',
                'user_knowledges.user_id'
            )
            ->leftJoin(
                DB::raw('(
                SELECT position_roles.position_id, GROUP_CONCAT(roles.name SEPARATOR "\n") as roles
                FROM position_roles
                LEFT JOIN roles ON position_roles.role_id = roles.id
                GROUP BY position_roles.position_id
            ) as position_roles'),
                'user_positions.position_id',
                '=',
                'position_roles.position_id'
            )
            ->select(
                'users.id as user_id',
                'users.login',
                'users.first_name',
                'users.last_name',
                'users.email',
                'users.phone',
                'users.image_link',
                'user_knowledges.knowledges',
                'positions.id as position_id',
                'positions.name as position_name',
                'statuses.name as status_name',
                'departments.name as department_name',
                'position_roles.roles'
            )
            ->groupBy(
                'users.id',
                'users.login',
                'users.first_name',
                'users.last_name',
                'users.email',
                'users.phone',
                'users.image_link',
                'user_knowledges.knowledges',
                'positions.id',
                'positions.name',
                'statuses.name',
                'departments.name',
                'position_roles.roles'
            )
            ->get();

        $positions = Position::with('department', 'roles')->get()->map(function ($position) {
            $position->roles_list = $position->roles->pluck('name')->implode("\n");
            return $position;
        });

        return view('position.workArea.administrator.administratorMain', compact('users', 'positions', 'roles'));
    }
//    public function administratorUpdateUser($user_id)
//    {
//        $user = User::findOrFail($user_id);
//        $positions = Position::all();
//        $statuses = Status::all();
//        $knowledges = Knowledge::all();
//
//        return view('position.workArea.administrator.editUser', compact('user', 'positions', 'statuses', 'knowledges'));
//    }

    public function HR_manager(): \Illuminate\View\View
    {
        $user = Auth::user();
        $roles = $user->positions()->with('roles')->get()->pluck('roles.*.name')->flatten()->unique();

        $statuses = ['seeker', 'candidate'];
        $users = DB::table('users')
            ->leftJoin('user_positions', 'users.id', '=', 'user_positions.user_id')
            ->leftJoin('positions', 'user_positions.position_id', '=', 'positions.id')
            ->leftJoin('statuses', 'user_positions.status_id', '=', 'statuses.id')
            ->leftJoin('departments', 'positions.department_id', '=', 'departments.id')
            ->leftJoin(
                DB::raw('(
                SELECT user_knowledges.user_id, GROUP_CONCAT(knowledges.name SEPARATOR "\n") as knowledges
                FROM user_knowledges
                LEFT JOIN knowledges ON user_knowledges.knowledge_id = knowledges.id
                GROUP BY user_knowledges.user_id
            ) as user_knowledges'),
                'users.id',
                '=',
                'user_knowledges.user_id'
            )
            ->leftJoin(
                DB::raw('(
                SELECT position_roles.position_id, GROUP_CONCAT(roles.name SEPARATOR "\n") as roles
                FROM position_roles
                LEFT JOIN roles ON position_roles.role_id = roles.id
                GROUP BY position_roles.position_id
            ) as position_roles'),
                'user_positions.position_id',
                '=',
                'position_roles.position_id'
            )
            ->select(
                'users.id as user_id',
                'users.login',
                'users.first_name',
                'users.last_name',
                'users.email',
                'users.phone',
                'users.image_link',
                'user_knowledges.knowledges',
                'positions.id as position_id',
                'positions.name as position_name',
                'statuses.name as status_name',
                'departments.name as department_name',
                'position_roles.roles'
            )
            ->whereIn('statuses.name', $statuses)
            ->groupBy(
                'users.id',
                'users.login',
                'users.first_name',
                'users.last_name',
                'users.email',
                'users.phone',
                'users.image_link',
                'user_knowledges.knowledges',
                'positions.id',
                'positions.name',
                'statuses.name',
                'departments.name',
                'position_roles.roles'
            )
            ->get();

        $positions = Position::with('department', 'roles')->get()->map(function ($position) {
            $position->roles_list = $position->roles->pluck('name')->implode("\n");
            return $position;
        });

        return view('position.workArea.HR_manager.HR_managerMain', compact('users', 'positions', 'roles'));
    }
    public function CEO(): \Illuminate\View\View
    {
        $user = Auth::user();
        $roles = $user->positions()->with('roles')->get()->pluck('roles.*.name')->flatten()->unique();

        return view('position.workArea.CEO.CEO_main', compact('roles'));
    }
}
