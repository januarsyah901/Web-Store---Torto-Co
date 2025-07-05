@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Add Product</h3>
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
                        <div class="text-tiny">Add product</div>
                    </li>
                </ul>
            </div>
            <!-- form-add-product -->
            <form class="tf-section-2 form-add-product" method="POST" enctype="multipart/form-data"
                  action="{{ route('admin.store_product') }}">
            @csrf
                <div class="wg-box">
                    <fieldset class="name">
                        <div class="body-title mb-10">Product name <span class="tf-color-1">*</span>
                        </div>
                        <input class="mb-10" type="text" placeholder="Enter product name"
                               name="name" tabindex="0" value="{{ old('name') }}" aria-required="true" required="">
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
                                    <option value="{{ $c->id }}">{{ $c->name }}</option>
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
                                    <option value="{{ $b->id }}">{{ $b->name }}</option>
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
                                  required="">{{ old('short_description') }}</textarea>
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
                                  tabindex="0" aria-required="true" required="">{{ old('description') }}</textarea>
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
                            <div class="item" id="imgpreview" style="display:none">
                                <img src=""
                                     class="effect8" alt="">
                            </div>
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
                        <div class="upload-image mb-16">
                            <div id="galUpload" class="item up-load">
                                <label class="uploadfile" for="gFile">
                                                        <span class="icon">
                                                            <i class="icon-upload-cloud"></i>
                                                        </span>
                                    <span class="text-tiny">Drop your images here or select <span
                                            class="tf-color">click to browse</span></span>
                                    <input type="file" id="gFile" name="images[]" accept="image/*"
                                           multiple="">
                                </label>
                            </div>
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
                                   name="regular_price" tabindex="0" value="{{ old('regular_price') }}" aria-required="true"
                                   required="">
                        </fieldset>
                        @error('regular_price')
                        <div class="text-tiny text-red-500 mb-10">{{ $message }}</div>
                        @enderror
                        <fieldset class="name">
                            <div class="body-title mb-10">Sale Price <span
                                    class="tf-color-1">*</span></div>
                            <input class="mb-10" type="text" placeholder="Enter sale price"
                                   name="sale_price" tabindex="0" value="{{ old('sale_price') }}" aria-required="true"
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
                                   tabindex="0" value="{{ old('SKU') }}" aria-required="true" required="">
                        </fieldset>
                        @error('SKU')
                        <div class="text-tiny text-red-500 mb-10">{{ $message }}</div>
                        @enderror
                        <fieldset class="name">
                            <div class="body-title mb-10">Quantity <span class="tf-color-1">*</span>
                            </div>
                            <input class="mb-10" type="text" placeholder="Enter quantity"
                                   name="quantity" tabindex="0" value="{{ old('quantity') }}" aria-required="true"
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
                                    <option value="instock">InStock</option>
                                    <option value="outofstock">Out of Stock</option>
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
                                    <option value="0">No</option>
                                    <option value="1">Yes</option>
                                </select>
                            </div>
                        </fieldset>
                        @error('featured')
                        <div class="text-tiny text-red-500 mb-10">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="cols gap10">
                        <button class="tf-button w-full" type="submit">Add product</button>
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
            const galleryArea = $("#galUpload");

            galleryInput.on("change", function () {
                handleGallery(this.files);
            });

            galleryArea.on("dragover", function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).addClass("highlight");
            });
            galleryArea.on("dragleave", function (e) {
                e.preventDefault();
                e.stopPropagation();
                $(this).removeClass("highlight");
            });
            galleryArea.on("drop", function (e) {
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

                $(".gallery-preview").remove(); // hapus preview sebelumnya

                for (let i = 0; i < files.length; i++) {
                    const file = files[i];
                    if (file && file.type.startsWith("image/")) {
                        const imgURL = URL.createObjectURL(file);

                        const imgBox = $(`<div class="item gallery-preview"><img src="${imgURL}" class="effect8" alt=""></div>`);
                        galleryArea.before(imgBox);
                    }
                }
                // supaya input file juga sinkron
                const dt = new DataTransfer();
                for (let i = 0; i < files.length; i++) {
                    dt.items.add(files[i]);
                }
                galleryInput[0].files = dt.files;
            }
        });
    </script>
@endpush
