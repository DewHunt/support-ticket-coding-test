<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller {
    function index() {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    function add() {
        return view('user.add');
    }

    function save(Request $request) {
        $isUserExists = User::where('email', $request->email)->first();

        if ($isUserExists) {
            return redirect(route('user.add'))->with('error', 'This user already exists');
        } else {
            $isSaved = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'user_name' => $request->user_name,
                'password' => Hash::make($request->password),
            ]);

            if ($isSaved) {
                return redirect(route('user.index'))->with('success', 'User saved successfully!');
            } else {
                return redirect(route('user.add'))->with('error', 'User not saved, somthing went wrong!');
            }
        }

    }

    function edit($id) {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }

    function update(Request $request) {
        $id = $request->id;
        $isUserExists = User::where('id', '<>', $id)->where('email', $request->email)->first();

        if ($isUserExists) {
            return redirect(route('user.edit', ['id' => $id]))->with('error', 'This user already exists');
        } else {
            $isUpdated = User::whereId($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'user_name' => $request->user_name,
                'password' => Hash::make($request->password),
            ]);

            if ($isUpdated) {
                return redirect(route('user.index'))->with('success', 'User updated successfully!');
            } else {
                return redirect(route('user.edit', ['id', $id]))->with('error', 'User not update, somthing went wrong!');
            }
        }
    }

    function delete($id) {
        $isDeleted = User::where('id', $id)->delete();
        return redirect(route('user.index'));
    }
}
