@extends('admin.admin_master')

@section('admin')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">




            <div class="row">
                <div class="col-md-6">

                    <!-- Simple card -->
                    <div class="card">

                        <div class="card-body">
                            <h4 class="card-title pb-4">Add/Edit Portfolio Page</h4>
                            <form method="post" action="{{ route('store.portfolio') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"  name="portfolio_name" id="portfolio_name ">
                                        @error('portfolio_name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"  name="portfolio_title" id="portfolio_title">
                                        @error('portfolio_title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio description</label>
                                    <div class="col-sm-10">
                                        <textarea id="elm1" name="portfolio_description">

                                        </textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Portfolio Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="portfolio_image" type="file"  id="image">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded-circle avatar-xl" alt="200x200" src="{{ url('upload/no_image.png')}}" data-holder-rendered="true">
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Insert Portfolio Data">
                            </form>
                        </div>
                    </div>

                </div><!-- end col -->



            </div>

        </div>

    </div>
    <script type="text/javascript">
        $(document).ready(function() {
            //listens for the "change" event, which typically occurs when the user selects a file using an input of type "file".
            $('#image').change(function(e) {
                //FileReader provides methods for reading the contents of a file asynchronously.
                const reader = new FileReader();
                reader.onload = function(e) {
                    //The onload event is triggered when the file reading operation is successfully completed.
                    $('#showImage').attr('src', e.target.result);
                };
                //This method reads the file and converts it to a data URL
                reader.readAsDataURL(e.target.files[0]);
            });
        });

    </script>

@endsection

