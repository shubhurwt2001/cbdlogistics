@include('Admin.layouts.header')
<!-- Content Wrapper. Contains attribute content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Attributes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Attributes</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="card">
            <div class="card-header">
                <a href="{{url('admin/attribute/create')}}" class="btn btn-md btn-success">Add New</a>
            </div>
            <div class="card-body">
                @if(Session::has('message'))

                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{session('message')}}
                </div>

                @endif
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name Français</th>
                            <th>Name English</th>
                            <th>Name Italiano</th>
                            <th>Name Deutsch</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($attributes as $attribute)
                        <tr>
                            <td>{{$attribute->name_fr}}</td>
                            <td>{{$attribute->name_en}}</td>
                            <td>{{$attribute->name_it}}</td>
                            <td>{{$attribute->name_de}}</td>
                            <td>{{$attribute->status == 1 ? "Active": "Disabled"}}</td>
                            <td>
                                <a href="{{url('admin/attribute/status/'.$attribute->id)}}" onclick="return confirm('Are you sure ?')" class="btn btn-app @if($attribute->status == 1) bg-warning @else bg-success @endif">
                                    @if($attribute->status == 1)
                                    <i class="fas fa-times"></i>
                                    Disable
                                    @else
                                    <i class="fas fa-check"></i>
                                    Enable
                                    @endif
                                </a>
                                <a class="btn btn-app bg-success" href="{{url('admin/attribute/edit/'.$attribute->id)}}"><i class="fas fa-edit"></i>Edit</a>
                                <a class="btn btn-app bg-danger" onclick="return confirm('Are you sure ?')" href="{{url('admin/attribute/delete/'.$attribute->id)}}"><i class=" fas fa-trash"></i>Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <!-- /.content -->
</div>
@include('Admin.layouts.footer')