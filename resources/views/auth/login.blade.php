@extends('base')


@section('title', 'Login')
@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4 mx-auto">
                <h1 class="text-center text-muted mb-5 mt-5">
                    Please sign in
                </h1>

                <form method="POST" action="{{route('login')}}">
                    @csrf

                    @error('email')
                        <div class="alert alert-danger text-center" role="alert">
                                {{$message}}
                        </div>
                    @enderror

                    @error('password')
                        <div class="alert alert-danger text-center" role="alert">
                                {{$message}}
                        </div>
                    @enderror

                      <label for="email" class="form-label">Email</label>
                      <input type="email" name="email" class="form-control mb-3 @error('email') is-invalid @enderror"  id="email" value="{{old('email')}}" required autocomplete="email" autofocus>
                      <label for="password" class="form-label">Password</label>
                      <input type="password" name="password" class="form-control mb-3 @error('password') is-invalid @enderror" id="password" required autocomplete="current-password" autofocus>

                      <div class="row">
                            <div class="col-md-6">
                                <div class="form-ckeck form-switch">
                                    <input type="checkbox" class="form-check-input" role="switch" id="remember" name="remember" {{old('remember') ? 'checked' : ''}}>
                                    <label for="remember" class="form-check-label">Remember me</label>
                                </div>
                            </div>
                            <div class="col-md-6 text-end">
                                <a href="#" class="text-purple">Forgot password?</a>
                            </div>
                      </div>
                        <div class="d-grid gab-2">
                            <button type="submit" class="btn btn-purple mt-3" style="border-color: #8d46c0;">Sign in</button>
                        </div>

                        <p class="text-center text-muted mt-5">Not registered yet ? <a href="{{route('register')}}" class="text-purple">Create a account</a></p>
                    </form>
            </div>
        </div>
    </div>

@endsection
