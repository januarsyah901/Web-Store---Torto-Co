@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Edit Product</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}" class="flex items-center gap5">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.products') }}">
                            <div class="text-tiny">Products</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">Edit product</div>
                    </li>
                </ul>
            </div>
            <!-- form-add-product -->
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"  action="{{ route('admin.update_product') }}">
            @csrf
                @method('PUT')
            <input type="hidden" name="id" value="{{ $product->id }}">
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Product name <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter product name"
                               name="name" tabindex="0" value="{{ $product->name }}" aria-required="true" required="">
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    @error('name')
                    <div class="text-tiny text-red-500 mb-10">{{ $message }}</div>
                    @enderror

                    <div class="gap22 cols">
                        <fieldset class="category">
                            <div class="body-title mb-10">Category <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="category_id">
                                    <option>Choose category</option>
                                    @foreach($categories as $c)
                                    <option value="{{ $c->id }}" {{ $product->category_id == $c->id ? "selected" : "" }}>{{ $c->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </fieldset>
                        @error('categories')
                        <div class="text-tiny text-red-500 mb-10">{{ $message }}</div>
                        @enderror
                        <fieldset class="brand">
                            <div class="body-title mb-10">Brand <span class="tf-color-1">*</span>
                            </div>
                            <div class="select">
                                <select class="" name="brand_id">
                                    <option>Choose Brand</option>
                                    @foreach($brands as $b)
                                    <option value="{{ $b->id }}" {{ $product->brand_id == $b->id ? "selected" : "" }}>{{ $b->name }}</option>
                                    @endforeach

                                </select>
                            </div>
                        </fieldset>
                        @error('brand_id')
                        <div class="text-tiny text-red-500 mb-10">{{ $message }}</div>
                        @enderror
                    </div>

                    <fieldset class="shortdescription">
                        <div class="body-title mb-10">Short Description <span
                                class="tf-color-1">*</span></div>
                        <textarea class="mb-10 ht-150" name="short_description"
                                  placeholder="Short Description" tabindex="0" aria-required="true"
                                  required="">{{ $product->short_description }}</textarea>
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>

                    @error('short_description')
                    <div class="text-tiny text-red-500 mb-10">{{ $message }}</div>
                    @enderror

                    <fieldset class="description">
                        <div class="body-title mb-10">Description <span class="tf-color-1">*</span>
                        </div>
                        <textarea class="mb-10" name="description" placeholder="Description"
                                  tabindex="0" aria-required="true" required="">{{ $product->description }}</textarea>
                        <div class="text-tiny">Do not exceed 100 characters when entering the
                            product name.</div>
                    </fieldset>
                    @error('description')
                    <div class="text-tiny text-red-500 mb-10">{{ $message }}</div>
                    @enderror
                </div>
                <div class="wg-box">
                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span>
                        </div>
                        <div class="upload-image flex-grow">
                            @if('image')
                                <div class="gallery-item" id="imgpreview">
                                    <img src="{{ asset('uploads/products') }}/{{$product->image}}" class="effect8" alt="">
                                </div>
                            @endif
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                                        <span class="icon">
                                                            <i class="icon-upload-cloud"></i>
                                                        </span>
                                    <span class="body-text">Drop your images here or select <span
                                            class="tf-color">click to browse</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*">
                                </label>
                            </div>
                        </div>
                    </fieldset>
                    @error('image')
                    <div class="text-tiny text-red-500 mb-10">{{ $message }}</div>
                    @enderror

                    <fieldset>
                        <div class="body-title mb-10">Upload Gallery Images</div>
                        <div class="gallery-container">
                            @if($product->images)
                                @foreach(explode(',', $product->images) as $image)
                                    <div class="gallery-item">
                                        <img src="{{ asset('uploads/products') }}/{{ trim($image) }}" alt="">
                                    </div>
                                @endforeach
                            @endif
                            <label class="gallery-upload">
                            <span class="icon">
                              <i class="icon-upload-cloud"></i>
                            </span>
                            <span class="text-tiny">Drop your images here or select <span class="tf-color">click to browse</span></span>
                            <input type="file" id="gFile" name="images[]" accept="image/*" multiple>
                            </label>
                        </div>
                    </fieldset>

                    @error('images')
                    <div class="text-tiny text-red-500 mb-10">{{ $message }}</div>
                    @enderror

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Regular Price <span
                                    class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter regular price"
                                   name="regular_price" tabindex="0" value="{{ $product->regular_price }}" aria-required="true"
                                   required="">
                        </fieldset>
                        @error('regular_price')
                        <div class="text-tiny text-red-500 mb-10">{{ $message }}</div>
                        @enderror
                        <fieldset class="name">
                            <div class="body-title mb-10">Sale Price <span
                                    class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter sale price"
                                   name="sale_price" tabindex="0" value="{{ $product->sale_price }}" aria-required="true"
                                   required="">
                        </fieldset>
                        @error('sale_price')
                        <div class="text-tiny text-red-500 mb-10">{{ $message }}</div>
                        @enderror
                    </div>


                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">SKU <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Enter SKU" name="SKU"
                                   tabindex="0" value="{{ $product->SKU }}" aria-required="true" required="">
                        </fieldset>
                        @error('SKU')
                        <div class="text-tiny text-red-500 mb-10">{{ $message }}</div>
                        @enderror
                        <fieldset class="name">
                            <div class="body-title mb-10">Quantity <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Enter quantity"
                                   name="quantity" tabindex="0" value="{{ $product->quantity }}" aria-required="true"
                                   required="">
                        </fieldset>
                        @error('quantity')
                        <div class="text-tiny text-red-500 mb-10">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="cols gap22">
                        <fieldset class="name">
                            <div class="body-title mb-10">Stock</div>
                            <div class="select mb-10">
                                <select class="" name="stock_status">
                                    <option value="instock" {{ $product->featured == "instock" ? "selected" : "" }}>InStock</option>
                                    <option value="outofstock" {{ $product->featured == "outofstock" ? "selected" : "" }}>Out of Stock</option>
                                </select>
                            </div>
                        </fieldset>
                        @error('stock_status')
                        <div class="text-tiny text-red-500 mb-10">{{ $message }}</div>
                        @enderror
                        <fieldset class="name">
                            <div class="body-title mb-10">Featured</div>
                            <div class="select mb-10">
                                <select class="" name="featured">
                                    <option value="0" {{ $product->featured == "0" ? "selected" : "" }}>No</option>
                                    <option value="1" {{ $product->featured == "1" ? "selected" : "" }}>Yes</option>
                                </select>
                            </div>
                        </fieldset>
                        @error('featured')
                        <div class="text-tiny text-red-500 mb-10">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="cols gap10">
                        <button class="tf-button w-full" type="submit"> Save</button>
                    </div>
                </div>
            </form>
            <!-- /form-add-product -->
        </div>
        <!-- /main-content-wrap -->
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            // ===================== MAIN IMAGE =====================
            const fileInput = $("#myFile");
            const dropArea = $("#upload-file");

            fileInput.on("change", function () {
                handleMainImage(this.files);
            });

            dropArea.on("dragover", function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).addClass("highlight");
            });

            dropArea.on("dragleave", function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).removeClass("highlight");
            });

            dropArea.on("drop", function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).removeClass("highlight");
                handleMainImage(e.originalEvent.dataTransfer.files);
            });

            function handleMainImage(files) {
                if (files.length > 1) {
                    alert("You can only upload one image!");
                    fileInput.val("");
                    return;
                }
                const file = files[0];
                if (file && file.type.startsWith("image/")) {
                    const imgURL = URL.createObjectURL(file);
                    $("#imgpreview img").attr("src", imgURL);
                    $("#imgpreview").show();

                    const dt = new DataTransfer();
                    dt.items.add(file);
                    fileInput[0].files = dt.files;
                } else {
                    alert("The selected file is not an image!");
                    fileInput.val("");
                }
            }

            // ===================== GALLERY IMAGES =====================
            const galleryInput = $("#gFile");
            const galleryContainer = $(".gallery-container");
            const galleryUpload = $(".gallery-upload");

            galleryInput.on("change", function () {
                handleGallery(this.files);
            });

            galleryUpload.on("dragover", function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).addClass("highlight");
            });

            galleryUpload.on("dragleave", function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).removeClass("highlight");
            });

            galleryUpload.on("drop", function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).removeClass("highlight");
                handleGallery(e.originalEvent.dataTransfer.files);
            });

            function handleGallery(files) {
                if (files.length > 10) {
                    alert("Maximum 10 images allowed!");
                    galleryInput.val("");
                    return;
                }

                // hapus semua preview sebelumnya, tapi jaga tombol upload tetap ada
                galleryContainer.find(".gallery-item").not(".gallery-upload").remove();

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    if (file && file.type.startsWith("image/")) {
                        const imgURL = URL.createObjectURL(file);
                        const imgBox = $(`
                        <div class="gallery-item">
                            <img src="${imgURL}" alt="">
                        </div>
                    `);
                        // tambahkan sebelum upload area
                        galleryUpload.before(imgBox);
                    }
                }

                // update DataTransfer
                const dt = new DataTransfer();
                for (let i = 0; i < files.length; i++) {
                    dt.items.add(files[i]);
                }
                galleryInput[0].files = dt.files;
            }
        });
    </script>

@endpush
