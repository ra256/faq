@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>User Management</h1>
                <table class="table">
                    <tr>
                        <td>ID</td>
                        <td>Email</td>
                        <td>Lock</td>
                        <td>Delete</td>
                    </tr>
                    @forelse($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            @if ($user->locked == 0)
                                <a class="btn btn-warning" href="admin/lock/{{$user->id}}">Lock</a>
                            @else
                                <a class="btn btn-primary" href="admin/unlock/{{$user->id}}">Unlock</a>
                            @endif
                        </td>
                        <td><a class="btn btn-danger" href="admin/delete/{{$user->id}}">Delete</a></td>
                    </tr>
                    @empty
                        <tr><td colspan="4">There aren't any questions to view, you can  create a question.</td></tr>
                    @endforelse
                </table>

            </div>
        </div>
@endsection