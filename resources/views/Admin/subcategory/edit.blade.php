@include('Admin.layouts.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Subcategory</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Subcategory</li>
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
                <form action="{{route('admin.subcategory.save')}}" method="post">
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
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($category->id == $subcategory->category_id) selected @endif>{{$category->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name_fr">Name Français</label>
                                <input type="hidden" name="id" required value="{{$subcategory->id}}">
                                <input type="text" name="name_fr" id="name_fr" class="form-control" value="{{$subcategory->name_fr}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name_en">Name English</label>
                                <input type="text" name="name_en" id="name_en" class="form-control" value="{{$subcategory->name_en}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name_it">Name Italiano</label>
                                <input type="text" name="name_it" id="name_it" class="form-control" value="{{$subcategory->name_it}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name_de">Name Deutsch</label>
                                <input type="text" name="name_de" id="name_de" class="form-control" value="{{$subcategory->name_de}}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_fr">Slug Français</label>
                                <input type="text" name="slug_fr" id="slug_fr" class="form-control" value="{{$subcategory->slug_fr}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_en">Slug English</label>
                                <input type="text" name="slug_en" id="slug_en" class="form-control" value="{{$subcategory->slug_en}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_it">Slug Italiano</label>
                                <input type="text" name="slug_it" id="slug_it" class="form-control" value="{{$subcategory->slug_it}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_de">Slug Deutsch</label>
                                <input type="text" name="slug_de" id="slug_de" class="form-control" value="{{$subcategory->slug_de}}" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_fr">Meta Title Français</label>
                                <input type="text" name="meta_title_fr" id="meta_title_fr" value="{{$subcategory->meta_title_fr}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_en">Meta Title English</label>
                                <input type="text" name="meta_title_en" id="meta_title_en" value="{{$subcategory->meta_title_en}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_it">Meta Title Italiano</label>
                                <input type="text" name="meta_title_it" id="meta_title_it" value="{{$subcategory->meta_title_it}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_de">Meta Title Deutsch</label>
                                <input type="text" name="meta_title_de" id="meta_title_de" value="{{$subcategory->meta_title_de}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_fr">Meta Content Français</label>
                                <input type="text" name="meta_content_fr" id="meta_content_fr" value="{{$subcategory->meta_content_fr}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_en">Meta Content English</label>
                                <input type="text" name="meta_content_en" id="meta_content_en" value="{{$subcategory->meta_content_en}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_it">Meta Content Italiano</label>
                                <input type="text" name="meta_content_it" id="meta_content_it" value="{{$subcategory->meta_content_it}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_de">Meta Content Deutsch</label>
                                <input type="text" name="meta_content_de" id="meta_content_de" value="{{$subcategory->meta_content_de}}" class="form-control">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_fr">Meta Keyword Français</label>
                                <input type="text" name="meta_keyword_fr" id="meta_keyword_fr" value="{{$subcategory->meta_keyword_fr}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_en">Meta Keyword English</label>
                                <input type="text" name="meta_keyword_en" id="meta_keyword_en" value="{{$subcategory->meta_keyword_en}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_it">Meta Keyword Italiano</label>
                                <input type="text" name="meta_keyword_it" id="meta_keyword_it" value="{{$subcategory->meta_keyword_it}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_de">Meta Keyword Deutsch</label>
                                <input type="text" name="meta_keyword_de" id="meta_keyword_de" value="{{$subcategory->meta_keyword_de}}" class="form-control">
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