<x-layouts.app
    title="Register"
    heading="Starts with us!"
>
    <div class="rowr">
        <div class="col-12 col-sm-8 col-lg-5 mx-auto bg-light p-4 rounded-3">
            <h3 class="mb-3 text-center">Create an Account</h3>
            <div class="text-center position-relative col-12 col-sm-6 col-lg-4 mx-auto" id="preview" >
                <img 
                    class="rounded-circle img-fluid p-1 border border-2 border-secondary w-100 h-100 min-h-100 min-w-100"
                    src={{ asset('storage/' . 'users/default-profile.png') }}
                    alt="Profile Image" 
                    style="min-height: 150px">
                <label for="profile" class="btn btn-sm btn-primary py-1 px-2 position-absolute bottom-0 right-0"><i class="bi bi-pencil"></i> </label>
            </div>
            
            <form method="POST" action="{{ route('register') }}" class="form" enctype="multipart/form-data">
                @csrf
                <input type="file" name="profile" id="profile" hidden>
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

            <p class="text-muted text-center">Already have an acount? <a class="" href="{{ route('login') }}">login in</a></p>  

            
            @error('profile')
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
        <script src="{{ asset('js/img-preview.js') }}"></script>
    </x-slot:scripts>
</x-layouts.app>