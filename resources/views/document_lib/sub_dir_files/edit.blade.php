@extends('layouts.app')

@section('content')

    <div class="container">

        <h1>Edit Document Detail</h1>


        <div class="row mt-5 mb-5">
            <div class="col-md-8">

                <form method="POST" action="{{ route('dir_files.update', $file->obfuscator) }}" enctype="multipart/form-data">

                    @method('PUT')
                    {{ csrf_field() }}

                    <div class="form-group">
                        <label class="color-5 font-weight-bold">Name of File:</label>
                        <input type="text" name="file_name" class="form-control rounded-0" value="{{ $file->name }}" required>
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
