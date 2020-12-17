@extends('layouts.app')

@section('title', 'Index - ')

@section('content')

<div class="container">

    <h1>Show All Files</h1>
    @if ($files)
    <div class="container-fluid">
        <table class="table table-bordered table-striped table-hover">
           <thead>
              <tr>
                  <th>ID</th>
                  <th>Name</th>
                  <th>Year</th>
                  <th>Level</th>
                  <th>Created By</th>
                  <th>Action</th>
              </tr>
            </thead>
            @foreach ($files as $file)
              <tr>
                  <td> {{ $file->id }} </td>
                  <td> {{ $file->name }} </td>
                  <td> {{ $file->year }} </td>
                  <td> {{ $file->level->name ?? '' }} </td>
                  <td> {{ $file->user->name ?? 'Guest' }} </td>
                  <td> 
                    <div class="dropdown">
                        <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                          More
                          <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
                          <li><a href="{{ route('files.show', ['id' => $file->id]) }}" class="btn"> Details</a></li>
                          <li><a href="{{ route('files.show', ['id' => $file->id]) }}" class="btn"> Edit</a> </li>
                          <li><a href="{{ route('files.show', ['id' => $file->id]) }}" class="btn">Delete </a> </li>
                          <li><a href="{{ route('files.download', ['id' => $file->id]) }}" class="btn">Download </a> </li>
                        </ul>
                      </div>                     
                            
                  </td>
              </tr>
            @endforeach
        </table>
    </div> 
    @else  
      <h3>
          There are no files right now
      </h3>
    @endif
 

</div>

@endsection