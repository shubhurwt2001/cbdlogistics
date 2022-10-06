@include('Admin.layouts.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Page</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Page</li>
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
                <form action="{{route('admin.page.save')}}" method="post">
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
                                <input type="hidden" name="id" value="{{$page->id}}">
                                <input type="text" name="title_fr" id="title_fr" class="form-control" value="{{$page->title_fr}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title_en">Title English</label>
                                <input type="text" name="title_en" id="title_en" class="form-control" value="{{$page->title_en}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title_it">Title Italiano</label>
                                <input type="text" name="title_it" id="title_it" class="form-control" value="{{$page->title_it}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="title_de">Title Deutsch</label>
                                <input type="text" name="title_de" id="title_de" class="form-control" value="{{$page->title_de}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_fr">Slug Français</label>
                                <input type="text" name="slug_fr" id="slug_fr" class="form-control" value="{{$page->slug_fr}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_en">Slug English</label>
                                <input type="text" name="slug_en" id="slug_en" class="form-control" value="{{$page->slug_en}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_it">Slug Italiano</label>
                                <input type="text" name="slug_it" id="slug_it" class="form-control" value="{{$page->slug_it}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_de">Slug Deutsch</label>
                                <input type="text" name="slug_de" id="slug_de" class="form-control" value="{{$page->slug_de}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_fr">Meta Title Français</label>
                                <input type="text" name="meta_title_fr" id="meta_title_fr" class="form-control" value="{{$page->meta_title_fr}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_en">Meta Title English</label>
                                <input type="text" name="meta_title_en" id="meta_title_en" class="form-control" value="{{$page->meta_title_en}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_it">Meta Title Italiano</label>
                                <input type="text" name="meta_title_it" id="meta_title_it" class="form-control" value="{{$page->meta_title_it}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_de">Meta Title Deutsch</label>
                                <input type="text" name="meta_title_de" id="meta_title_de" class="form-control" value="{{$page->meta_title_de}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_fr">Meta Content Français</label>
                                <input type="text" name="meta_content_fr" id="meta_content_fr" class="form-control" value="{{$page->meta_content_fr}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_en">Meta Content English</label>
                                <input type="text" name="meta_content_en" id="meta_content_en" class="form-control" value="{{$page->meta_content_en}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_it">Meta Content Italiano</label>
                                <input type="text" name="meta_content_it" id="meta_content_it" class="form-control" value="{{$page->meta_content_it}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_de">Meta Content Deutsch</label>
                                <input type="text" name="meta_content_de" id="meta_content_de" class="form-control" value="{{$page->meta_content_de}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_fr">Meta Keyword Français</label>
                                <input type="text" name="meta_keyword_fr" id="meta_keyword_fr" class="form-control" value="{{$page->meta_keyword_fr}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_en">Meta Keyword English</label>
                                <input type="text" name="meta_keyword_en" id="meta_keyword_en" class="form-control" value="{{$page->meta_keyword_en}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_it">Meta Keyword Italiano</label>
                                <input type="text" name="meta_keyword_it" id="meta_keyword_it" class="form-control" value="{{$page->meta_keyword_it}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_de">Meta Keyword Deutsch</label>
                                <input type="text" name="meta_keyword_de" id="meta_keyword_de" class="form-control" value="{{$page->meta_keyword_de}}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="content_fr">Content Français</label>
                                <textarea name="content_fr" id="content_fr" class="summernote">{{$page->content_fr}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="content_en">Content English</label>
                                <textarea name="content_en" id="content_en" class="summernote">{{$page->content_en}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="content_it">Content Italiano</label>
                                <textarea name="content_it" id="content_it" class="summernote">{{$page->content_it}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="content_de">Content Deutsch</label>
                                <textarea name="content_de" id="content_de" class="summernote">{{$page->content_de}}</textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row mt-4 mb-5">
                                <div class="col-md-4">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="in_menu" name="in_menu" @if($page->in_menu == 1) checked @endif value="1">
                                        <label for="in_menu">
                                            Show in menu
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="icheck-primary d-inline">
                                        <input type="checkbox" id="status" name="status" @if($page->status == 1) checked @endif checked value="1">
                                        <label for="status">
                                            Status
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-lg btn-success" type="submit">Save</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </section>
</div>
@include('Admin.layouts.footer')