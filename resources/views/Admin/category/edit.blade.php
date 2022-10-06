@include('Admin.layouts.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Category</li>
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
                <form action="{{route('admin.category.save')}}" method="post" enctype="multipart/form-data">
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
                                <input type="hidden" name="id" value="{{$category->id}}" required>
                                <label for="name_fr">Name Français</label>
                                <input type="text" name="name_fr" id="name_fr" class="form-control" value="{{$category->name_fr}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name_en">Name English</label>
                                <input type="text" name="name_en" id="name_en" class="form-control" value="{{$category->name_en}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name_it">Name Italiano</label>
                                <input type="text" name="name_it" id="name_it" class="form-control" value="{{$category->name_it}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name_de">Name Deutsch</label>
                                <input type="text" name="name_de" id="name_de" class="form-control" value="{{$category->name_de}}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_fr">Slug Français</label>
                                <input type="text" name="slug_fr" id="slug_fr" class="form-control" value="{{$category->slug_fr}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_en">Slug English</label>
                                <input type="text" name="slug_en" id="slug_en" class="form-control" value="{{$category->slug_en}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_it">Slug Italiano</label>
                                <input type="text" name="slug_it" id="slug_it" class="form-control" value="{{$category->slug_it}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_de">Slug Deutsch</label>
                                <input type="text" name="slug_de" id="slug_de" class="form-control" value="{{$category->slug_de}}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_fr">Meta Title Français</label>
                                <input type="text" name="meta_title_fr" id="meta_title_fr" class="form-control" value="{{$category->meta_title_fr}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_en">Meta Title English</label>
                                <input type="text" name="meta_title_en" id="meta_title_en" class="form-control" value="{{$category->meta_title_en}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_it">Meta Title Italiano</label>
                                <input type="text" name="meta_title_it" id="meta_title_it" class="form-control" value="{{$category->meta_title_it}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_de">Meta Title Deutsch</label>
                                <input type="text" name="meta_title_de" id="meta_title_de" class="form-control" value="{{$category->meta_title_de}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_fr">Meta Content Français</label>
                                <input type="text" name="meta_content_fr" id="meta_content_fr" class="form-control" value="{{$category->meta_content_fr}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_en">Meta Content English</label>
                                <input type="text" name="meta_content_en" id="meta_content_en" class="form-control" value="{{$category->meta_content_en}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_it">Meta Content Italiano</label>
                                <input type="text" name="meta_content_it" id="meta_content_it" class="form-control" value="{{$category->meta_content_it}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_de">Meta Content Deutsch</label>
                                <input type="text" name="meta_content_de" id="meta_content_de" class="form-control" value="{{$category->meta_content_de}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_fr">Meta Keyword Français</label>
                                <input type="text" name="meta_keyword_fr" id="meta_keyword_fr" class="form-control" value="{{$category->meta_keyword_fr}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_en">Meta Keyword English</label>
                                <input type="text" name="meta_keyword_en" id="meta_keyword_en" class="form-control" value="{{$category->meta_keyword_en}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_it">Meta Keyword Italiano</label>
                                <input type="text" name="meta_keyword_it" id="meta_keyword_it" class="form-control" value="{{$category->meta_keyword_it}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_de">Meta Keyword Deutsch</label>
                                <input type="text" name="meta_keyword_de" id="meta_keyword_de" class="form-control" value="{{$category->meta_keyword_de}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <img src="{{asset('public/'.$category->image_slug_en)}}" class="table-img mb-2">
                                <label for="image" class="w-100">Image</label>
                                <input type="file" name="image" id="image" class="form-control">
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