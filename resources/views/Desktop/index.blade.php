@extends('adminlte::page')

@section('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
@stop

@section('title', $title . ' - SMIJ Jose J Ariza')

@section('content_top_nav_right')
    <p>Aqui estoy</p>
@stop

@section('content_header')
    <h1>Escritorio</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    {{-- Add here extra stylesheets --}}
    {{-- <link rel="stylesheet" href="/css/admin_custom.css"> --}}
@stop

@section('js')
    <script> console.log("Hi, I'm using the Laravel-AdminLTE package!"); </script>
@stop
