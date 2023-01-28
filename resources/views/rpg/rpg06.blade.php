@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>報表管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">報表管理</li>
                <li class="breadcrumb-item active">法會查詢</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <form action="{{ route('rpg06') }}" method="get">
            @csrf
            <div class="row col-lg-12 mb-4 mt-4">
                <div class="col-auto">
                    <label for="after_date">報名日期</label>
                    <input type="date" class="form-control date" id="after_date" name="after_date"
                        value="{{ $request->after_date }}">
                </div>
                <div class="col-auto">
                    <label for="before_date">&nbsp;</label>
                    <input type="date" class="form-control date" id="before_date" name="before_date"
                      value="{{ $request->before_date }}">
                </div>
                <div class="col-auto">
                    <label for="after_date">客戶姓名</label>
                    <input type="text" class="form-control text" id="cust_name" name="cust_name"
                        value="{{ $request->cust_name }}">
                </div>
                <div class="col-auto">
                    <label for="after_date">客戶電話</label>
                    <input type="text" class="form-control text" id="cust_mobile" name="cust_mobile"
                        value="{{ $request->cust_mobile }}">
                </div>
                <div class="col-auto">
                    <div style="margin-top: 22px;">
                        <label for="after_date">&nbsp;</label>
                        <button type="submit" class="btn btn-danger">查詢</button>
                    </div>
                </div>
            </div>
        </form>
        <!-- Left side columns -->
        <div class="col-lg-12 mx-auto">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr align="center">
                                    <th scope="col">報名日期</th>
                                    <th scope="col">客戶姓名</th>
                                    <th scope="col">客戶電話</th>
                                    <th scope="col">寶貝名稱</th>
                                    <th scope="col">法會費用</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $key=>$data)
                                    <tr align="center">
                                        <td>{{ date('Y-m-d',strtotime($data->created_at)) }}</td>
                                        <td>{{ $data->sale_data->cust_name->name }}</td>
                                        <td>{{ $data->sale_data->cust_name->mobile }}</td>
                                        <td>{{ $data->sale_data->pet_name }}</td>
                                        <td>{{  number_format($data->after_prom_total) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                        {{ $datas->appends($condition)->links('vendor.pagination.bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
        </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
