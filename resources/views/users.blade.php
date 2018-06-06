@extends('layouts.app')

@section('content')

<div class="row" style="margin-top: 20px;">
    <div class="col-lg-12">
        <div class="flash-message">
            @foreach (['danger', 'warning', 'success', 'info'] as $msg)
                @if(Session::has('alert-' . $msg))

                <p class="alert alert-{{ $msg }}">{{ Session::get('alert-' . $msg) }} <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a></p>
                @endif
            @endforeach
            
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Add User</h3>
            </div>
            <div class="panel-body">
                <form action="{{ url('/addUser') }}" method="POST" class="form-horizontal">
                    <div class="form-group">
                        <label for="inputPlace" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                        <input name="name" value="{{ old('name') }}" type="text" class="form-control" id="inputPlace" placeholder="Enter user's name">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputType" class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                        <input name="email" value="{{ old('email') }}" type="email" class="form-control" id="inputType" placeholder="Enter user's email">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="InputLat" class="col-sm-2 control-label">Password</label>
                        <div class="col-sm-10">
                        <input name="password" value="{{ old('password') }}" type="password" class="form-control" id="InputLat" placeholder="Enter a password">
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="inputDescription" class="col-sm-2 control-label">User Role</label>
                        <div class="col-sm-10">
                            <label class="radio-inline">
                                <input type="radio" name="role" id="inlineRadio1" value="admin"> Admin
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="role" id="inlineRadio2" value="manager"> Manager
                            </label>
                            <label class="radio-inline">
                                <input type="radio" name="role" id="inlineRadio3" value="reporter"> Reporter
                            </label>
                        </div>
                    </div>

                     {{ csrf_field() }}
                    <div class="form-group">
                        <div class="col-sm-offset-2 col-sm-10">
                        <button type="submit" class="btn btn-default">Add User</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <div>
</div>

 <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-12">
            <ol class="breadcrumb">
                <li class="active">
                    <i class="fa fa-dashboard"></i> Users
                </li>
            </ol>
        </div>
    </div>

    @if (Auth::user()->role == "admin")
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Pending Reports</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->role }}</td>
                                    <td class="option-link">
                                    <a class="btn btn-warning btn-sm" href="{{ route('user.edit', ['id'  => $user->id]) }}" role="button">Edit</a>
                                        @if (!$user->verified)
                                            <a class="btn btn-success btn-sm" href="{{ route('user.toggle', ['id'  => $user->id]) }}" role="button">Active</a>
                                        @else
                                            <a class="btn btn-danger btn-sm" href="{{ route('user.toggle', ['id'  => $user->id]) }}" role="button">Inactive</a>
                                        @endif
                                        
                                        <a class="btn btn-danger btn-sm" href="{{ route('user.delete', ['id'  => $user->id]) }}" role="button">Delete</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- /.row -->
@endsection
