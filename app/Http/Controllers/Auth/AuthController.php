<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendCodeMail;
use App\Models\Code;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function getCode(Request $request)
    {
        $request->validate([
            'email' => 'email'
        ]);

        $code=rand(10000,99999);

        $user=User::where('email',$request->email)->first();
        if($user){
            $user->code()->delete();
            $user->code()->create([
                'code' => $code,
                'expired_at' => Carbon::now() -> addMinutes (2)
            ]);
            $data=[
                'title'=> 'رمز عبور یکبار مصرف',
                'code'=> $code
            ];
            Mail::to($user)->send(new SendCodeMail($data));
        }else{
            $user=User::create([
                'email' => $request->email
            ]);
            $user->code()->delete();
            $user->code()->create([
                'code' => $code,
                'expired_at' => Carbon::now() -> addMinutes (2)
            ]);
            $data=[
                'title'=> 'رمز عبور یکبار مصرف',
                'code'=> $code
            ];
            Mail::to($user)->send(new SendCodeMail($data));

        }
        return redirect(route('login',['email'=> $user->email]));
    }

    public function getCodePage()
    {
        return view('auth.getCode');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'code' => 'required|string|min:5|max:5|exists:codes,code'
        ]);

        $user= User::where('email',$request->email)->first();
        $code = Code::where('code',$request->code)->first();
        $user_code=$user->code->code;
        $user_code_expired_at = $user -> code->expired_at;
        if ($code->code == $user_code &&
                $user_code_expired_at > Carbon::now()){
            auth()->loginUsingId($user->id);
            $user->code()->delete();
            if($user->isAdmin()){
                return redirect(route('admin.users.index'));
            }
            return redirect(route('home'));
        }
        return back()->with('error','کد وارد شده معتبر نمی باشد');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
