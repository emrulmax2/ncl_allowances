<?php

namespace App\Http\Controllers;

use App\Http\Request\LoginRequest;
use App\Http\Controllers\Controller;
use App\Models\Option;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    /**
     * Show specified view.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function loginView()
    {
        $env= env('APP_ENV');

        $users = User::all();
        foreach($users as $user) {
            $user->update([
                'email' => strtolower($user->emailaddress),
                'name' => ucfirst(strtolower($user->firstname)).' '.ucfirst(strtolower($user->lastname)),
                'email_verified_at' => $user->created_at,
            ]);
        }
        return view('pages.login', [
            'layout' => 'login',
            'env' => $env,
            'opt' => Option::where('category', 'SITE_SETTINGS')->pluck('fieldvalue', 'fieldname')->toArray()
        ]);
    }

    /**
     * Authenticate login user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(LoginRequest $request)
    {

        if (!Auth::attempt([
            'email' => $request->email,
            'password' => $request->password
        ])) {

            throw new \Exception('Wrong email or password.');
        
        } else {
            User::where('id', auth()->user()->id)->update([
                'last_login_ip' => $request->getClientIp()
            ]);
            //Cache::forever('employeeCache'.\Auth::user()->id, \Auth::user()->load('employee'));
        }
    }

    /**
     * Logout user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        \Auth::logout();
        //Cache::flush();
        return redirect('login');
    }
}
