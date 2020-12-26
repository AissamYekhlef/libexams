@extends('layouts.app')

@section('title', 'Download - ' . ($file ?  $file->name : ''))

@section('content')

    
<div class="container">
@if ($file)
    <h1>Download File " {{ $file->name ?? ''}} "</h1>

   <div class="ml-4">
        <a class="btn btn-success" href="https://drive.google.com/uc?id={{ $file->file_drive_id }}&export=download">{{__('Download the pdf')}}</a>
        <a class="btn btn-info" href="{{ route('files.show', ['id' => $file->id]) }}" target="_self">{{ __('Read the pdf!') }}</a>
   </div>
@else
    <h1>Not found </h1>
@endif

</div>

@endsection

