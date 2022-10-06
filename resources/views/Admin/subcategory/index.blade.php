@include('Admin.layouts.header')
<!-- Content Wrapper. Contains subcategory content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Subcategories</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Subcategories</li>
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
                <a href="{{url('admin/subcategory/create')}}" class="btn btn-md btn-success">Add New</a>
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
                            <th>Category</th>
                            <th>Name Français</th>
                            <th>Name English</th>
                            <th>Name Italiano</th>
                            <th>Name Deutsch</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($subcategories as $subcategory)
                        <tr>
                            <td>{{$subcategory->category->name_en}}</td>
                            <td>{{$subcategory->name_fr}}</td>
                            <td>{{$subcategory->name_en}}</td>
                            <td>{{$subcategory->name_it}}</td>
                            <td>{{$subcategory->name_de}}</td>
                            <!-- <td>{{$subcategory->in_menu == 1 ? "Active": "Disabled"}}</td> -->
                            <td>{{$subcategory->status == 1 ? "Active": "Disabled"}}</td>
                            <td>
                                <a href="{{url('admin/subcategory/status/'.$subcategory->id)}}" onclick="return confirm('Are you sure ?')" class="btn btn-app @if($subcategory->status == 1) bg-warning @else bg-success @endif">
                                    @if($subcategory->status == 1)
                                    <i class="fas fa-times"></i>
                                    Disable
                                    @else
                                    <i class="fas fa-check"></i>
                                    Enable
                                    @endif
                                </a>
                                <a class="btn btn-app bg-success" href="{{url('admin/subcategory/edit/'.$subcategory->id)}}"><i class="fas fa-edit"></i>Edit</a>
                                <a class="btn btn-app bg-danger" onclick="return confirm('Are you sure ?')" href="{{url('admin/subcategory/delete/'.$subcategory->id)}}"><i class=" fas fa-trash"></i>Delete</a>
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