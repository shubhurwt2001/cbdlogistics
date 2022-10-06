@include('Admin.layouts.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Faq</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Faq</li>
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
                <form action="{{route('admin.faq.save')}}" method="post">
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
                                <label for="question_fr">Question Français</label>
                                <input type="hidden" name="id" value="{{$faq->id}}">
                                <input type="text" name="question_fr" id="question_fr" class="form-control" value="{{$faq->question_fr}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="question_en">Question English</label>
                                <input type="text" name="question_en" id="question_en" class="form-control" value="{{$faq->question_en}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="question_it">Question Italiano</label>
                                <input type="text" name="question_it" id="question_it" class="form-control" value="{{$faq->question_it}}">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="question_de">Question Deutsch</label>
                                <input type="text" name="question_de" id="question_de" class="form-control" value="{{$faq->question_de}}">
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="answer_fr">Answer Français</label>
                                <textarea name="answer_fr" id="answer_fr" class="summernote">{{$faq->answer_fr}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="answer_en">Answer English</label>
                                <textarea name="answer_en" id="answer_en" class="summernote">{{$faq->answer_en}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="answer_it">Answer Italiano</label>
                                <textarea name="answer_it" id="answer_it" class="summernote">{{$faq->answer_it}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="answer_de">Answer Deutsch</label>
                                <textarea name="answer_de" id="answer_de" class="summernote">{{$faq->answer_de}}</textarea>
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