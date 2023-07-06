<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function edit()
    {
        $user=User::where('id',auth()->id())->first();
        return view('users.edit',compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'=>'required'
        ]);

        $user->update($request->all());

        return redirect('/home');
    }
}
