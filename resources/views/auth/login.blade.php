<x-layouts.app
    title="Login"
    heading="Welcome Back !"
>
    <div class="rowr">
        <div class="col-12 col-sm-8 col-lg-5 mx-auto bg-light p-4 rounded-3">
            <h3 class="mb-3">Login</h3>
            <form method="POST" action="{{ route('authenticate') }}" class="form">
                @csrf
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
    
                <div class="form-group my-4">
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </div>
            </form>
            <p class="text-muted text-center">Haven't registred yet? <a class="" href="">register</a></p>  

            
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
            $('input').keyup(e => { validateRequired([$(e.currentTarget)]) })
        </script>
    </x-slot:scripts>
</x-layouts.app>