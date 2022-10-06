@include('Admin.layouts.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Attribute</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Create Attribute</li>
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
                <form action="{{route('admin.attribute.save')}}" method="post">
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
                                <label for="name_fr">Name Français</label>
                                <input type="text" name="name_fr" id="name_fr" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name_en">Name English</label>
                                <input type="text" name="name_en" id="name_en" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name_it">Name Italiano</label>
                                <input type="text" name="name_it" id="name_it" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name_de">Name Deutsch</label>
                                <input type="text" name="name_de" id="name_de" class="form-control" required>
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