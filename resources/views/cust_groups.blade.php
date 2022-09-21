@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>客戶管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">客戶管理</li>
                <li class="breadcrumb-item active">客戶群組</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row col-lg-12 mx-auto mb-4">
            <div class="col-auto me-auto"></div>
            <div class="col-auto">
                <a href="{{ route('new-customer.group') }}"><button type="button" class="btn btn-primary btn-sm">新增客戶群組</button></a>
            </div>
        </div>
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
                                    <th scope="col">編號</th>
                                    <th scope="col">群組名稱</th>
                                    <th scope="col">狀態</th>
                                    <th scope="col">動作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $data->id }}</td>
                                        <td>{{ $data->name }}</td>
                                        <td>
                                            @if($data->status == "up") 啟用
                                            @else <b style="color:red;">停用</b>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('edit-customer.group', $data->id) }}"><button type="button"
                                                    class="btn btn-primary btn-sm">修改</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                        {{ $datas->links('vendor.pagination.bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
        </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
