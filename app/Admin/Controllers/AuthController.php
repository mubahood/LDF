<?php

namespace App\Admin\Controllers;

use Encore\Admin\Controllers\AuthController as BaseAuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Encore\Admin\Auth\Database\Administrator;


class AuthController extends BaseAuthController
{
    // override the loginView property
    protected $loginView = 'auth.login';


    // override the postLogin method
        public function postLogin(Request $request)
    {
  /*       if ($this->guard()->attempt([
            'email' => 'mubs0x@gmail.com',
            'password' => '4321',
        ], true)) {
            return $this->sendLoginResponse($request);
        }
 */

        $r = $request;


        if (isset($_POST['password_1'])) {
            // REGISTER

            if (Validator::make($_POST, [
                'name' => 'required|string|min:4'
            ])->fails()) {
                return back()
                    ->withErrors(['name' => 'Enter your valid name.'])
                    ->withInput();
            }

            if (Validator::make($_POST, [
                'email' => 'required|email',
            ])->fails()) {
                return back()
                    ->withErrors(['email' => 'Enter a valid email address.'])
                    ->withInput();
            }

            if (Validator::make($_POST, [
                'password' => 'required|min:2'
            ])->fails()) {
                return back()
                    ->withErrors(['password' => 'Enter password with more than 3 chracters.'])
                    ->withInput();
            }

            if (Validator::make($_POST, [
                'password_1' => 'required|min:2'
            ])->fails()) {
                return back()
                    ->withErrors(['password_1' => 'Enter password with more than 3 chracters.'])
                    ->withInput();
            }

            if ($r->password != $r->password_1) {
                return back()
                    ->withErrors(['password_1' => 'Confirmation password did not match.'])
                    ->withInput();
            }

            $u = Administrator::where([
                'email' => $_POST['email']
            ])->orwhere([
                'username' => $_POST['email']
            ])->first(); 


            if ($u != null) {
                $u->username = $r->email;
                $u->email = $r->email;
                $u->password = password_hash($r->password, PASSWORD_DEFAULT);
                $u->save();
            } else {
                $admin = new Administrator();
                $admin->username = $r->email;
                $admin->email = $r->email;
                $admin->name = $r->name;
                //$admin->avatar = 'user.png';
                $admin->password = password_hash($r->password, PASSWORD_DEFAULT);

                if (!$admin->save()) {
                    return back()
                        ->withErrors(['email' => 'Failed to create account. Try again.'])
                        ->withInput();
                }
            }
        }else {
            // LOGIN
            // $u = Administrator::where([
            //     'email' => $_POST['email']
            // ])->orwhere([
            //     'username' => $_POST['email']
            // ])->first();
            $u = Administrator::where([
                'username' => $r->input('username')
            ])->first();
    
            if ($u == null) {
                return back()
                    ->withErrors(['username' => 'Account with provided email address was not found.'])
                    ->withInput();
            }
        }

        // if (Auth::attempt([
        //     'email' => $r->email,
        //     'password' => $r->password,
        // ], true)) {
        // }


        // $credentials = $request->only(['email', 'password']);

        // if ($this->guard()->attempt($credentials, $remember)) {
        //     return $this->sendLoginResponse($request);
        // }

        $credentials['username'] = $request->username;
        $credentials['password'] = $request->password;
        $remember = true;

        if ($this->guard()->attempt($credentials, $remember)) {
            return $this->sendLoginResponse($request);
        }


        return back()
            ->withErrors(['username' => 'Wrong Credentials. Try again.'])
            ->withInput();
    }
}
