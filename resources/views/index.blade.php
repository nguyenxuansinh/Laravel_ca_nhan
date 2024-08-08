@extends('layouts.app')

@section('before-css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/index.css')}}">
    
@endsection


@section('before-js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection


@section('content')
    @include('layouts.nav')
    <div id ="content">
        @include('tasks.list_tasks', ['tasks' => $tasks])
    </div>
@endsection

@section('after-js')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="{{ asset('js/ajax.js') }}" defer></script>
@endsection