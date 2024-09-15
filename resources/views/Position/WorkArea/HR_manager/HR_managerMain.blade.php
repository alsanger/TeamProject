{{--@extends('layout')--}}

{{--@section('content')--}}

{{--    @auth--}}
{{--        @if($roles->contains(function ($role) {--}}
{{--        return in_array($role, ['administrator', 'HR_manager']);--}}
{{--    }))--}}
{{--            <div class="user-info">--}}

{{--                <h2>ALL SEEKER AND CANDIDATES:</h2>--}}
{{--                <table class="table table-striped">--}}
{{--                    <thead>--}}
{{--                    <tr>--}}
{{--                        <th>ID</th>--}}
{{--                        <th>Login</th>--}}
{{--                        <th>First Name</th>--}}
{{--                        <th>Last Name</th>--}}
{{--                        <th>Email</th>--}}
{{--                        <th>Phone</th>--}}
{{--                        <th>Image Link</th>--}}
{{--                        <th>Knowledges</th>--}}
{{--                        <th>Resume</th> <!-- Добавление колонки Resume -->--}}
{{--                        <th>Position</th>--}}
{{--                        <th>Status</th>--}}
{{--                        <th></th>--}}
{{--                        <th></th>--}}
{{--                    </tr>--}}
{{--                    </thead>--}}
{{--                    <tbody>--}}
{{--                    @foreach($users as $user)--}}
{{--                        <tr>--}}
{{--                            <td>{{ $user->user_id }}</td>--}}
{{--                            <td>{{ $user->login }}</td>--}}
{{--                            <td>{{ $user->first_name }}</td>--}}
{{--                            <td>{{ $user->last_name }}</td>--}}
{{--                            <td>{{ $user->email }}</td>--}}
{{--                            <td>{{ $user->phone }}</td>--}}
{{--                            <td>{{ $user->image_link }}</td>--}}
{{--                            <td>{!! nl2br(e($user->knowledges)) !!}</td>--}}
{{--                            <td>{{ $user->resume }}</td> <!-- Отображение колонки Resume -->--}}
{{--                            <td>--}}
{{--                                {{ $user->position_name }}--}}
{{--                                @if(!is_null($user->department_name))--}}
{{--                                    (Department: {{ $user->department_name }})--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                            <td>{{ $user->status_name }}</td>--}}
{{--                            <td>--}}
{{--                                @if($user->status_name == 'seeker')--}}
{{--                                    <form method="post" action="{{ route('position.candidateStatusSet') }}" style="display:inline;">--}}
{{--                                        @csrf--}}
{{--                                        <input type="hidden" name="user_id" value="{{ $user->user_id  }}" />--}}
{{--                                        <input type="hidden" name="position_id" value="{{ $user->position_id  }}" />--}}
{{--                                        <button type="submit" class="btn btn-warning">Set candidate status</button>--}}
{{--                                    </form>--}}
{{--                                @elseif($user->status_name == 'candidate')--}}
{{--                                    <form method="POST" action="{{ route('position.goToChat') }}" style="display:inline;">--}}
{{--                                        @csrf--}}
{{--                                        <input type="hidden" name="user_id" value="{{ $user->user_id }}">--}}
{{--                                        <input type="hidden" name="position_id" value="{{ $user->position_id }}">--}}
{{--                                        <button type="submit" class="btn btn-info btn-sm">Go to chat</button>--}}
{{--                                    </form>--}}
{{--                                @endif--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <form method="POST" action="{{ route('position.appointStatusSet') }}" style="display:inline;">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" name="user_id" value="{{ $user->user_id }}">--}}
{{--                                    <input type="hidden" name="position_id" value="{{ $user->position_id }}">--}}
{{--                                    <button type="submit" class="btn btn-info btn-sm">Appoint</button>--}}
{{--                                </form>--}}
{{--                            </td>--}}
{{--                            <td>--}}
{{--                                <form method="POST" action="{{ route('position.rejectStatusSet') }}" style="display:inline;">--}}
{{--                                    @csrf--}}
{{--                                    <input type="hidden" name="user_id" value="{{ $user->user_id }}">--}}
{{--                                    <input type="hidden" name="position_id" value="{{ $user->position_id }}">--}}
{{--                                    <button type="submit" class="btn btn-info btn-sm">Reject</button>--}}
{{--                                </form>--}}
{{--                            </td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                    </tbody>--}}
{{--                </table>--}}
{{--            </div>--}}
{{--        @else--}}
{{--            <div class="actions">--}}
{{--                <p>You do not have access rights to this page</p>--}}
{{--                <a href="{{ route('user.loginUserGet') }}" class="btn btn-primary">Login</a>--}}
{{--            </div>--}}
{{--        @endif--}}
{{--    @endauth--}}
{{--@endsection--}}


@extends('layout')

@section('content')

    @auth
        @if($roles->contains(function ($role) {
            return in_array($role, ['administrator', 'HR_manager']);
        }))
            <div class="personal-area-container">
                <h2 class="section-title">ALL SEEKER AND CANDIDATES:</h2>
                <table class="vacancies-table">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Login</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Image Link</th>
                        <th>Knowledges</th>
                        <th>Resume</th>
                        <th>Position</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->user_id }}</td>
                            <td>{{ $user->login }}</td>
                            <td>{{ $user->first_name }}</td>
                            <td>{{ $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->image_link }}</td>
                            <td>{!! nl2br(e($user->knowledges)) !!}</td>
                            <td>{{ $user->resume }}</td>
                            <td>
                                {{ $user->position_name }}
                                @if(!is_null($user->department_name))
                                    (Department: {{ $user->department_name }})
                                @endif
                            </td>
                            <td>{{ $user->status_name }}</td>
                            <td class="actions">
                                @if($user->status_name == 'seeker')
                                    <form method="post" action="{{ route('position.candidateStatusSet') }}" class="form-inline">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->user_id }}" />
                                        <input type="hidden" name="position_id" value="{{ $user->position_id }}" />
                                        <button type="submit" class="btn btn-primary btn-hr">Set candidate status</button>
                                    </form>
                                @elseif($user->status_name == 'candidate')
                                    <form method="POST" action="{{ route('position.goToChat') }}" class="form-inline">
                                        @csrf
                                        <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                        <input type="hidden" name="position_id" value="{{ $user->position_id }}">
                                        <button type="submit" class="btn btn-primary btn-hr">Go to chat</button>
                                    </form>
                                @endif

                                <form method="POST" action="{{ route('position.appointStatusSet') }}" class="form-inline">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                    <input type="hidden" name="position_id" value="{{ $user->position_id }}">
                                    <button type="submit" class="btn btn-primary btn-hr">Appoint</button>
                                </form>

                                <form method="POST" action="{{ route('position.rejectStatusSet') }}" class="form-inline">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ $user->user_id }}">
                                    <input type="hidden" name="position_id" value="{{ $user->position_id }}">
                                    <button type="submit" class="btn btn-primary btn-hr">Reject</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="actions">
                <p>You do not have access rights to this page</p>
                <a href="{{ route('user.loginUserGet') }}" class="btn btn-primary">Login</a>
            </div>
        @endif
    @endauth
@endsection

