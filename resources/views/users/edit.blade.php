<x-layouts.app
    title="Edit Profile"
    heading="Edit Profile"
>
    <form method="POST" action="{{ route('users.update', $user->id) }}" class="form p-1 mx-auto col-12 col-sm-8 col-lg-6">
        @csrf
        @method('PUT')

        <div class="form-group my-2">
            <label class="form-label" for="name">Name :</label>
            <div class="input-group">
                <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" id="name" placeholder="name" value={{ old('name',$user->name) }}>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>  
                @enderror
            </div>
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="email">Email :</label>
            <div class="input-group">
                <input class="form-control @error('email') is-invalid @enderror" type="text" name="email" id="email" placeholder="email" value={{ old('email',$user->email) }}>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>  
                @enderror
            </div>
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="username">Username :</label>
            <div class="input-group">
                <input class="form-control @error('username') is-invalid @enderror" type="text" name="username" id="username" placeholder="username" value={{ old('username',$user->username) }}>
                @error('username')
                    <div class="invalid-feedback"> {{ $message }}</div>  
                @enderror
            </div>
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="password">Password :</label>
            <div class="input-group">
                <input class="form-control @error('password') is-invalid @enderror" type="password" name="password" id="password" placeholder="password">
                <button type="button" class="password-toggler"></button>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>      
                @enderror
            </div>
            <small class="text-muted">Fill to change password</small>
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="password_confirmation">Confirm Password :</label>
            <div class="input-group">
                <input class="form-control @error('password_confirmation') is-invalid @enderror" type="password" name="password_confirmation" id="password_confirmation" placeholder="confirm password">
                <button type="button" class="password-toggler"></button>
                @error('password_confirmation')
                    <div class="invalid-feedback">{{ $message }}</div>   
                @enderror
            </div>
        </div>

        <div class="form-group my-2">
            <label class="form-label" for="bio">Bio :</label>
            <div class="input-group">
                <textarea class="form-control @error('bio') is-invalid @enderror"  name="bio" id="bio" placeholder="bio">{{ old('bio',$user->bio) }}</textarea>
                @error('bio')
                    <div class="invalid-feedback">{{ $message }}</div>    
                @enderror
            </div>
        </div>

        <div class="form-group my-4">
            <button type="submit" class="btn btn-primary w-100">Update</button>
        </div>
    </form>

    <x-slot:scripts>
    </x-slot:scripts>
</x-layouts.app>