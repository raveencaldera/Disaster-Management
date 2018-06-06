<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function index(Request $request) {
        $users = User::all();

        return view('users', ['users'   => $users]);
    }

    public function toggleVerify(Request $request) {
        if ($request->user()->role == 'admin') {
            $user = User::find($request->input('id'));
            $user->verified = !$user->verified;
            return true;                   
        }

        return false;
    }

    public function addUser(Request $request) {
        if ($request->user()->role == 'admin') {
            $validatedData = $request->validate([
                'name'              => 'required',
                'email'             => 'required|email|unique:users',
                'role'              => 'required',
                'password'          => 'required|min:6',
            ]);
    
            User::create([
                "name"                  => $request->input('name'),
                "email"                 => $request->input('email'),
                "password"              => bcrypt($request->input('password')),
                "role"                  => $request->input('role'),
            ]);
    
            $request->session()->flash('alert-success', 'User successfully added to review');
            return redirect()->route('users.index');                 
        }

        return redirect()->back();
    }

    public function deleteUser(Request $request) {
        if ($request->user()->role == 'admin') {
            User::destroy($request->input('id'));
            $request->session()->flash('alert-success', 'User removed successfully');            
            return redirect()->back();                    
        }

        return redirect()->back();
    }

    public function toggleUser(Request $request) {
        if ($request->user()->role == 'admin') {
            $report = User::find($request->input('id'));
            $report->verified = !$report->verified;
            $report->save();
            return redirect()->back();
        }

        return redirect()->back();
    }

    public function editView(Request $request) {
        $user = User::find($request->input('id'));
        return view('userEdit', ['user'    => $user]);
    }

    public function updateUser(Request $request) {
        if ($request->user()->role == 'admin') {
            $report = User::find($request->input('id'));
            $report->name = ($request->input('name')) ? $request->input('name') : $report->name;
            $report->email = ($request->input('email')) ? $request->input('email') : $report->email;
            if ($request->input('password')) {
                $report->password = bcrypt($request->input('password'));
            }
            $report->role = ($request->input('role')) ? $request->input('role') : $report->role;
            $report->save();
            $request->session()->flash('alert-success', 'User updated successfully');
            return redirect()->back();
        }

        return redirect()->back();
    }

}
