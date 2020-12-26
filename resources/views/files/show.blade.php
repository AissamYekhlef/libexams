@extends('layouts.app')

@section('title', 'Show - ' . $file->name)

{{-- @section('mode', 'bg-dark') --}}

@section('content')
    
<div class="container">

    <h1>Show File</h1>
    <h2> {{ $file->description }}</h2>
    <h4> {{ $file->name }}</h4>

    

    <a href="{{ route('files.download', ['id' => $file->id]) }}" 
        class="btn btn-success" target="_blank">
        download the pdf!
    </a>
    @auth 
    @if (auth()->user()->isAdmin())
            <a href="{{ route('files.edit', ['id' => $file->id]) }}" 
                class="btn btn-primary"  target="_self"> Edit file!
            </a>
        @endif
    @endauth

    <iframe data-src="https://drive.google.com/file/d/{{ $file->file_drive_id }}/preview"
            src="https://drive.google.com/file/d/{{ $file->file_drive_id }}/preview"
            type="application/pdf" 
            style="width: 100%; height: 90vh; box-shadow: 0 2px 8px 0 rgba(63,69,81,0.16); border-radius:15px;" 
            allowtransparency="true" allowfullscreen="true">
    </iframe>

</div>

@endsection