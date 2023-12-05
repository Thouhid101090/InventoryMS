 @extends('layouts.appAuth')

 @section('content')
 <!-- Sign up form -->
 <section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Sign up</h2>
                <form accept="{{route('register.store')}}" method="POST" class="register-form" id="register-form">
                    @csrf
                    <div class="form-group">
                        <label for="FullName"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input required value="{{old('FullName')}}" type="text" name="FullName" id="name" placeholder="Your Name"/>
                        @if($errors->has('FullName'))
                        <span class="text-danger">
                                {{$errors->first('FullName')}}
                        </span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input required value="{{old('EmailAddress')}}" type="email" name="EmailAddress" id="email" placeholder="Your Email"/>
                        @if($errors->has('EmailAddress'))
                            <span class="text-danger">{{$errors->first('EmailAddress')}}</span>

                        @endif
                    </div>
                    <div class="form-group">
                        <label for="contact_no_en"><i class="zmdi zmdi-contact"></i></label>
                        <input required value="{{old('contact_no_en')}}" type="text" name="contact_no_en" id="contact_no_en" placeholder="Your Contact Number"/>
                        @if($errors->has('contact_no_en'))
                            <span class="text-danger">{{$errors->first('contact_no_en')}}</span>

                        @endif
                    </div>

                    <div class="form-group">
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input required type="password" name="password" id="password" placeholder="Password"/>
                        @if($errors->has('password'))
                        <span class="text-danger">{{$errors->first('password')}}</span>

                    @endif
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Repeat your password"/>
                    </div>
                    <div class="form-group">
                        <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                        <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="signup" id="signup" class="form-submit" value="Register"/>
                    </div>
                </form>
            </div>
            <div class="signup-image">
                <figure><img src="{{asset('public/auth/images/signup-image.jpg')}}" alt="sing up image"></figure>
                <a href="{{route('login')}}" class="signup-image-link">I am already member</a>
            </div>
        </div>
    </div>
</section>

@endsection
