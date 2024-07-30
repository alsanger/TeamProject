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
use Illuminate\Support\Facades\DB;

class WorkAreaController extends Controller
{
    public function administrator(): \Illuminate\View\View
    {
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
                'positions.name',
                'statuses.name',
                'departments.name',
                'position_roles.roles'
            )
            ->get();
//        $roles = DB::table('users')
//            ->join('user_positions', 'users.id', '=', 'user_positions.user_id')
//            ->join('positions', 'user_positions.position_id', '=', 'positions.id')
//            ->join('position_roles', 'positions.id', '=', 'position_roles.position_id')
//            ->join('roles', 'position_roles.role_id', '=', 'roles.id')
//            ->where('users.id', $user->id)
//            ->pluck('roles.name')
//            ->toArray();

//        if ($user->roles->contains('name', 'administrator'))

        return view('position.workArea.administrator.administratorMain', compact('users'));
    }


    public function administratorUpdateUser(Request $request)
    {
        dd($request);
        $request->validate([
            'login' => 'required|min:3|max:20|unique:users,login,' . $id,
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|numeric',
            'image_link' => 'required',
            'position_id' => 'required|exists:positions,id',
            'salary' => 'required|numeric|min:0',
            'position_description' => 'required',
            'department_id' => 'required|exists:departments,id',
            'role_id' => 'required|exists:roles,id',
            'knowledge_ids' => 'required|array',
            'status_id' => 'required|exists:statuses,id'
        ]);

        $user = User::findOrFail($id);
        $user->update($request->only(['login', 'first_name', 'last_name', 'email', 'phone', 'image_link']));

        $position = Position::find($request->input('position_id'));
        $position->update([
            'salary' => $request->input('salary'),
            'description' => $request->input('position_description')
        ]);

        $department = Department::find($request->input('department_id'));
        $position->department()->associate($department)->save();

        $role = Role::find($request->input('role_id'));
        $position->roles()->sync([$role->id]);

        $user->knowledges()->sync($request->input('knowledge_ids'));

        $userPosition = UserPosition::where('user_id', $user->id)
            ->where('position_id', $position->id)
            ->first();

        if ($userPosition) {
            $userPosition->update(['status_id' => $request->input('status_id')]);
        }

        return redirect()->route('admin.workArea')->with('success', 'User updated successfully');
    }
}
