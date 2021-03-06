<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\MessageBag;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\LogoutRequest;
use App\Services\UserService;
use Illuminate\Support\Facades\View;

class PageController extends BaseController
{

    public function getIndex(){
         $resRef = null;
         try {
             $resRef = $this->database->getReference('restaurants');
        } catch (Exception $exception) {
            Log::error($exception->getMessage());
        }
        $restaurants = $resRef->getValue();
        foreach ($restaurants as $restaurant) {
            $all_res[] = $restaurant;
        }
        return view('page.Homepage', compact('all_res'));

    }

    public function postProfile(LogoutRequest $request){
        $user = $request->session()->get('user');
        $email = $user['email'];
        $password = $request->input('password');
        $name = $request->input('name');
        $passwordAgain = $request->input('passwordAgain');
        $now  = Carbon::now();


        $update = ['/avatar'  => $request->file,
                    '/password'=> bcrypt($password),
                    '/name'=>$name,
                    'updated_at' => $now
                    ];
        $user1 = $this->database->getReference('users')
            ->orderByChild('email')
            ->equalTo($user['email'])
            ->update($update);
        return redirect()->route('profile');

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
            'avatar'=>$user['avatar'],
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
        if(!$request->img_up){
            $request->img_up = 'http://ssl.gstatic.com/accounts/ui/avatar_2x.png';
        }

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
            'id' => $userRef->getKey(),
            'email' => $request->email,
            'username' => $request->name,
            'avatar'=>$request->img_up,
        ];

        $request->session()->put('user', $userRef1);

         
         return redirect()->route('HomePage');
    }

    public function getLogout(Request $request){
        $request->session()->flush();

        return redirect()->route('HomePage');
         

    }
    
    public function getProfile(Request $request){
        $user = $request->session()->get('user');

        return view('page.profile',['user'=>$user]);
    }

    public function getAddStore(Request $request){
        if($request->session()->get('user')){
            return view('page.addStore');
        }else

        return view('page.signin');
    }
    public function postAddStore(Request $request){

        $user = $request->session()->get('user');
        $name = $request->name;
        $address = $request->address;
        $phone = $request->phone;
        $img_store = $request->img_store;
        $menu = $request->menu;
        $description = $request->description;
        $price = $request->price;
        $now  = Carbon::now();
        if(!$img_store){
            $img_store = '../fashi/img/nhahang_2.jpg';
        }

        $userRef = $this->database->getReference('restaurants')->push([
                'name' => $name,
                'address' =>$address,
                'image'=>$img_store,
                'menu'=>$menu,
                'intro'=>$description,
                'price'=>$price,
                'userId'=>$user['id'],
                'id'=>'6',
                'created_at' => $now,
                'updated_at' => '',
                'deleted_at' => '',
                
        ]);

        return redirect()->route('HomePage');
    }
}
