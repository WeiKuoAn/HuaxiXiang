@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>客戶管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">資料管理</li>
                <li class="breadcrumb-item active">客戶管理</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <form action="{{ route('customer') }}" method="get">
            @csrf
            <div class="row g-4">
                <div class="col-md-2">
                    <label for="name">客戶姓名</label>
                    <input type="text" class="form-control date" id="name" name="name"
                        value="{{ $request->name }}">
                </div>
                <div class="col-md-2">
                    <label for="mobile">客戶電話</label>
                    <input type="text" class="form-control date" id="mobile" name="mobile"
                        value="{{ $request->mobile }}">
                </div>
                <div class="col-md-2">
                    <div style="margin-top: 22px;">
                        <label for="after_date">&nbsp;</label>
                        <button type="submit" class="btn btn-danger">查詢</button>
                    </div>
                </div>
            </div>
        </form>
        <br>
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
                                    <th scope="col">姓名</th>
                                    <th scope="col">電話</th>
                                    <th scope="col">新增時間</th>
                                    <th scope="col">動作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $customer)
                                    <tr>
                                        <td>{{ $customer->id }}</td>
                                        <td>{{ $customer->name }}</td>
                                        <td>{{ $customer->mobile }}</td>
                                        <td>{{ date('Y-m-d', strtotime($customer->created_at)) }}</td>
                                        <td>
                                            @if (Auth::user()->level != 2)
                                                <a href="{{ route('edit-customer', $customer->id) }}"><button
                                                        type="button" class="btn btn-primary btn-sm">修改</button></a>
                                                <a href="{{ route('del-customer', $customer->id) }}"><button
                                                        type="button" class="btn btn-danger btn-sm">刪除</button></a>
                                            @else
                                                <a href="{{ route('edit-customer', $customer->id) }}"><button
                                                        type="button" class="btn btn-primary btn-sm">查看</button></a>
                                            @endif
                                            <a href="{{ route('customer-sale', $customer->id) }}"><button type="button"
                                                    class="btn btn-success btn-sm">業務紀錄</button></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                        {{ $customers->links('vendor.pagination.bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
        </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
