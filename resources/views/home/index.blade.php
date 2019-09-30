@extends('layouts.app')

@section('title', 'Welcome')

@section('content')

    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif

    <div class="title m-b-md">
        DIBBS
    </div>

@endsection