@extends('admin.layouts.master')
@section('title', 'Report')
@section('main-header', 'Report')
@section('title_header', 'Report')
@section('header', 'Products')
@section('content')
    <div class="card">
        <div class="card-header">
            <form class="w-25" id="filterForm" action="{{route('admin.report.index')}}" method="Get">
                <div class="form-group">
                    <select id="filterSelect" name="id" class="form-select">
                        <option selected disabled>Select Category</option>
                        @foreach(\App\Models\NameCategory::all() as $cat)
                            <option value="{{$cat->id}}">{{$cat->title}}</option>
                        @endforeach
                    </select>
                </div>
            </form>
        </div>
        <div class="card-body">
            @if(isset($products) && !empty($products))
                <table class="table table-bordered table-hover">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Id</th>
                        <th>Vendor</th>
                        <th>Sale</th>
                        <th>Total Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($products as $index => $product)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{$product->id}}</td>
                            <td>{{$product->vendor->name}}</td>
                            <td>{{$product->sale}}</td>
                            <td>{{$product->sale * $product->price}}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="3">Total</td>
                        <td>{{$products->sum('sale')}}</td>
                        <td>ــــــــــــ</td>
                    </tr>
                    </tbody>
                </table>
            @endif
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        let form = document.getElementById('filterForm');
        let select = document.getElementById('filterSelect');

        select.addEventListener('change', function () {
            form.submit();
        });
    </script>
@endsection
