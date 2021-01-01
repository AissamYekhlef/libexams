{{-- @extends('layouts.app') --}}
{{-- 
@section('title', 'Users - ')

@section('content')

  <div class="container">

    <h1>Show All users</h1>
    
    @include('dash.users.table')

  </div>

@endsection --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/admin_custom.css') }}">
@stop

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>

    @include('dash.users.table')
@stop

@section('footer')
    <p>Welcome to this beautiful admin panel Footer.</p>
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop