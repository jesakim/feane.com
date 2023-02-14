<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\menu;
use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\DB;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class MainController extends Controller
{
    function login(){
        return view('auth.login');
    }

    function register(){
        return view('auth.register');
    }

    function dashboard(){
        $data = ['loggedUser'=>session('loggedUser')];
        return view('dashboard/dashboard',$data);
    }

    function menu(){
        $data = ['items'=>menu::all(),'loggedUser'=>session('loggedUser')];
        $data['categories'] = DB::table('menus')->distinct()->pluck('category');
        // dd($data);
        return view('menu',$data);
    }

    function reset(){
        // $data = ['users'=>DB::table('admins')->where('isadmin','=','0')];
        return view('auth.resetpass');
    }

    function profile(){
        $data = ['loggedUser'=>session('loggedUser')];
        return view('dashboard/profile',$data);
    }

    function send(Request $request){
        $request->validate([
            'email'=>'required|email|exists:admins',
        ]);
        $token = \Str::random(64);
        Db::table('password_resets')->insert([
            'email'=>$request->email,
            'token'=>$token,
            'created_at'=>Carbon::now(),
        ]);
        // dd($token);
        $action_link = route('enternewpass',['token'=>$token,'email'=>$request->email]);
        $body = 'test';
        \Mail::send('emailform',['action_link'=>$action_link,'body'=>$body],function($message) use ($request){
            $message->from('noreply@feane.com','laravel');
            $message->to($request->email,'laravel')
            ->subject('reset password');
        });

        return back();

    }

    function enternewpass(Request $request ,$token = null){
        return view('auth.newpass')->with(['token'=>$token,'email'=>$request->email]);
    }

    function savenewpass(Request $request){
        $request->validate([
            'email'=>'required|email|exists:admins',
            'pass'=>'required|confirmed|min:5',
        ]);

        $check_token = DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();

        if(!$check_token){
           return back()->with('fail','password aleady changed');
        }else{
            Admin::where('email',$request->email)->update([
                'pass'=>Hash::make($request->pass)
            ]);

            DB::table('password_resets')->where([
                'email'=>$request->email,
                'token'=>$request->token,
            ])->delete();

            return redirect()->route('auth.login')->with('fail','saved');
        }


    }

    function save(Request $request){
       $request->validate([
            'username'=>'required',
            'email'=>'required|email|unique:admins',
            'pass'=>'required|confirmed|min:5',
        ]);

        $admim= new Admin();

        $admim->username = $request->username;
        $admim->email = $request->email;
        $admim->pass = hash::make($request->pass);

        $save = $admim->save();

        if($save){
            return back()->with('success','You are registered now');
        }else{
            return back()->with('fail','Something wont wrong');
        }

    }

    function check(Request $request){
        $request->validate([
            'email'=>'required|email',
            'password'=>'required|min:5'
        ]);

        // $request->session()->put('loggedUser',$request->email);

        $userinfo = Admin::where('email','=',$request->email)->first();

        if(!$userinfo){
            return back()->with('fail','Email provided not registered');
        }else{
            if(Hash::check($request->password,$userinfo->pass)){
                if($userinfo->isadmin==1){
                    $request->session()->put('loggedUser',$userinfo);
                    return redirect('admin/dashboard');

                }else{
                return back()->with('fail','Ask Admin For Permission');

                }

            }else{
                return back()->with('fail','Password provided incorrect');

            }
        }



    }

    function logout(){
        if(session()->has('loggedUser')){
            session()->flush();
            return redirect('/');
        }
    }

    function editinfo(Request $request){

        $request->validate([
            'email'=>'required|email',
            'username'=>'required'
        ]);

        $thisuser = Admin::where('id','=',Session()->get('loggedUser')->id)->first();
        $thisuser->username = $request->username;
        $thisuser->email = $request->email;
        $thisuser->save();
        $request->session()->put('loggedUser',$thisuser);
        return redirect('admin/profile')->with('success','new info set succesfully');
    }

    function editpass(Request $request){
        $request->validate([
            'current'=>'required|min:5',
            'newpass'=>'required|confirmed|min:5',
        ]);

        $thisuser = Admin::where('id','=',Session()->get('loggedUser')->id)->first();
        // dd($thisuser);
        if(Hash::check($request->current,$thisuser->pass)){
            // return redirect('admin/dashboard');
            $thisuser->pass = Hash::make($request->newpass);
            $thisuser->save();
            $request->session()->put('loggedUser',$thisuser);
            return redirect('admin/profile')->with('success','new password set succesfully');
            }else{
                return back()->with('fail','Current Password Incorrect');

            }
    }
}
