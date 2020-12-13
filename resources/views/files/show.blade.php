@extends('layouts.app')

@section('content')
    
<div class="container">

    <h1>Show File From Google Drive</h1>

    {{-- <a href="{{ asset($file) }}">Open the pdf!</a> --}}

    <iframe data-src="https://drive.google.com/file/d/1NsYORz__A-PJImUYtPe-a9CnQ9Ro1hlx/preview"
    {{-- src="{{ storage_path('app/public' . $file ) }}"  --}}
    src="https://drive.google.com/file/d/1NsYORz__A-PJImUYtPe-a9CnQ9Ro1hlx/preview"
    type="application/pdf" style="width: 100%; height: 75vh">
    </iframe>

</div>

@endsection