@include('Admin.layouts.header')
<!-- Content Wrapper. Contains product content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Create Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Create Product</li>
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
                <form action="{{route('admin.product.save')}}" method="post" enctype="multipart/form-data">
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
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="subcategory_id">Subcategory</label>
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value="" selected>Select Subcategory</option>
                                </select>
                            </div>
                        </div>
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

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price_eur">Price Euro</label>
                                <input type="number" min="0" step="0.1" name="price_eur" id="price_eur" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price_usd">Price USD</label>
                                <input type="number" min="0" step="0.1" name="price_usd" id="price_usd" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price_rub">Price Rubel</label>
                                <input type="number" min="0" step="0.1" name="price_rub" id="price_rub" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price_chf">Price CHF</label>
                                <input type="number" min="0" step="0.1" name="price_chf" id="price_chf" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" min="0" step="1" name="quantity" id="quantity" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="reference">Reference</label>
                                <input type="text" name="reference" id="reference" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="images">Images</label>
                                <input type="file" name="images[]" accept="image/*" id="images" class="form-control" multiple required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_fr">Slug Français</label>
                                <input type="text" name="slug_fr" id="slug_fr" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_en">Slug English</label>
                                <input type="text" name="slug_en" id="slug_en" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_it">Slug Italiano</label>
                                <input type="text" name="slug_it" id="slug_it" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_de">Slug Deutsch</label>
                                <input type="text" name="slug_de" id="slug_de" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-12"></div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="short_desc_fr">Short Desc. Français</label>
                                <textarea name="short_desc_fr" id="short_desc_fr" class="summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="short_desc_en">Short Desc. English</label>
                                <textarea name="short_desc_en" id="short_desc_en" class="summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="short_desc_it">Short Desc. Italiano</label>
                                <textarea name="short_desc_it" id="short_desc_it" class="summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="short_desc_de">Short Desc. Deutsch</label>
                                <textarea name="short_desc_de" id="short_desc_de" class="summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="desc_fr">Description Français</label>
                                <textarea name="desc_fr" id="desc_fr" class="summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="desc_en">Description English</label>
                                <textarea name="desc_en" id="desc_en" class="summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="desc_it">Description Italiano</label>
                                <textarea name="desc_it" id="desc_it" class="summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="desc_de">Description Deutsch</label>
                                <textarea name="desc_de" id="desc_de" class="summernote"></textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_fr">Meta Title Français</label>
                                <input type="text" name="meta_title_fr" id="meta_title_fr" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_en">Meta Title English</label>
                                <input type="text" name="meta_title_en" id="meta_title_en" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_it">Meta Title Italiano</label>
                                <input type="text" name="meta_title_it" id="meta_title_it" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_de">Meta Title Deutsch</label>
                                <input type="text" name="meta_title_de" id="meta_title_de" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_fr">Meta Content Français</label>
                                <input type="text" name="meta_content_fr" id="meta_content_fr" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_en">Meta Content English</label>
                                <input type="text" name="meta_content_en" id="meta_content_en" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_it">Meta Content Italiano</label>
                                <input type="text" name="meta_content_it" id="meta_content_it" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_de">Meta Content Deutsch</label>
                                <input type="text" name="meta_content_de" id="meta_content_de" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_fr">Meta Keyword Français</label>
                                <input type="text" name="meta_keyword_fr" id="meta_keyword_fr" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_en">Meta Keyword English</label>
                                <input type="text" name="meta_keyword_en" id="meta_keyword_en" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_it">Meta Keyword Italiano</label>
                                <input type="text" name="meta_keyword_it" id="meta_keyword_it" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_de">Meta Keyword Deutsch</label>
                                <input type="text" name="meta_keyword_de" id="meta_keyword_de" class="form-control">
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
<script>
    var subcategories = <?php echo json_encode($subcategories); ?>;
    $(document).on('change', '#category_id', function() {
        var value = $(this).val();
        $('#subcategory_id').html('<option value="" selected>Select Subcategory</option>')
        subcategories.map(function(sub, index) {
            if (sub.category_id == value) {
                $('#subcategory_id').append(`<option value="${sub.id}">${sub.name_en}</option>`)
            }
        })
    })
</script>