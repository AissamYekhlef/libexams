{{-- @extends('layouts.app') --}}

{{-- @section('title', 'Index - ') --}}

{{-- @section('content') --}}

{{-- <div class="container"> --}}

    
  
    {{-- @include('files.form_search') --}}

    {{-- @include('files.table') --}}

{{-- </div> --}}

{{-- @endsection --}}


@extends('adminlte::page')

@section('title', 'Index - ')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@stop

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <h1>Show All Files</h1>
    @include('files.table')
@stop

@section('footer')
    <p>Welcome to this beautiful admin panel Footer.</p>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop