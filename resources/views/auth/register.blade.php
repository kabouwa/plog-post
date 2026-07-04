<x-layouts.app
    title="Register"
    heading="Starts with us!"
>
    <div class="rowr">
        <div class="col-12 col-sm-8 col-lg-5 mx-auto bg-light p-4 rounded-3">
            <h3 class="mb-3">Register</h3>
            <form method="POST" action="{{ route('register') }}" class="form">
                @csrf
                <div class="form-group my-2">
                    <label class="form-label" for="name">Name :</label>
                    <div class="input-group">
                        <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="name" value="{{ old('name') }}">
                        @error('name')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>  
                        @enderror
                    </div>
                </div>

                <div class="form-group my-2">
                    <label class="form-label" for="email">Email :</label>
                    <div class="input-group">
                        <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email" placeholder="email" value="{{ old('email') }}">
                        @error('email')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>  
                        @enderror
                    </div>
                </div>

                <div class="form-group my-2">
                    <label class="form-label" for="username">Username :</label>
                    <div class="input-group">
                        <input class="form-control @error('username') is-invalid @enderror" type="text" name="username" id="username" placeholder="username" value="{{ old('username') }}">
                        @error('username')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>  
                        @enderror
                    </div>
                </div>

                <div class="form-group my-2">
                    <label class="form-label" for="password">Password :</label>
                    <div class="input-group">
                        <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="password">
                        <button type="button" class="password-toggler"></button>
                        @error('password')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>  
                        @enderror
                    </div>
                </div>

                <div class="form-group my-2">
                    <label class="form-label" for="password_confirmation">Confirm Password :</label>
                    <div class="input-group">
                        <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation" placeholder="confirm password">
                        <button type="button" class="password-toggler"></button>
                        @error('password_confirmation')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>  
                        @enderror
                    </div>
                </div>
    
                <div class="form-group my-4">
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </div>
            </form>

            <p class="text-muted text-center">Already have an acount? <a class="" href="{{ route('login') }}">login</a></p>  

            
            @error('credentials')
                <div class="alert alert-danger fade show alert-dismissible">
                    {{ $message }}
                    <button type="button" data-bs-dismiss="alert" class="btn-close"></button>
                </div>
            @enderror
            
        </div>
    </div>
    <x-slot:scripts>
        <script>
            $('input').keyup(e => { 
                validateMinLength([$(e.currentTarget)])
            })
        </script>
    </x-slot:scripts>
</x-layouts.app>