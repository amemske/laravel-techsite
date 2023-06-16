@extends('admin.admin_master')

@section('admin')


    <div class="page-content">
        <div class="container-fluid">




            <div class="row">
                <div class="col-md-6">

                    <!-- Simple card -->
                    <div class="card">

                        <div class="card-body">
                            <h4 class="card-title pb-4">Edit  Footer Page</h4>
                            <form method="post" action="{{ route('update.footer') }}" >
                                @csrf
                                <input type="hidden" name="id" value="{{$allfooter->id}}" >
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Number</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"  name="number" id="number" value="{{$allfooter->number}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Short description</label>
                                    <div class="col-sm-10">
                                       <textarea required=""  name="short_description" class="form-control" rows="5">
                                            {{$allfooter->short_description}}
                                        </textarea>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Address</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"  name="address" id="address" value="{{$allfooter->address}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"  name="email" id="email" value="{{$allfooter->email}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">facebook</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"  name="facebook" id="facebook" value="{{$allfooter->facebook}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Twitter</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"  name="twitter" id="twitter" value="{{$allfooter->twitter}}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">copyright</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text"  name="copyright" id="copyright" value="{{$allfooter->copyright}}">
                                    </div>
                                </div>



                                <input type="submit" class="btn btn-info waves-effect waves-light" value="Update Footer">
                            </form>
                        </div>
                    </div>

                </div><!-- end col -->



            </div>

        </div>

    </div>


@endsection

