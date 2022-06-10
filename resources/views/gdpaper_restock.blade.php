@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>金紙進貨管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">進貨管理</li>
                <li class="breadcrumb-item active">金紙進貨管理</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row col-lg-12 mx-auto mb-4">
            <div class="col-auto me-auto"></div>
            <div class="col-auto">
                <a href="{{ route('new-restock') }}"><button type="button" class="btn btn-primary btn-sm">金紙進貨</button></a>
            </div>
        </div>
        <form action="{{ route('gdpaper-restock') }}" method="get">
            @csrf
            <div class="row col-lg-12 mb-4 mt-4">
                <div class="col-auto">
                    <label for="after_date">進貨日期</label>
                    <input type="date" class="form-control date" id="after_date" name="after_date"
                        value="{{ $request->after_date }}">
                </div>
                <div class="col-auto">
                    <label for="before_date">&nbsp;</label>
                    <input type="date" class="form-control date" id="before_date" name="before_date"
                        value="{{ $request->before_date }}">
                </div>
                <div class="col">
                    <label for="after_date">金紙</label>
                    <select id="inputState" class="form-select" name="gdpaper" onchange="this.form.submit()">
                        <option value="null" @if (isset($request->gdpaper) || $request->gdpaper == '') selected @endif>請選擇</option>
                        @foreach ($gdpapers as $gdpaper)
                            <option value="{{ $gdpaper->id }}" @if ($request->gdpaper == $gdpaper->id) selected @endif>
                                {{ $gdpaper->name }}</option>
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
                        <h5 class="card-title"></h5>

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">進貨日期</th>
                                    <th scope="col">名稱</th>
                                    <th scope="col">價格</th>
                                    <th scope="col">數量</th>
                                    <th scope="col">總價</th>
                                    <th scope="col">動作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($restocks as $restock)
                                    <tr>
                                        <td>{{ $restock->date }}</td>
                                        <td>{{ $restock->gdpaper_name->name }}</td>
                                        <td>{{ number_format($restock->price) }}元</td>
                                        <td>{{ number_format($restock->num) }}個</td>
                                        <td>{{ number_format($restock->total) }}元</td>
                                        <td>
                                            <a href="{{ route('edit-restock', $restock->id) }}">
                                                <button type="button" class="btn btn-primary btn-sm">修改</button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                        {{ $restocks->appends($condition)->links('vendor.pagination.bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
        </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
