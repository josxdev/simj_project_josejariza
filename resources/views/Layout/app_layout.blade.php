@extends('adminlte::page')

@section('meta-tags')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('css')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
@stop

@section('title', $title . ' - SMIJ Jose J Ariza')
