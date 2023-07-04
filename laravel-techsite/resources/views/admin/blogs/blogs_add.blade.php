@extends('admin.admin_master')

@section('admin')

    <style type="text/css">
        .bootstrap-tagsinput .tag{
            margin-right: 2px;
            color: #b70000;
            font-weight: 700;
        }
    </style>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">




            <div class="row">
                <div class="col-md-6">

                    <!-- Simple card -->
                    <div class="card">

                        <div class="card-body">
                            <h4 class="card-title pb-4">Add Blog Page</h4>
                            <form method="post" action="{{ route('store.blog') }}" enctype="multipart/form-data">
                                @csrf

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog category</label>
                                    <div class="col-sm-10">
                                        <select name="blog_category_id" class="form-select" aria-label="Default select example">
                                            <option selected="">Open this select menu</option>
                                            @foreach($blogCategories as $cat)
                                                <option value="{{$cat->id}}">{{$cat->blog_category}}</option>
                                            @endforeach

                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"  name="blog_title" id="portfolio_title">
                                        @error('portfolio_title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog tags</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"  name="blog_tags" value="home,tech" data-role="tagsinput">
                                        @error('portfolio_title')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog description</label>
                                    <div class="col-sm-10">
                                        <textarea id="elm1" name="blog_description">

                                        </textarea>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="blog_image" type="file"  id="image">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img id="showImage" class="rounded-circle avatar-xl" alt="200x200" src="{{ url('upload/no_image.png')}}" data-holder-rendered="true">
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Insert Blog Data">
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

