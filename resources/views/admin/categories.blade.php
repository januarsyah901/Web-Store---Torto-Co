@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>Categories</h3>
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
                        <div class="text-tiny">Category</div>
                    </li>
                </ul>
            </div>

            <div class="wg-box">
                <div class="flex items-center justify-between gap10 flex-wrap">
                    <div class="wg-filter flex-grow">
                        <form class="form-search">
                            <fieldset class="name">
                                <input type="text" placeholder="Search here..." class="" name="name"
                                       tabindex="2" value="" aria-required="true" required="">
                            </fieldset>
                            <div class="button-submit">
                                <button class="" type="submit"><i class="icon-search"></i></button>
                            </div>
                        </form>
                    </div>
                    <a class="tf-button style-1 w208" href="{{ route('admin.add_category') }}"><i
                            class="icon-plus"></i>Add new</a>
                </div>
                <div class="wg-table table-all-user">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                        <thead>
                        <tr>
                            <th style="width: 70px; text-align: center; vertical-align: middle;">#</th>
                            <th style="text-align: center; vertical-align: middle;">Slug</th>
                            <th style="width: 550px;text-align: center; vertical-align: middle;">Name</th>
                            <th style="text-align: center; vertical-align: middle;">Products</th>
                            <th style="text-align: center; vertical-align: middle;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $c)
                            <tr>
                                <td style="width: 70px; text-align: center; vertical-align: middle;">{{ $c->id }}</td>
                                <td style="text-align: center; vertical-align: middle;">{{ $c->slug }}</td>
                                <td class="name flex justify-center items-center" style="width: 550px;">
                                    <div class="image">
                                        <img src="{{ asset('uploads/categories/') }}/{{ $c->image }}" alt="{{ $c->name }}" class="image">
                                    </div>
                                    <div class="name flex justify-center items-center" style="margin-left: 12px;">
                                        <a href="#" class="body-title-2">{{ $c->name }}</a>
                                    </div>
                                </td>
                                <td style="text-align: center; vertical-align: middle;"><a href="#" target="_blank">1</a></td>
                                <td>
                                    <div class="list-icon-function " style="justify-content: center;">
                                        <a href="{{ route('admin.edit_category', ['id' => $c->id]) }}">
                                            <div class="item edit">
                                                <i class="icon-edit-3"></i>
                                            </div>
                                        </a>
                                        <form action="{{ route('admin.delete_category' , ['id' => $c->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <div class="item text-danger delete">
                                                <i class="icon-trash-2"></i>
                                            </div>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                </div>
            </div>
        </div>
    </div>
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show custom-alert h-3" role="alert">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function() {
                let alert = document.querySelector('.custom-alert');
                if (alert) {
                    alert.classList.add('fade');
                    alert.classList.remove('show');
                    setTimeout(() => {
                        alert.remove();
                    }, 500);
                }
            }, 3300);
        </script>
    @endif
@endsection

@push('scripts')
    <script>
        $(function() {
            $('.delete').on('click', function(e) {
                e.preventDefault();
                var form = $(this).closest('form');
                swal({
                    title: "Are you sure?",
                    text: "You want to delete this category?",
                    type: "warning",
                    buttons: ["No", "Yes"],
                    confirmButtonColor: "#dc3545"
                }).then(function(result) {
                    if (result) {
                        form.submit();
                    }
                });
            });
        });
    </script>
@endpush
