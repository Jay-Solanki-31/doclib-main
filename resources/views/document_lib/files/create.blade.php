@extends('layouts.app')

@section('content')

    <div class="container">

        <h1 >Upload Document</h1>


        <div class="row mt-5 mb-5">
            <div class="col-md-8">

                <form method="POST" action="{{ route('lib_files.store') }}" enctype="multipart/form-data">

                    {{ csrf_field() }}

                    <input type="hidden" name="directory" value="{{ $directory->id }}">

                    <div class="form-group">
                        <label class="color-5 font-weight-bold">Name of File:</label>
                        <input type="text" name="file_name" class="form-control rounded-0" required>
                    </div>

                    <label class="color-5 font-weight-bold">File to Upload:</label>
                    <div class="input-group mb-3">
                        <div class="custom-file">
                            <input type="file" class="custom-file-input rounded-0" id="fileUpload" name="lib_file">
                            <label class="custom-file-label color-5 rounded-0" for="fileUpload">Choose File</label>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <button type="submit" class="btn btn-dark btn-block rounded-0">Submit</button>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>

    <script type="text/javascript">

        $(document).ready(function(){
            //alert('its working');

            var fileLabel = $('.custom-file-label');

            $('.custom-file-input').on('change', function(){
                var fileName = $(this).val();
                //alert(fileName);

                fileLabel.text(fileName);
            });
        });

    </script>

@endsection
