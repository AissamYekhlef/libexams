@extends('layouts.app')

@section('content')
    
<div class="container">

    <h1>Upload Files To Google Drive</h1>

 
    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">{{ $error }}</div>
    @endforeach

    <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlFile1">Choose file</label>
            <input type="file" name="pdfile" class="form-control-file" id="exampleFormControlFile1" >
            
        </div>

        <div class="form-group row">
            <div class="col-sm-10">
              <input type="submit" class="btn btn-primary" value="Upload">
            </div>
          </div>
    </form>

</div>

@endsection