<h4 class="update_password">Update your password</h4>

<form action="user/password/update" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="password">{{ __('New Password') }}</label>
        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="new_password_confirm">{{ __('Confirm New Password') }}</label>
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
    </div>

    <button type="submit" class="btn btn-primary">{{ __('Update Password') }}</button>
</form>