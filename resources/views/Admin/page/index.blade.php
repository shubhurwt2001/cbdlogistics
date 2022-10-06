@include('Admin.layouts.header')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pages</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Pages</li>
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
                <a href="{{url('admin/page/create')}}" class="btn btn-md btn-success">Add New</a>
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
                            <th>Show in menu</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pages as $page)
                        <tr>
                            <td>{{$page->title_fr}}</td>
                            <td>{{$page->title_en}}</td>
                            <td>{{$page->title_it}}</td>
                            <td>{{$page->title_de}}</td>
                            <td>{{$page->in_menu == 1 ? "Active": "Disabled"}}</td>
                            <td>{{$page->status == 1 ? "Active": "Disabled"}}</td>
                            <td>
                                <a href="{{url('admin/page/status/'.$page->id)}}" onclick="return confirm('Are you sure ?')" class="btn btn-app @if($page->status == 1) bg-warning @else bg-success @endif">
                                    @if($page->status == 1)
                                    <i class="fas fa-times"></i>
                                    Disable
                                    @else
                                    <i class="fas fa-check"></i>
                                    Enable
                                    @endif
                                </a>
                                <a class="btn btn-app bg-success" href="{{url('admin/page/edit/'.$page->id)}}"><i class="fas fa-edit"></i>Edit</a>
                                <a class="btn btn-app bg-danger" onclick="return confirm('Are you sure ?')" href="{{url('admin/page/delete/'.$page->id)}}"><i class=" fas fa-trash"></i>Delete</a>
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