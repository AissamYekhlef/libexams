@extends('layouts.app')

@section('title', 'Show - ' . $file->name)

{{-- @section('mode', 'bg-dark') --}}

@section('content')
    
<div class="container">

    <h1>Show File " {{ $file->name }} "</h1>
    {{-- <h3>{{ dd($file) }}</h3> --}}

    

    <a href="{{ route('files.download', ['id' => $file->id]) }}" target="_blank">download the pdf!</a>

    <iframe data-src="https://drive.google.com/file/d/{{ $file->file_drive_id }}/preview"
    {{-- src="{{ storage_path('app/public' . $file ) }}"  --}}
    src="https://drive.google.com/file/d/{{ $file->file_drive_id }}/preview"
    type="application/pdf" style="width: 100%; height: 90vh">
    </iframe>

</div>

@endsection