

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">{{ __('Upload Files To Google Drive') }}</div>

            <div class="card-body">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

        
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach

            <form action="{{ route('files.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <input type="file" name="pdfile" class="form-control-file" id="exampleFormControlFile1" >
                    
                </div>

                <div class="form-group row">
                    <div class="col-sm-10">
                    <input type="submit" class="btn btn-primary" value="Upload">
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>