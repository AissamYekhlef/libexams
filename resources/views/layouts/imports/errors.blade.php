
@if (\Session::has('rows_count'))
   <div class="alert alert-success" role="alert">
       {!! 
           Session::get('rows_count') > 0 
           ? 'Added ' . Session::get('rows_count') . ' ' . Str::plural('Object', Session::get('rows_count'))
           : 'No Object Added'
       !!}  
   </div>
@endif


{{-- Includes the Errors and the Failuers --}}
@if (isset($errors) && $errors->any())
    <div class="alert alert-danger">
        @foreach ($errors->all() as $error)
            {{ $error }}
        @endforeach
    </div>
@endif

@if (session()->has('failures'))
    <div class="row justify-content-center text-danger">
            <h2>Failures ( {{ session()->get('failures')->count() }} )</h2>
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