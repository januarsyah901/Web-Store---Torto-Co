@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <!-- main-content-wrap -->
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Category infomation</h3>
                <ul class="breadcrumbs flex items-center flex-wrap justify-start gap10">
                    <li>
                        <a href="{{ route('admin.index') }}">
                            <div class="text-tiny">Dashboard</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <a href="{{ route('admin.categories') }}">
                            <div class="text-tiny">Categories</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">New Category</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.store_category') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Brand Name <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Category name" name="name" tabindex="0" value="{{ old('name') }}" aria-required="true" required="">
                    </fieldset>
                    @error('name')
                    <div class="alert alert-danger">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror
                    <fieldset>
                        <div class="body-title">Upload images <span class="tf-color-1">*</span></div>
                        <div class="upload-image flex-grow">
                            <div class="item" id="imgpreview" style="display:none">
                                <img src="" class="effect8" alt="Preview Gambar" />
                            </div>
                            <div id="upload-file" class="item up-load">
                                <label class="uploadfile" for="myFile">
                                    <span class="icon"><i class="icon-upload-cloud"></i></span>
                                    <span class="body-text">Drop your images here or select <span class="tf-color">click to browse</span></span>
                                    <input type="file" id="myFile" name="image" accept="image/*" />
                                </label>
                            </div>
                        </div>
                    </fieldset>

                    @error('image')
                    <div class="alert alert-danger">
                        <strong>{{ $message }}</strong>
                    </div>
                    @enderror

                    <div class="bot">
                        <div></div>
                        <button class="tf-button w208" type="submit">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script>
        $(function () {
            const fileInput = $("#myFile");
            const dropArea = $("#upload-file");

            // HANDLE FILE SELECTION VIA INPUT
            fileInput.on("change", function (e) {
                handleFile(this.files);
            });

            // HANDLE DRAG AND DROP
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
                const dtFiles = e.originalEvent.dataTransfer.files;
                handleFile(dtFiles);
            });

            function handleFile(files) {
                if (files.length > 1) {
                    alert("You can only upload one image!");
                    fileInput.val(""); // reset
                    return;
                }
                const file = files[0];
                if (file && file.type.startsWith("image/")) {
                    const imgURL = URL.createObjectURL(file);
                    $("#imgpreview img").attr("src", imgURL);
                    $("#imgpreview").show();

                    // supaya input file juga terisi kalau drop:
                    const dataTransfer = new DataTransfer();
                    dataTransfer.items.add(file);
                    fileInput[0].files = dataTransfer.files;

                } else {
                    alert("The selected file is not an image!");
                    fileInput.val("");
                }
            }
        });
    </script>
@endpush

