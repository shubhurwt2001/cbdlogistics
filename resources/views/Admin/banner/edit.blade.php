@include('Admin.layouts.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Banner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Banner</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('admin.banner.save')}}" enctype="multipart/form-data" method="post">
                    @csrf
                    <div class="row">
                        @if($errors->any())
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{$errors->first()}}
                            </div>
                        </div>
                        @endif
                        @if(Session::has('error'))
                        <div class="col-md-12">
                            <div class="alert alert-danger alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{session('error')}}
                            </div>
                        </div>
                        @endif
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title_fr">Title Français</label>
                                <input type="hidden" name="id" value="{{$banner->id}}">
                                <input type="text" name="title_fr" value="{{$banner->title_fr}}" id="title_fr" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title_en">Title English</label>
                                <input type="text" name="title_en" value="{{$banner->title_en}}" id="title_en" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title_it">Title Italiano</label>
                                <input type="text" name="title_it" id="title_it" value="{{$banner->title_it}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title_de">Title Deutsch</label>
                                <input type="text" name="title_de" id="title_de" value="{{$banner->title_de}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="alt_fr">Alt Français</label>
                                <input type="text" name="alt_fr" id="alt_fr" value="{{$banner->alt_fr}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="alt_en">Alt English</label>
                                <input type="text" name="alt_en" id="alt_en" value="{{$banner->alt_en}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="alt_it">Alt Italiano</label>
                                <input type="text" name="alt_it" id="alt_it" value="{{$banner->alt_it}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="alt_de">Alt Deutsch</label>
                                <input type="text" name="alt_de" id="alt_de" value="{{$banner->alt_de}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="image">Banner Image</label>
                                <img src="{{asset('public'.$banner->url)}}" class="w-100 mb-2" alt="">
                                <input type="file" accept="image/*" name="image" id="image" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="desc_fr">Description Français</label>
                                <textarea name="desc_fr" id="desc_fr" class="summernote">
                                {{$banner->description_fr}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="desc_en">Description English</label>
                                <textarea name="desc_en" id="desc_en" class="summernote">
                                {{$banner->description_en}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="desc_it">Description Italiano</label>
                                <textarea name="desc_it" id="desc_it" class="summernote">
                                {{$banner->description_it}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="desc_de">Description Deutsch</label>
                                <textarea name="desc_de" id="desc_de" class="summernote">
                                {{$banner->description_de}}
                                </textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <button class="btn btn-lg btn-success" type="submit">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
</div>
@include('Admin.layouts.footer')