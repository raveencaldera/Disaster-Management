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
            <form action="{{ route('user.update', ['id'   => $user->id]) }}" method="POST" class="form-horizontal">
                <div class="form-group">
                    <label for="inputPlace" class="col-sm-2 control-label">Name</label>
                    <div class="col-sm-10">
                    <input name="name" value="{{ (old('name')) ? old('name') : $user->name  }}" type="text" class="form-control" id="inputPlace" placeholder="Enter user's name">
                    </div>
                </div>

                <div class="form-group">
                    <label for="inputType" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                    <input name="email" value="{{ (old('email')) ? old('email') : $user->email  }}" type="email" class="form-control" id="inputType" placeholder="Enter user's email">
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
                    <button type="submit" class="btn btn-default">Update User</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div>
</div>

@endsection