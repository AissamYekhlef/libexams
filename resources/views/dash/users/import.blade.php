@extends('layouts.app')
@section('title', 'Import Users - ')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Import Users Excel file') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (isset($errors) && $errors->any())
                        <div class="alert alert-danger">
                            @foreach ($errors->all() as $error)
                                {{ $error }}
                            @endforeach
                        </div>
                    @endif

                    @if (session()->has('failures'))
                        <div class="row justify-content-center text-danger">
                                <h2>Failures</h2>
                            </div>
                        <table class="table table-bordered table-striped table-hover table-danger">
                            
                           <tr>
                               <th>Row</th>
                               <th>Attribute</th>
                               <th>Error</th>
                               <th>Value</th>
                           </tr>
                           @foreach (session()->get('failures') as $validation)
                               <tr>
                                    <td>{{ $validation->row() }}</td>
                                    <td>{{ $validation->attribute() }}</td>
                                    <td>
                                        <ul>
                                            @foreach ($validation->errors() as $error)
                                                <li> {{ $error }} </li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $validation->values()[$validation->attribute()] }}</td>
                               </tr>
                           @endforeach
                        </table>
                    @endif

                    <form action="{{ route('users.import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row justify-content-center form-group">
                            <input type="file" name="file" id="" required>
                            <input class="btn btn-success" type="submit" value="Import">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
