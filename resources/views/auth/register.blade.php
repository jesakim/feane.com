@extends('auth/authlayout')
@section('title','REGISTER')
@section('form')
<div class="signin">
    <div class="content">
        <h2>REGISTER</h2>

        @if (Session::get('fail'))
          <div class="infomsg fail">
            {{Session::get('fail')}}
        </div> 
        @endif 

        @if (Session::get('success'))
        <div class="infomsg success">
            {{Session::get('success')}}
        </div>
        @endif
        
        <form class="form" method="post" action="{{route('auth.save')}}">
            @csrf
            @error('username')
                <div class="error">
                    {{$message}}
                </div>
            @enderror
            <div class="inputbox">
                <input type="text" placeholder=" " required name="username" value="{{old('username')}}">
                <i>UserName</i>
            </div>
            @error('email')
                <div class="error">
                    {{$message}}
                </div>
            @enderror
            <div class="inputbox">
                <input type="email" placeholder=" " required name="email" value="{{old('email')}}">
                <i>Email</i>
            </div>
            @error('pass')
                <div class="error">
                    {{$message}}
                </div>
            @enderror
            <div class="inputbox">
                <input type="password" placeholder=" " required name="pass">
                <i>Password</i>
            </div>
            <div class="inputbox">
                <input type="password" placeholder=" " required name="pass_confirmation">
                <i>Repeat Password</i>
            </div>
            <div class="link">
                <a href="{{route('auth.reset')}}">Forgot Password</a>
                <a href="{{route('auth.login')}}">Signin</a>
            </div>
            <div class="inputbox">
                <input type="submit" value="Register" name="submit">
            </div>
        </form>
    </div>
</div>
    
@endsection