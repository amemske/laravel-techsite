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
                            <h4 class="card-title pb-4">Home Slide page</h4>
                            <form method="post" action="{{ route('update.slider') }}" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="id" value="{{ $homeslide ? $homeslide->id : '' }}" >
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"  name="title" id="title" value="{{ $homeslide ? $homeslide->title : '' }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Short title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"  name="short_title" id="short_title" value="{{ $homeslide ? $homeslide->short_title : '' }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Video Url</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="video_url"  id="video_url" value="{{ $homeslide ? $homeslide->video_url : '' }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Slider Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="home_slide" type="file"  id="image">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        @if ($homeslide && $homeslide->home_slide)
                                            <img id="showImage" class="rounded-circle avatar-xl" alt="200x200" src="{{ url($homeslide->home_slide) }}" data-holder-rendered="true">
                                        @else
                                            <img id="showImage" class="rounded-circle avatar-xl" alt="200x200" src="{{ url('upload/no_image.png') }}" data-holder-rendered="true">
                                        @endif
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Slide">
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
