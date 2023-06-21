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
                            <form method="post" action="{{ route('store.blog.category') }}">
                                @csrf

                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Blog Category name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"  name="blog_category">
                                        @error('blog_category')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>





                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Insert Blog Category Data">
                            </form>
                        </div>
                    </div>

                </div><!-- end col -->



            </div>

        </div>

    </div>


@endsection

