@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>支出管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">支出管理</li>
                <li class="breadcrumb-item active">支出Key單</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <form action="{{ route('pays') }}" method="get">
            @csrf
            <div class="row col-lg-12 mb-4 mt-4">
                <div class="col-auto">
                    <label for="after_date">支出日期</label>
                    <input type="date" class="form-control date" id="after_date" name="after_date"
                        value="{{ $request->after_date }}">
                </div>
                <div class="col-auto">
                    <label for="before_date">&nbsp;</label>
                    <input type="date" class="form-control date" id="before_date" name="before_date"
                        value="{{ $request->before_date }}">
                </div>
                <div class="col">
                    <label for="after_date">支出來源</label>
                    <select id="inputState" class="form-select" name="pay" onchange="this.form.submit()">
                        <option value="null" @if (isset($request->pay) || $request->pay == '') selected @endif>請選擇</option>
                        @foreach ($pays as $pay)
                            <option value="{{ $pay->id }}" @if ($request->pay == $pay->id) selected @endif>
                                {{ $pay->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
                    <label for="after_date">業務</label>
                    <select id="inputState" class="form-select" name="user" onchange="this.form.submit()">
                        <option value="null" @if (isset($request->user) || $request->user == '') selected @endif>請選擇</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}" @if ($request->user == $user->id) selected @endif>
                                {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col">
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
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <h2 class="card-title" style="font-size: 1.6em;text-align:right;">總支出：<b
                                        style="color:red;">{{ number_format($sum_pay) }}</b>元</h2>
                            </div>
                        </div>
                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">支出日期</th>
                                    <th scope="col">支出科目</th>
                                    <th scope="col">價格</th>
                                    <th scope="col">Key單人員</th>
                                    <th scope="col">動作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $data->pay_date }}</td>
                                        <td>{{ $data->pay_name->name }}</td>
                                        <td>{{ number_format($data->price) }}</td>
                                        <td>{{ $data->user_name->name }}</td>
                                        <td>
                                            <a href="{{ route('edit-pay', $data->id) }}"><button type="button"
                                                    class="btn btn-primary btn-sm">修改</button></a>
                                            <a href="{{ route('del-pay', $data->id) }}"><button type="button"
                                                    class="btn btn-danger btn-sm">刪除</button></a>
                                        </td>
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
