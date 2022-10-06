@include('Admin.layouts.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Banners</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Banners</li>
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
                <a href="{{url('admin/banner/create')}}" class="btn btn-md btn-success">Add New</a>
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
                            <th>Title Français</th>
                            <th>Title English</th>
                            <th>Title Italiano</th>
                            <th>Title Deutsch</th>
                            <th>Banner</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($banners as $banner)
                        <tr>
                            <td>{{$banner->title_fr}}</td>
                            <td>{{$banner->title_en}}</td>
                            <td>{{$banner->title_it}}</td>
                            <td>{{$banner->title_de}}</td>
                            <td><img class="table-img" src="{{asset('public'.$banner->url)}}"></td>
                            <td>{{$banner->status == 1 ? "Active": "Disabled"}}</td>
                            <td>
                                <a href="{{url('admin/banner/status/'.$banner->id)}}" onclick="return confirm('Are you sure ?')" class="btn btn-app @if($banner->status == 1) bg-warning @else bg-success @endif">
                                    @if($banner->status == 1)
                                    <i class="fas fa-times"></i>
                                    Disable
                                    @else
                                    <i class="fas fa-check"></i>
                                    Enable
                                    @endif
                                </a>
                                <a class="btn btn-app bg-success" href="{{url('admin/banner/edit/'.$banner->id)}}"><i class="fas fa-edit"></i>Edit</a>
                                <a class="btn btn-app bg-danger" onclick="return confirm('Are you sure ?')" href="{{url('admin/banner/delete/'.$banner->id)}}"><i class=" fas fa-trash"></i>Delete</a>
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