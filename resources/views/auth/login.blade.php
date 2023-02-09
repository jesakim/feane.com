@extends('auth/authlayout')
@section('title','SIGN IN')
@section('form')
<div class="signin">
    <div class="content">
        <h2>Sign In</h2>
        @if (Session::get('fail'))
          <div class="infomsg fail">
            {{Session::get('fail')}}
        </div> 
        @endif 
        <form class="form" method="post" action="{{route('auth.check')}}">
            @csrf
            @error('email')
                <div class="error">
                    {{$message}}
                </div>
            @enderror
            <div class="inputbox">
                <input type="text" placeholder=" " required name="email" value="{{old('email')}}">
                <i>Email</i>
            </div>
            @error('password')
                <div class="error">
                    {{$message}}
                </div>
            @enderror
            <div class="inputbox">
                <input type="password" placeholder=" " required name="password">
                <i>Password</i>
            </div>
            <div class="link">
                <a href="{{route('auth.reset')}}">Forgot Password</a>
                <a href="{{route('auth.register')}}">Register</a>
            </div>
            <div class="inputbox">
                <input type="submit" value="Login" name="submit">
            </div>
        </form>
    </div>
</div>
    
@endsection