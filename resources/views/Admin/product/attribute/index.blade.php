@include('Admin.layouts.header')
<!-- Content Wrapper. Contains attribute content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product Attribute</h1>
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
                <div class="col-md-12 mb-4">
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <select name="category_id" id="category_id" class="form-control">
                                <option value="" disabled selected>Select Category</option>
                                @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name_en}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="subcategory_id" id="subcategory_id" class="form-control">
                                <option value="" disabled selected>Select Subcategory</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <select name="product_id" id="product_id" class="form-control">
                                <option value="" disabled selected>Select Product</option>
                            </select>
                        </div>
                    </div>
                    <div id="addNew"></div>
                </div>
                <hr>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Price Euro</th>
                            <th>Price CHF</th>
                            <th>Price USD</th>
                            <th>Price RUB</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
            <!-- /.card-footer-->
        </div>
        <!-- /.card -->

    </section>
    <form id="attributeForm">
        <div class="modal fade" id="modal-lg">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Add Attribute</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        @csrf
                                        <label for="">Attribute Type</label>
                                        <select name="attribute_id" id="attribute_id" required class="form-control">
                                            <option value="" disabled selected>Select Attribute Type</option>
                                            @foreach($types as $type)
                                            <option value="{{$type->id}}">{{$type->name_en}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Attribute Name</label>
                                        <input type="hidden" name="product_id" id="id">
                                        <input type="text" name="name" id="name" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Price Euro</label>
                                        <input type="number" min="0" step="0.01" name="price_eur" id="price_eur" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Price CHF</label>
                                        <input type="number" min="0" step="0.01" name="price_chf" id="price_chf" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Price USD</label>
                                        <input type="number" min="0" step="0.01" name="price_usd" id="price_usd" required class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Price Rub</label>
                                        <input type="number" min="0" step="0.01" name="price_rub" id="price_rub" required class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-between">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>
    <!-- /.content -->
</div>
@include('Admin.layouts.footer')
<script>
    var data = <?php echo json_encode($categories); ?>;
    var attributes = <?php echo json_encode($attributes); ?>;
    $(document).on('change', '#category_id', function() {
        var category_id = $(this).val();
        $(".table").DataTable().destroy();
        $('tbody').html('')

        reinitializeTable()
        $('#subcategory_id').html('<option value="" disabled selected>Select Subcategory</option>')
        $('#product_id').html('<option value="" disabled selected>Select Product</option>')

        data.map(function(category) {
            if (category.id == category_id) {
                category.subcategories.map(function(subcategory) {
                    $('#subcategory_id').append(`<option value="${subcategory.id}">${subcategory.name_en}</option>`)
                })

                category.products.map(function(product) {
                    $('#product_id').append(`<option value="${product.id}">${product.name_en}</option>`)
                })
            }
        })

    })


    $(document).on('change', '#subcategory_id', function() {
        $(".table").DataTable().destroy();
        $('tbody').html('')

        reinitializeTable()
        var subcategory_id = $(this).val();
        var category_id = $('#category_id').val();
        $('#product_id').html('<option value="" disabled selected>Select Product</option>')
        data.map(function(category) {
            if (category_id == category.id) {
                category.subcategories.map(function(subcategory) {
                    if (subcategory.id == subcategory_id) {
                        subcategory.products.map(function(product) {
                            $('#product_id').append(`<option value="${product.id}">${product.name_en}</option>`)
                        })
                    }
                })
            }

        })
    })
    $(document).on('change', '#product_id', function() {
        var product_id = $(this).val();
        var count = 0;
        $(".table").DataTable().destroy();
        $('tbody').html('')
        attributes.map(function(attribute) {
            if (product_id == attribute.product_id) {
                $('tbody').append(`<tr>
                <td>${attribute.name} ${attribute.details.name_en}</td>
                <td>${attribute.price_eur}</td>
                <td>${attribute.price_chf}</td>
                <td>${attribute.price_usd}</td>
                <td>${attribute.price_rub}</td>
                <td>${attribute.status == 1 ? "Active" : "Disabled"}</td>
                <td><a href="{{url('admin/product/attribute/status/${attribute.id}')}}" onclick="return confirm('Are you sure ?')" class="btn btn-app ${attribute.status == 1 ? 'bg-warning' : 'bg-success'}">
                                    ${attribute.status == 1 ? '<i class="fas fa-times"></i> Disable' :'<i class="fas fa-check"></i> Enable'}
                                </a>
                                <a class="btn btn-app bg-success" href="{{url('admin/product/attribute/edit/${attribute.id}')}}"><i class="fas fa-edit"></i>Edit / Add</a>
                                <a class="btn btn-app bg-danger" onclick="return confirm('Are you sure ?')" href="{{url('admin/product/attribute/delete/${attribute.id}')}}"><i class=" fas fa-trash"></i>Delete</a></td>
                </tr>`)
                count++
            }
        })

        reinitializeTable()
        if (count <= 0) {
            $('#addNew').html(`<a href="javascript:void(0)" id="addNewBtn" class="btn btn-md btn-success">Add New</a>`)
        } else {
            $('#addNew').html('')
        }
    })


    $(document).on('click', '#addNewBtn', function() {
        if (!$('#product_id').val()) {
            alert("Select a product first !")
        } else {
            $('#id').val($('#product_id').val())
            $('#modal-lg').modal('show')
        }
    })



    $(function() {
        var form = $('#attributeForm');
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
        $('#attributeForm').validate({
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



    function getUrlVars() {
        var vars = [],
            hash;
        var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
        for (var i = 0; i < hashes.length; i++) {
            hash = hashes[i].split('=');
            vars.push(hash[0]);
            vars[hash[0]] = hash[1];
        }
        return vars;
    }

    var category = getUrlVars()["category"];
    var subcategory = getUrlVars()["subcategory"];
    var product = getUrlVars()["product"];

    if (category) {
        $('#category_id').val(category).trigger('change')
    }
    if (subcategory) {
        $('#subcategory_id').val(subcategory).trigger('change')
    }
    if (product) {
        $('#product_id').val(product).trigger('change')
    }
</script>