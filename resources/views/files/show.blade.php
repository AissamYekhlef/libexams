@extends('layouts.app')

@section('content')
    
<div class="container">

    <h1>Show File " {{ $file->name }} "</h1>
    {{-- <h3>{{ dd($file) }}</h3> --}}

    

    <a href="https://drive.google.com/file/d/{{ $file->file_drive_id }}/view" target="_blank">open the pdf!</a>

    <iframe data-src="https://drive.google.com/file/d/{{ $file->file_drive_id }}/preview"
    {{-- src="{{ storage_path('app/public' . $file ) }}"  --}}
    src="https://drive.google.com/file/d/{{ $file->file_drive_id }}/preview"
    type="application/pdf" style="width: 100%; height: 90vh">
    </iframe>

</div>

@endsection