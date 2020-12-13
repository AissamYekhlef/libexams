@extends('layouts.app')

@section('content')
    
<div class="container">

    <h1>Show File From Google Drive</h1>
    <h3>{{ dd($file) }}</h3>

    <a href="https://drive.google.com/file/d/1TpvRPzsFgJl-qrk1N7uecGMwoBYwvijn/view" target="_blank">open the pdf!</a>

    <iframe data-src="https://drive.google.com/file/d/1TpvRPzsFgJl-qrk1N7uecGMwoBYwvijn/preview"
    {{-- src="{{ storage_path('app/public' . $file ) }}"  --}}
    src="https://drive.google.com/file/d/1TpvRPzsFgJl-qrk1N7uecGMwoBYwvijn/preview"
    type="application/pdf" style="width: 100%; height: 75vh">
    </iframe>

</div>

@endsection