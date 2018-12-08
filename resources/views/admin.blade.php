@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (Auth::user()->permission==2)
                    <span class="badge badge-info">Welcome Admin</span>
                @elseif (Auth::user()->permission==1)
                    <span class="badge badge-info">Welcome Super Admin</span>
                @endif
                <h1>User Management</h1>
                <table class="table">
                    <tr>
                        <td>ID</td>
                        <td>Email</td>
                        @if (Auth::user()->permission==1)
                            <td>Admin Privilege</td>
                        @endif
                        <td>Lock</td>
                        <td>Delete</td>
                    </tr>
                    @forelse($users as $user)
                        @if (Auth::user()->id==$user->id)
                            @continue
                        @endif
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->email}}</td>
                        @if (Auth::user()->permission==1)
                            <td>
                                @if ($user->permission == 0)
                                    <a class="btn btn-success" href="{{ route('admin.promote', ['user_id' => $user->id]) }}">Promote To Admin</a>
                                @elseif($user->permission == 2)
                                    <a class="btn btn-primary" href="{{ route('admin.demote', ['user_id' => $user->id]) }}">Demote To User</a>
                                @endif
                            </td>
                        @endif
                        <td>
                            @if ($user->locked == 0)
                                <a class="btn btn-warning" href="{{ route('admin.lockuser', ['user_id' => $user->id]) }}">Lock</a>
                            @else
                                <a class="btn btn-primary" href="{{ route('admin.unlockuser', ['user_id' => $user->id]) }}">Unlock</a>
                            @endif
                        </td>
                        <td><a class="btn btn-danger" href="{{ route('admin.deleteuser', ['user_id' => $user->id]) }}">Delete</a></td>
                    </tr>
                    @empty
                        <tr><td colspan="4">There aren't any questions to view, you can  create a question.</td></tr>
                    @endforelse
                </table>

            </div>
        </div>
@endsection