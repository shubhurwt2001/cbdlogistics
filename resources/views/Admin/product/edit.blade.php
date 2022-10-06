@include('Admin.layouts.header')
<!-- Content Wrapper. Contains product content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{url('admin/dashboard')}}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
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
                        @if(Session::has('message'))
                        <div class="col-md-12">
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                {{session('message')}}
                            </div>
                        </div>
                        @endif
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="category_id">Category</label>
                                <select name="category_id" id="category_id" class="form-control" required>
                                    <option value="" disabled selected>Select Category</option>
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}" @if($category->id == $product->category_id) selected @endif>{{$category->name_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="subcategory_id">Subcategory</label>
                                <select name="subcategory_id" id="subcategory_id" class="form-control">
                                    <option value="" selected>Select Subcategory</option>
                                    @foreach($subcategories as $subcategory)
                                    @if($subcategory->category_id == $product->category_id)
                                    <option value="{{$subcategory->id}}" @if($subcategory->id == $product->subcategory_id) selected @endif>{{$subcategory->name_en}}</option>
                                    @endif
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name_fr">Name Français</label>
                                <input type="hidden" name="id" id="id" value="{{$product->id}}" class="form-control" required>
                                <input type="text" name="name_fr" id="name_fr" value="{{$product->name_fr}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name_en">Name English</label>
                                <input type="text" name="name_en" id="name_en" value="{{$product->name_en}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name_it">Name Italiano</label>
                                <input type="text" name="name_it" id="name_it" value="{{$product->name_it}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name_de">Name Deutsch</label>
                                <input type="text" name="name_de" id="name_de" value="{{$product->name_de}}" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price_eur">Price Euro</label>
                                <input type="number" min="0" step="0.01" name="price_eur" id="price_eur" value="{{$product->price_eur}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price_usd">Price USD</label>
                                <input type="number" min="0" step="0.01" name="price_usd" id="price_usd" value="{{$product->price_usd}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price_rub">Price Rubel</label>
                                <input type="number" min="0" step="0.01" name="price_rub" id="price_rub" value="{{$product->price_rub}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="price_chf">Price CHF</label>
                                <input type="number" min="0" step="0.01" name="price_chf" id="price_chf" value="{{$product->price_chf}}" class="form-control" required>
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="quantity">Quantity</label>
                                <input type="number" min="0" step="1" name="quantity" id="quantity" value="{{$product->quantity}}" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="reference">Reference</label>
                                <input type="text" name="reference" id="reference" class="form-control" value="{{$product->reference}}">
                            </div>
                        </div>

                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_fr">Slug Français</label>
                                <input type="text" name="slug_fr" id="slug_fr" class="form-control" value="{{$product->slug_fr}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_en">Slug English</label>
                                <input type="text" name="slug_en" id="slug_en" class="form-control" value="{{$product->slug_en}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_it">Slug Italiano</label>
                                <input type="text" name="slug_it" id="slug_it" class="form-control" value="{{$product->slug_it}}" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="slug_de">Slug Deutsch</label>
                                <input type="text" name="slug_de" id="slug_de" class="form-control" value="{{$product->slug_de}}" required>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group d-flex flex-wrap orderImage">
                                        @foreach($product->images as $image)
                                        <div class="prod-image table-img m-2 box drag-trigger" data-order="{{$loop->iteration}}">
                                            <img src="{{asset('public'.$image->slug_en)}}" alt="" class="w-100">
                                            <a href="{{url('admin/product-image-delete/'.$image->id)}}"><i class="fas fa-times-circle text-danger"></i></a>
                                            <p class="text-center">Image {{$loop->iteration}}</p>
                                        </div>
                                        @endforeach
                                    </div>
                                    <div class="form-group mt-4">
                                        <label for="order" class="w-100">Order Image</label>
                                        <select name="order[]" id="order" class="form-control select2 mw-25" multiple>
                                            @foreach($product->images as $image)
                                            <option value="{{$image->id}}" selected>Image {{$loop->iteration}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="images">Images</label>
                                        <input type="file" name="images[]" id="images" class="form-control mw-25" multiple>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="short_desc_fr">Short Desc. Français</label>
                                <textarea name="short_desc_fr" id="short_desc_fr" class="summernote">{{$product->short_desc_fr}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="short_desc_en">Short Desc. English</label>
                                <textarea name="short_desc_en" id="short_desc_en" class="summernote">{{$product->short_desc_en}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="short_desc_it">Short Desc. Italiano</label>
                                <textarea name="short_desc_it" id="short_desc_it" class="summernote">{{$product->short_desc_it}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="short_desc_de">Short Desc. Deutsch</label>
                                <textarea name="short_desc_de" id="short_desc_de" class="summernote">{{$product->short_desc_de}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="desc_fr">Description Français</label>
                                <textarea name="desc_fr" id="desc_fr" class="summernote">{{$product->desc_fr}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="desc_en">Description English</label>
                                <textarea name="desc_en" id="desc_en" class="summernote">{{$product->desc_en}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="desc_it">Description Italiano</label>
                                <textarea name="desc_it" id="desc_it" class="summernote">{{$product->desc_it}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="desc_de">Description Deutsch</label>
                                <textarea name="desc_de" id="desc_de" class="summernote">{{$product->desc_de}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_fr">Meta Title Français</label>
                                <input type="text" name="meta_title_fr" id="meta_title_fr" value="{{$product->meta_title_fr}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_en">Meta Title English</label>
                                <input type="text" name="meta_title_en" id="meta_title_en" value="{{$product->meta_title_en}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_it">Meta Title Italiano</label>
                                <input type="text" name="meta_title_it" id="meta_title_it" value="{{$product->meta_title_it}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_title_de">Meta Title Deutsch</label>
                                <input type="text" name="meta_title_de" id="meta_title_de" value="{{$product->meta_title_de}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_fr">Meta Content Français</label>
                                <input type="text" name="meta_content_fr" id="meta_content_fr" value="{{$product->meta_content_fr}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_en">Meta Content English</label>
                                <input type="text" name="meta_content_en" id="meta_content_en" value="{{$product->meta_content_en}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_it">Meta Content Italiano</label>
                                <input type="text" name="meta_content_it" id="meta_content_it" value="{{$product->meta_content_it}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_content_de">Meta Content Deutsch</label>
                                <input type="text" name="meta_content_de" id="meta_content_de" value="{{$product->meta_content_de}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_fr">Meta Keyword Français</label>
                                <input type="text" name="meta_keyword_fr" id="meta_keyword_fr" value="{{$product->meta_keyword_fr}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_en">Meta Keyword English</label>
                                <input type="text" name="meta_keyword_en" id="meta_keyword_en" value="{{$product->meta_keyword_en}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_it">Meta Keyword Italiano</label>
                                <input type="text" name="meta_keyword_it" id="meta_keyword_it" value="{{$product->meta_keyword_it}}" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="meta_keyword_de">Meta Keyword Deutsch</label>
                                <input type="text" name="meta_keyword_de" id="meta_keyword_de" value="{{$product->meta_keyword_de}}" class="form-control">
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
    var selected = <?php echo json_encode($product->subcategory_id); ?>;
    var images = <?php echo json_encode($product->images); ?>;
    $(document).on('change', '#category_id', function() {
        var value = $(this).val();
        $('#subcategory_id').html('<option value="" selected>Select Subcategory</option>')
        subcategories.map(function(sub, index) {
            if (sub.category_id == value) {
                $('#subcategory_id').append(`<option value="${sub.id}" ${selected == sub.id && 'selected'}>${sub.name_en}</option>`)
            }
        })
    })


    $("select").on("select2:select", function(evt) {
        var element = evt.params.data.element;
        var $element = $(element);
        $element.detach();
        $(this).append($element);
        $(this).trigger("change");
    })


    $('form').one('submit', function() {
        event.preventDefault();
        var selected = $('.select2').find('option:selected');
        if (images.length != selected.length) {
            alert('Select all images in order !')
            return
        } else {
            $('form').submit();
        }
    })
</script>