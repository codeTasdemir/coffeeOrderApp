@extends('layouts.app')

@section('content')
    <div class="register-box">
        <div class="register-logo">
            <a href="{{route('home')}}"><b>Coffee Order </b>App</a>
        </div>

        <div class="card">
            <div class="card-body register-card-body">
                <p class="login-box-msg">Kayıt Ol</p>

                <form  method="POST" action="{{ route('register') }}">
                @csrf
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" name="name" placeholder="Ad Soyad" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" class="form-control" placeholder="E-posta Adresi"  name="email" value="{{ old('email') }}" required autocomplete="email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" class="form-control" placeholder="Parola"  name="password" required autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                        @enderror
                    </div>
                    <div class="input-group mb-3">
                        <input placeholder="Parola Tekrar" id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="social-auth-links text-center mt-2 mb-3">
                        <a href="{{route('signinFacebook')}}" class="btn btn-block btn-primary">
                            <i class="fab fa-facebook mr-2"></i> Facebook ile Kayıt Ol
                        </a>
                        <a href="#" class="btn btn-block btn-danger">
                            <i class="fab fa-google-plus mr-2"></i> Google ile Kayıt Ol
                        </a>
                        <a href="#" class="btn btn-block btn-success">
                            <i class="fab fa-twitter mr-2"></i> Twitter ile Kayıt Ol
                        </a>
                        <a href="{{route('signinGithub')}}" class="btn btn-block btn-secondary">
                            <i class="fab fa-github mr-2"></i> Github ile Kayıt Ol
                        </a>
                    </div>
                    <div class="row">
{{--                        <div class="col-8 ">--}}
{{--                            <div class="icheck-primary">--}}
{{--                                <input type="checkbox" id="agreeTerms" name="terms" value="agree">--}}
{{--                                <label for="agreeTerms">--}}
{{--                                    I agree to the <a href="#">terms</a>--}}
{{--                                </label>--}}
{{--                            </div>--}}
{{--                        </div>--}}
                        <!-- /.col -->
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary btn-block">Kayıt Ol</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>

{{--                <div class="social-auth-links text-center">--}}
{{--                    <p>- OR -</p>--}}
{{--                    <a href="#" class="btn btn-block btn-primary">--}}
{{--                        <i class="fab fa-facebook mr-2"></i>--}}
{{--                        Sign up using Facebook--}}
{{--                    </a>--}}
{{--                    <a href="#" class="btn btn-block btn-danger">--}}
{{--                        <i class="fab fa-google-plus mr-2"></i>--}}
{{--                        Sign up using Google+--}}
{{--                    </a>--}}
{{--                </div>--}}

                <a href="{{route('login')}}" class="text-center">Giriş Yap</a>
            </div>
            <!-- /.form-box -->
        </div><!-- /.card -->
    </div>

@endsection
