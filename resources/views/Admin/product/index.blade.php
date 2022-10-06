@include('Admin.layouts.header')
<!-- Content Wrapper. Contains product content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Products</li>
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
                <a href="{{url('admin/product/create')}}" class="btn btn-md btn-success">Add New</a>
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
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>{{$product->name_fr}}</td>
                            <td>{{$product->name_en}}</td>
                            <td>{{$product->name_it}}</td>
                            <td>{{$product->name_de}}</td>
                            <td>{{$product->category->name_en}}</td>
                            <td>{{$product->subcategory ? $product->subcategory->name_en : 'No subcategory'}}</td>
                            <td>{{$product->status == 1 ? "Active": "Disabled"}}</td>
                            <td>
                                <a href="{{url('admin/product/status/'.$product->id)}}" onclick="return confirm('Are you sure ?')" class="btn btn-app @if($product->status == 1) bg-warning @else bg-success @endif">
                                    @if($product->status == 1)
                                    <i class="fas fa-times"></i>
                                    Disable
                                    @else
                                    <i class="fas fa-check"></i>
                                    Enable
                                    @endif
                                </a>
                                <a class="btn btn-app bg-success" href="{{url('admin/product/edit/'.$product->id)}}"><i class="fas fa-edit"></i>Edit</a>
                                <a class="btn btn-app bg-danger" onclick="return confirm('Are you sure ?')" href="{{url('admin/product/delete/'.$product->id)}}"><i class=" fas fa-trash"></i>Delete</a>
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