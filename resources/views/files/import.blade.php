@extends('layouts.app')
@section('title', 'Import Files - ')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Import Files From Excel file') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                 
                    {{-- Includes the Errors and the Failuers --}}
                    @include('layouts.imports.errors')
                      

                    <form action="{{ route('files.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center form-group">
                            <input type="file" name="file" id="" required>
                            <input class="btn btn-success" type="submit" value="Import">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
