@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

<h1>Dashboard</h1>

<div class="container">
    <div class="row">
        <div class="col" style="background:rosybrown;">
            @include('dashboard.avatar')
        </div>
        <div class="col-9">
            <ul class="nav nav-tabs" id="user_detail_panel_tabs">
                <li class="nav-item">
                    <a class="nav-link active" data-panel="user_details" href="#">Your Details</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-panel="update_password" href="#">Reset Password</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-panel="calendar" href="#">Your Calendar</a>
                </li>
            </ul>
            <div id="user_details_panels">
                <div class="user_detail_panel" id="user_details" style="display: none;">
                    @include('dashboard.user_details')
                </div>
                <div class="user_detail_panel" id="update_password" style="display: none;">
                    @include('dashboard.update_password')
                </div>
                <div class="user_detail_panel" id="calendar" style="display: none;">
                    @include('dashboard.calendar')
                </div>
            </div>
        </div>
    </div>
</div>


@endsection

@section('footer_script')
<script>
    $('#user_details').show();

    var $user_detail_tabs   = $('ul#user_detail_panel_tabs li.nav-item a.nav-link');
        $user_detail_panels = $('div#user_details_panels div.user_detail_panel');
    
    $user_detail_tabs.each(function() {
        $(this).on('click', function() {

            var $tab = $(this);

            $tab.addClass('active').siblings().removeClass('active');

            $user_detail_tabs.not(this).each(function() {
                $(this).removeClass('active');
            });

            $user_detail_panels.each(function() {
                $(this).attr('id') === $tab.data('panel') ? $(this).show() : $(this).hide();
            });
        });
    });
</script>
@endsection