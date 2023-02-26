@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>進貨與盤點管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">進貨與盤點管理</li>
                <li class="breadcrumb-item active">金紙盤點</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <!-- Left side columns -->
        <div class="col-lg-12 mx-auto">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">盤點單號</th>
                                    <th scope="col">盤點日期</th>
                                    <th scope="col">盤點類別</th>
                                    <th scope="col">盤點人</th>
                                    <th scope="col" width="15%">盤點狀態</th>
                                    <th scope="col">動作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $data->inventory_no }}</td>
                                        <td>{{ $data->date }}</td>
                                        <td>
                                            @if($data->type == 'gd_paper')
                                                金紙
                                            @else
                                                其他
                                            @endif
                                        </td>
                                        <td>{{ $data->user_name->name }}</td>
                                        <td>
                                            @if($data->state == 0)
                                            <span style="color:red;">尚未盤點</span>
                                            @else
                                            
                                            {{ date('Y-m-d',strtotime($data->updated_at)) }} / 盤點完畢
                                            @endif
                                        </td>
                                        <td>
                                            @if($data->state == 0)
                                            <a href="{{ route('gdpaper.inventoryItem',[$data->type,$data->inventory_no]) }}"><button type="button"
                                                    class="btn btn-primary btn-sm">調整</button></a>
                                            @else
                                            <a href="{{ route('gdpaper.inventoryItem',[$data->type,$data->inventory_no]) }}"><button type="button"
                                                    class="btn btn-secondary btn-sm">查看</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
