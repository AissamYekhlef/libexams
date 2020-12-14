@extends('layouts.app')

@section('content')
    
<div class="container">

    <h1>Show File From Google Drive</h1>
    {{-- <h3>{{ dd($file) }}</h3> --}}

    

    <a href="{{ $url }}" target="_blank">open the pdf!</a>

    <iframe data-src="{{ $url }}"
    {{-- src="{{ storage_path('app/public' . $file ) }}"  --}}
    src="{{ $url }}"
    type="application/pdf" style="width: 100%; height: 75vh">
    </iframe>

</div>

@endsection