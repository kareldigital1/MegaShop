@extends('base')

@section('title', 'Register')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <h1 class="text-center text-muted mb-5 mt-5">Register</h1>

                <form action="{{route('register')}}" method="POST" class="row g-3">
                    @csrf

                        <div class="col-md-6">
                            <label for="firstname" class="form-label">First Name</label>
                            <input type="text" class="form-control" id="firstname" name="firstname" value="{{ old('firstname')}}" required autocomplete="firstname">
                            <small class="text-danger fw-bold" id="error-register-firstname"></small>
                        </div>
                        <div class="col-md-6">
                            <label for="lastname" class="form-label">Last Name</label>
                            <input type="text" class="form-control" id="lastname" name="lastname" value="{{ old('lastname')}}" required autocomplete="lastname">
                            <small class="text-danger fw-bold" id="error-register-lastname"></small>
                        </div>
                        <div class="col-md-12">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="{{ old('email')}}" required autocomplete="email" >
                            <small class="text-danger fw-bold" id="error-register-email"></small>
                        </div>
                        <div class="col-md-6">
                            <label for="password" class="form-label">Password </label>
                            <input type="password" class="form-control" id="password" name="password" value="{{ old('password')}}" required autocomplete="password">
                            <small class="text-danger fw-bold" id="error-register-password"></small>
                        </div>
                        <div class="col-md-6">
                            <label for="password-confirm" class="form-label">Password Confirmation</label>
                            <input type="password" class="form-control" id="password-confirm" name="password-confirm" value="{{ old('password-confirm')}}" required autocomplete="password-confirm">
                            <small class="text-danger fw-bold" id="error-register-password-confirm"></small>
                        </div>
                        <div class="col-12">
                            <div class="form-check">
                              <input class="form-check-input" type="checkbox" id="agreeTerms">
                              <label class="form-check-label" for="agreeTerms">Agree terms</label><br>
                              <small class="text-danger fw-bold" id="error-register-agreeTerms"></small>
                            </div>
                        </div>
                            <div class="d-grid gab-2">
                                <button type="submit" class="btn btn-purple mt-3" id="register-user">Register</button>
                            </div>

                        <p class="text-center text-muted mt-5">Already have an account ? <a href="{{route('login')}}" class="text-purple">Login</a></p>
                </form>
            </div>
        </div>
    </div>
    
@endsection
