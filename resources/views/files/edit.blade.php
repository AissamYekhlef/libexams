@extends('layouts.app')

@section('title', 'Edit - ' . $file->name)

{{-- @section('mode', 'bg-dark') --}}

@section('content')
    
<div class="container">

    <h1>Edit File " <a href="{{ route('files.show', ['id' => $file->id]) }}">{{ $file->name }} "</a></h1>

    <h2>The form of Edit File</h2>

    <form action="{{ route('files.update', ['id' => $file->id]) }}" method="post">
        @csrf
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Name: </label>
        <input type="text" class="form-control" name="name" value="{{ $file->name }}">
        </div>

        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Description: </label>
            <input type="text" class="form-control" name="description" value="{{ $file->description }}">
        </div>
        <div class="form-group row">
            <label for="" class="col-sm-2 col-form-label">Year: </label>
            <input type="text" name="year" value="{{ $file->year }}">
        </div>

        {{-- @php
            $levels = App\Models\Level::all();
        @endphp --}}
        <div class="form-group">
            <label for="sel1">Select Level:</label>
            <select class="form-control" id="sel1" name="level" >
                @foreach (App\Models\Level::all() as $level)
                    @if ( $file->level )
                        <option  {{ $file->level->name == $level->name ? 'selected' : NULL}}>{{ $level->name }}</option>
                    @else
                        <option>{{ $level->name }}</option>
                    @endif
                    
                @endforeach 
            </select>
          </div>

        <div class="form-check">
            <input class="form-check-input" name="confirmed" type="checkbox" {{ $file->confirmed ? 'checked' : NULL }} id="defaultCheck1">
            <label class="form-check-label" for="defaultCheck1">
              Confirmed
            </label>
        </div>



        <input type="submit" class="btn btn-success m-2">
    </form>

</div>

@endsection