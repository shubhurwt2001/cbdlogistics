@include('Admin.layouts.header')
<!-- Content Wrapper. Contains attribute content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Attribute - {{$product->attribute->name_en}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Product Attribute</li>
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
                @if(Session::has('message'))

                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    {{session('message')}}
                </div>

                @endif
                @foreach($product->attributes as $attribute)
                <form action="{{route('admin.product.attribute.save')}}" id="form_{{$attribute->id}}" method="POST">
                    @csrf
                    <div id="accordion_db_{{$attribute->id}}">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne_db_{{$attribute->id}}" aria-expanded="false">
                                        {{$attribute->name}} {{$product->attribute->name_en}}
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne_db_{{$attribute->id}}" class="collapse" data-parent="#accordion_db_{{$attribute->id}}">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="hidden" name="id" value="{{$attribute->id}}" required>
                                                    <input type="hidden" name="product_id" value="{{$product->id}}" required>
                                                    <input type="hidden" name="attribute_id" value="{{$product->attribute->id}}" required>
                                                    <input type="text" name="name" value="{{$attribute->name}}" id="name" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Price Euro</label>
                                                    <input type="number" min="0" step="0.01" name="price_eur" id="price_eur" value="{{$attribute->price_eur}}" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Price CHF</label>
                                                    <input type="number" min="0" step="0.01" name="price_chf" id="price_chf" value="{{$attribute->price_chf}}" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Price USD</label>
                                                    <input type="number" min="0" step="0.01" name="price_usd" id="price_usd" value="{{$attribute->price_usd}}" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Price Ruble</label>
                                                    <input type="number" min="0" step="0.01" name="price_rub" id="price_rub" value="{{$attribute->price_rub}}" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                @endforeach

                <form action="{{route('admin.product.attribute.save')}}" id="form_new" method="POST">
                    @csrf
                    <div id="accordion_1">
                        <div class="card card-primary">
                            <div class="card-header">
                                <h4 class="card-title w-100">
                                    <a class="d-block w-100 collapsed" data-toggle="collapse" href="#collapseOne_1" aria-expanded="false">
                                        Add New Attribute
                                    </a>
                                </h4>
                            </div>
                            <div id="collapseOne_1" class="collapse" data-parent="#accordion_1">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label for="">Name</label>
                                                    <input type="hidden" name="product_id" value="{{$product->id}}" required>
                                                    <input type="hidden" name="attribute_id" value="{{$product->attribute->id}}" required>
                                                    <input type="text" name="name" id="name" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Price Euro</label>
                                                    <input type="number" min="0" step="0.01" name="price_eur" id="price_eur" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Price CHF</label>
                                                    <input type="number" min="0" step="0.01" name="price_chf" id="price_chf" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Price USD</label>
                                                    <input type="number" min="0" step="0.01" name="price_usd" id="price_usd" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    <label for="">Price Ruble</label>
                                                    <input type="number" min="0" step="0.01" name="price_rub" id="price_rub" required class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-success">Add</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>

    <!-- /.content -->
</div>
@include('Admin.layouts.footer')

@foreach($product->attributes as $attribute)
<script>
    $(function() {
        var form = $('#form_{{$attribute->id}}')
        $.validator.setDefaults({
            submitHandler: function() {
                $('.btn-primary').attr('disabled', true)
                $.ajax({
                    data: form.serialize(),
                    type: "post",
                    url: `{{route('admin.product.attribute.save')}}`,
                    success: function(data) {
                        alert(data.message)
                        window.location.reload();
                    },
                    error: function(err) {
                        $('.btn-primary').attr('disabled', false)
                        alert(err.responseJSON.message)
                    }
                })
            }
        });
        $('#form_{{$attribute->id}}').validate({
            rules: {
                name: {
                    required: true,
                },
                product_id: {
                    required: true,
                },
                attribute_id: {
                    required: true,
                },
                product_id: {
                    required: true
                },
                price_chf: {
                    required: true
                },
                price_eur: {
                    required: true
                },
                price_rub: {
                    required: true
                },
                price_usd: {
                    required: true
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
@endforeach
<script>
    $(function() {
        var form = $('#form_new')
        $.validator.setDefaults({
            submitHandler: function() {
                $('.btn-primary').attr('disabled', true)
                $.ajax({
                    data: form.serialize(),
                    type: "post",
                    url: `{{route('admin.product.attribute.save')}}`,
                    success: function(data) {
                        alert(data.message)
                        window.location.reload();
                    },
                    error: function(err) {
                        $('.btn-primary').attr('disabled', false)
                        alert(err.responseJSON.message)
                    }
                })
            }
        });
        $('#form_new').validate({
            rules: {
                name: {
                    required: true,
                },
                product_id: {
                    required: true,
                },
                attribute_id: {
                    required: true,
                },
                product_id: {
                    required: true
                },
                price_chf: {
                    required: true
                },
                price_eur: {
                    required: true
                },
                price_rub: {
                    required: true
                },
                price_usd: {
                    required: true
                },
            },
            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>