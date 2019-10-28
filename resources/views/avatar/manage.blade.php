<h4>Manage your Avatar</h4>

@if ($user->avatar_type == 'custom')
    You are using a custom avatar
@else
    You are using a Gravatar image 
    @if ($user->avatar->isGeneratedGravatar()) 
        that has been automatically generated for you:
    @else
        that you have specifically selected: 
    @endif
    <img src="{{ $user->avatar->getPath(200) }}">
    
@endif

<hr>

@if ($user->avatar_type == 'custom')
        <a href="https://en.gravatar.com/">Would you rather use Gravatar?</a>
@else
    Would you rather use a <a href="#" class="avatar-mgr-link" data-panel="manage_avatar">custom avatar</a>, or <a href="https://en.gravatar.com/">your own Gravatar image</a>?
@endif

<hr>

<ul>
    <li>Show current setting of custom/Gravatar</li>
    <li>Any current avatars</li>
    <li>Upload form</li>
    <li>Option to use Gravatar</li>
    <li>Link to Gravatar</li>
</ul>  