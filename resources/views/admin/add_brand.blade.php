@extends('layouts.admin');
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Brand infomation</h3>
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
                        <a href="{{ route('admin.brands') }}">
                            <div class="text-tiny">Brands</div>
                        </a>
                    </li>
                    <li>
                        <i class="icon-chevron-right"></i>
                    </li>
                    <li>
                        <div class="text-tiny">New Brand</div>
                    </li>
                </ul>
            </div>
            <!-- new-category -->
            <div class="wg-box">
                <form class="form-new-product form-style-1" action="{{ route('admin.store_brand') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <fieldset class="name">
                        <div class="body-title">Brand Name <span class="tf-color-1">*</span></div>
                        <input class="flex-grow" type="text" placeholder="Brand name" name="name" tabindex="0" value="{{ old('name') }}" aria-required="true" required="">
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
        $("#myFile").on("change", function (e) {
            const files = this.files;

            if (files.length > 1) {
                alert("You can only upload one image!");
                this.value = ""; // Reset input
                return;
            }

            const file = files[0];
            if (file && file.type.startsWith("image/")) {
                const imgURL = URL.createObjectURL(file);
                $("#imgpreview img").attr("src", imgURL);
                $("#imgpreview").show();
            } else {
                alert("The selected file is not an image!");
                this.value = ""; // Reset input
            }
        });
    });
</script>
@endpush
