@extends('layouts.appAuth')

@section('content')

<section class="sign-in">
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="{{asset('public/auth/images/signin-image.jpg')}}" alt="sing up image"></figure>
                {{-- <a href="#" class="signup-image-link"></a> --}}
                <p>Email:thouhidul@gmail.com</p>
                <p>password: 0 </p>
            </div>

            <div class="signin-form">
                <h2 class="form-title">Sign In</h2>
                <form action="{{route('login.check')}}" method="POST" class="register-form" id="login-form">
                    @csrf
                    <div class="form-group">
                        <label for="username"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input value="{{old('username')}}" type="text" name="username" id="username" placeholder="Phone Number or Email Address"/>
                            @if($errors->has('username'))
                            <span class="text-danger d-block">{{$errors->first('usernsme')}}</span>
                            @endif
                    </div>

                    <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="password" placeholder="Password"/>
                        @if($errors->has('password'))
                            <span class="text-danger d-block">{{$errors->first('password')}}</span>
                            @endif
                    </div>

                    <div class="form-group">
                        <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                        <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                    </div>
                </form>
                {{-- <div class="social-login">
                    <span class="social-label">Or login with</span>
                    <ul class="socials">
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </div>
</section>

@endsection
