@extends('layouts.admin')
@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="flex items-center flex-wrap justify-between gap20 mb-27">
                <h3>All Products</h3>
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
                        <div class="text-tiny">All Products</div>
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
                    <a class="tf-button style-1 w208" href="{{ route('admin.add_product') }}"><i
                            class="icon-plus"></i>Add new</a>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                        <tr >
                            <th style="width: 70px; text-align: center; vertical-align: middle;">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">SalePrice</th>
                            <th class="text-center">SKU</th>
                            <th class="text-center">Category</th>
                            <th class="text-center">Brand</th>
                            <th class="text-center">Featured</th>
                            <th class="text-center">Stock</th>
                            <th class="text-center">Quantity</th>
                            <th class="text-center" style="width: 130px; vertical-align: middle;">Action</th>
                        </tr>
                        </thead>
                        <tbody>
                            @foreach($products as $p)
                            <tr >
                                <td style="width: 70px; text-align: center; vertical-align: middle;">{{ $loop->iteration }}</td>
                                <td class="">
                                    <div class="image">
                                        <img src="{{ asset('uploads/products') }}/{{ $p->image }}" alt="{{ $p->name }}" class="image">
                                    </div>
                                    <div class="name">
                                        <a href="#" class="body-title-2">{{ $p->name }}</a>
                                        <div class="text-tiny mt-3">{{ $p->slug }}</div>
                                    </div>
                                </td>
                                <td class="text-center">${{ number_format($p->regular_price, 2) }}</td>
                                <td class="text-center">${{ number_format($p->sale_price, 2) }}</td>
                                <td class="text-center">{{ $p->SKU }}</td>
                                <td class="text-center">{{ $p->category->name ?? '' }}</td>
                                <td class="text-center">{{ $p->brand->name ?? '' }}</td>
                                <td class="text-center">{{ $p->featured ? 'Yes' : 'No' }}</td>
                                <td class="text-center">{{ $p->stock_status }}</td>
                                <td class="text-center">{{ $p->quantity }}</td>
                                <td class="text-center align-middle">
                                    <div class="list-icon-function d-flex justify-content-center align-items-center gap-3">
                                        <a href="#" target="_blank">
                                            <div class="item eye">
                                                <i class="icon-eye"></i>
                                            </div>
                                        </a>
                                        <a href="{{ route('admin.edit_product', ['id' => $p->id]) }}">
                                            <div class="item edit">
                                                <i class="icon-edit-3"></i>
                                            </div>
                                        </a>
                                        <form action="{{ route('admin.delete_product' , ['id' => $p->id]) }}" method="POST">
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

                <div class="divider"></div>
                <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">
                    {{ $products->links('pagination::bootstrap-5') }}
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
                    text: "You want to delete this product?",
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
