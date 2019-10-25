@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h1>Dashboard</h1>

<div class="container">
    <div class="row">
        <div class="col">
            @include('dashboard.avatar')
        </div>
        <div class="col-9">
            <ul class="nav nav-tabs" id="user_detail_panel_tabs">
                <li class="nav-item">
                    <a class="nav-link" data-panel="user_details" href="#">Your Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-panel="update_password" href="#">Update Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-panel="calendar" href="#">Your Calendar</a>
                </li>
            </ul>
            <div id="user_details_panels">
                <input id="active_panel" name="active_panel" type="hidden" value="{{ $active_panel }}">
                <div class="user_detail_panel" id="user_details" style="display:none;">
                    @include('dashboard.user_details')
                </div>
                <div class="user_detail_panel" id="update_password" style="display:none;">
                    @include('dashboard.update_password')
                </div>
                <div class="user_detail_panel" id="calendar" style="display:none;">
                    @include('dashboard.calendar')
                </div>
                <div class="user_detail_panel" id="update_avatar" style="display:none;">
                    @include('avatar.edit')
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('footer_script')
<script>

    var $user_detail_links  = $('ul#user_detail_panel_tabs li.nav-item a.nav-link'),
        $avatar_mgt_links   = $('a.avatar-mgr-link'),
        $user_detail_panels = $('div#user_details_panels div.user_detail_panel'),
        $user_detail_tabs   = $user_detail_links.add($avatar_mgt_links),
        $active_panel_field = $('div#user_details_panels input#active_panel');
    
    $user_detail_panels.each(function() {

        if ($active_panel_field.val() == $(this).attr('id')) {
            $(this).show();
            // activate the correct tab
            $("ul#user_detail_panel_tabs")
                .find("[data-panel='"+$(this).attr('id')+"']")
                .addClass('active')
                .siblings().removeClass('active');
        } else {
            $(this).hide();
        }
    });
    
    $user_detail_tabs.each(function() {

        $(this).on('click', function() {

            var $tab    = $(this),
                $panel  = $tab.data('panel');

            $active_panel_field.val($panel);

            $tab.addClass('active');

            $user_detail_tabs.not(this).each(function() {
                $(this).removeClass('active');
            });

            $user_detail_panels.each(function() {
                $(this).attr('id') === $panel ? $(this).show() : $(this).hide();
            });
        });
    });
</script>
@endsection