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
                            <h4 class="card-title pb-4">Add Blog Category Page</h4>
                            <form method="post" action="{{ route('update.blog.category', $blogcategory->id) }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Edit Blog Category name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" value="{{$blogcategory->blog_category}}" name="blog_category">

                                    </div>
                                </div>

                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Blog Category Data">
                            </form>
                        </div>
                    </div>

                </div><!-- end col -->



            </div>

        </div>

    </div>


@endsection

