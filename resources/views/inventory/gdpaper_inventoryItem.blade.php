@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>商品管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">商品管理</li>
                <li class="breadcrumb-item active">金紙盤點調整</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row col-lg-12 mx-auto mb-4">
            <div class="col-auto me-auto"></div>
        </div>
        <!-- Left side columns -->
        <div class="col-lg-12 mx-auto">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>
                        <form class="row g-3  pb-1" action="{{ route('inventoryItem.edit',[$type,$gdpaper_inventory_id]) }}" method="POST">
                        @csrf
                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr align="center">
                                    <th scope="col">商品名稱</th>
                                    <th scope="col">商品原庫存數量</th>
                                    <th scope="col" width="25%">盤點新數量</th>
                                    <th scope="col" width="25%">備註</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                @foreach ($datas as $data)
                                    <tr>
                                        @if($data->type == 'gd_paper')
                                            <td>{{ $data->gdpaper_name->name }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                        <td>{{ $data->old_num }}</td>
                                        @if($data->new_num == null)
                                        <td>
                                            <input type="text" class="form-control date" id="before_date" name="product[{{ $data->product_id }}]" placeholder
                                                value="">
                                        </td>
                                        @else
                                        <td>{{ $data->new_num }}</td>
                                        @endif
                                        @if($data->new_num == null)
                                        <td>
                                            <input type="text" class="form-control date" id="before_date" name="comment[{{ $data->product_id }}]" placeholder
                                                value="">
                                        </td>
                                        @else
                                        <td>{{ $data->comment }}</td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="row col-lg-12 mx-auto mb-4">
                            <div class="col-auto me-auto"></div>
                            @if($data->new_num == null)
                            <div class="col-auto">
                                <button type="submit" class="btn btn-primary">送出盤點</button>
                            </div>
                            @endif
                            <div class="col-auto">
                                <button type="button" class="btn btn-secondary" onclick="history.go(-1)">回上一頁</button>
                            </div>
                        </div>
                        

                        </form>
                        <!-- End Table with hoverable rows -->
                        {{-- {{ $gdpapers->links('vendor.pagination.bootstrap-4') }} --}}
                    </div>

                </div>
            </div>
        </div>
        </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
