<img src="{{ $user->avatar->getPath(200) }}">

<div class="container small">

    @if ($user->avatar_type == 'custom')
        <a href="https://en.gravatar.com/">Would you rather use Gravatar?</a>
    @else
        Would you rather use a <a href="#" class="avatar-mgr-link" data-panel="update_avatar">custom avatar</a>, or <a href="https://en.gravatar.com/">your own Gravatar image</a>?
    @endif

</div>