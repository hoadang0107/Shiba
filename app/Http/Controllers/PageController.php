<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\MessageBag;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Services\UserService;

class PageController extends BaseController
{
    public function getIndex(Request $request){
        $user1 = $request->session()->get('user');
        return view('page.Homepage')->with('user1',$user1);
        
    }

    public function getSignUp(Request $request){
        if ($request->session()->get('user')) {
        return redirect('/');
        }

        return view('page.signup');
    }

    public function getSignIn(Request $request){
        if ($request->session()->get('user')) {
        return redirect('/');
        }

        return view('page.signin');
    }

    public function postSignIn(LoginRequest $request, UserService $userService)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $users = $userService->getUserByEmail($email);

        $user = reset($users);

        if (sizeof($users) <= 0 || $user['deleted_at']) {
           $errors = new MessageBag(['email' => 'Email not exists.']);

            return redirect()->back()->withInput()->withErrors($errors);
        }

        if (!Hash::check($password, $user['password'])) {
            $errors = new MessageBag(['password' => 'Password wrong.']);

            return redirect()->back()->withInput()->withErrors($errors);
        }
        $userRef = [
            'id' => array_key_first($users),
            'email' => $user['email'],
            'username' => $user['username'],
        ];

        $request->session()->put('user', $userRef);

        return redirect()->route('HomePage');
    }
    public function postSignUp(LogoutRequest $request, UserService $userService){
        $email = $request->input('email');
        $password = $request->input('password');
        $name = $request->input('name');
        $passwordAgain = $request->input('passwordAgain');
        $users = $userService->getUserByEmail($email);

        $user = reset($users);

        if (sizeof($users) > 0 ) {
           $errors = new MessageBag(['email' => 'Email exists.']);

            return redirect()->back()->withInput()->withErrors($errors);
        }
        $now  = Carbon::now();

        $userRef = $this->database->getReference('users')->push([
                'email' => $request->email,
                'username' =>$request->name,
                'password' => bcrypt($request->password),
                'avatar'=>$request->img_up,
                'created_at' => $now,
                'updated_at' => '',
                'deleted_at' => '',
                
            ]);
        $userRef1 = [
            'id' => array_key_first($users),
            'email' => $user['email'],
            'username' => $user['username'],
        ];

        $request->session()->put('user', $userRef1);

         
         return redirect()->route('HomePage');
    }

    public function getLogout(Request $request){
        $request->session()->flush();

        return redirect()->route('HomePage');
         

    }
    
    public function getProfile(){
        return view('page.profile');
    }
}
