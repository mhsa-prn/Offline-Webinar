<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\SendCodeMail;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        return back();
    }
}
