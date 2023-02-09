@extends('auth/authlayout')
@section('title','RESET PASSWORD')
@section('form')
<div class="signin">
    <div class="content">
        <h2>Reset Password</h2>
        @if (Session::get('fail'))
          <div class="infomsg fail">
            {{Session::get('fail')}}
        </div> 
        @endif 
        <form class="form" method="post" action="{{route('savenewpass')}}">
            @csrf
            @error('email')
                <div class="error">
                    {{$message}}
                </div>
            @enderror
            {{-- <div class="inputbox"> --}}
                <input type="hidden" placeholder=" " required name="token" value="{{$token}}">
                {{-- <i>token</i> --}}
            {{-- </div> --}}
            <div class="inputbox">
                <input type="text" placeholder=" " required name="email" value="{{$email ?? old('email')}}">
                <i>Email</i>
            </div>
            <div class="inputbox">
                <input type="text" placeholder=" " required name="pass" >
                <i>New Password</i>
            </div>
            <div class="inputbox">
                <input type="text" placeholder=" " required name="pass_confirmation">
                <i>Confirm Password</i>
            </div>
            <div class="link">
                <a href="#"></a>
                <a href="{{route('auth.login')}}">Sign In</a>
            </div>
            <div class="inputbox">
                <input type="submit" value="Login" name="submit">
            </div>
        </form>
    </div>
</div>
    
@endsection