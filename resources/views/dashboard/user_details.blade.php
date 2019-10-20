<h4>Your Details</h4>

<form action="user/update" method="POST">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="name" class="fullname">Full Name</label>
        <input type="text" class="form-control" id="name" name="name" aria-describedby="nameHelp" placeholder="Enter name" value="{{ $user->name }}">
        <small id="nameHelp" class="form-text text-muted">Your full name.</small>
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="nickname" class="nickname">Nickname</label>
        <input type="text" class="form-control" id="nickname" name="nickname" aria-describedby="userNicknameHelp" placeholder="Enter nickname" value="{{ $user->nickname }}">
        <small id="userNicknameHelp" class="form-text text-muted">As it will appear on your profile.</small>
        @error('nickname')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
      <label for="email" class="email">Email address</label>
      <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" placeholder="Enter email" value="{{ $user->email }}">
      <small id="emailHelp" class="form-text text-muted">We'll never share your email without your permission.</small>
      @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="gender" class="gender">Gender</label>
        <select class="form-control" id="genderId" name="genderId">
            <option>Please Select</option>
            <option value="1" @if ($user->gender_id === 1) selected="selected" @endif>Female</option>
            <option value="2" @if ($user->gender_id === 2) selected="selected" @endif>Male</option>
            <option value="3" @if ($user->gender_id === 3) selected="selected" @endif>Non-Binary</option>
        </select>
        <small id="genderHelp" class="form-text text-muted">We'll try to help suggest clothes you may like.</small>
        @error('gender_id')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Update Details</button>
</form>