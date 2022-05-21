@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>業務管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">業務管理</li>
                <li class="breadcrumb-item active">業務待確認對帳</li>
            </ol>
            {{-- <div class="col-auto">
                <a href="{{ route('new-sale') }}"><button type="button" class="btn btn-primary btn-sm">新增業務</button></a>
            </div> --}}
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
                                    <th scope="col">單號</th>
                                    <th scope="col">Key單人員</th>
                                    <th scope="col">日期</th>
                                    <th scope="col">客戶</th>
                                    <th scope="col">類別</th>
                                    <th scope="col">方案</th>
                                    <th scope="col">金紙</th>
                                    <th scope="col">後續處理A</th>
                                    <th scope="col">後續處理B</th>
                                    <th scope="col">付款方式</th>
                                    <th scope="col">總價格</th>
                                    <th scope="col">動作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->sale_on }}</td>
                                        <td>{{ $sale->user_name->name }}</td>
                                        <td>{{ $sale->sale_date }}</td>
                                        <td>{{ $sale->cust_name->name }}</td>
                                        <td>{{ $sale->type() }}</td>
                                        <td>{{ $sale->plan_name->name }}</td>
                                        <td>
                                            @foreach ($sale->gdpapers as $gdpaper)
                                                @if (isset($gdpaper->gdpaper_id))
                                                    {{ $gdpaper->gdpaper_name->name }}{{ number_format($gdpaper->gdpaper_total) }}元<br>
                                                @else
                                                    無
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $sale->promA_name->name }}</td>
                                        <td>
                                            @foreach ($sale->promBs as $promB)
                                                @if (isset($promB->after_prom_id))
                                                    {{ $promB->promB_name->name }}<br>
                                                @else
                                                    無
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>{{ $sale->pay_type() }}</td>
                                        <td>{{ number_format($sale->total()) }}</td>
                                        <td>
                                            @if (Auth::user()->level == 2)
                                                <a href="{{ route('check-sale', $sale->id) }}"><button type="button"
                                                        class="btn btn-danger btn-sm">查看</button></a>
                                            @else
                                                <a href="{{ route('check-sale', $sale->id) }}"><button type="button"
                                                        class="btn btn-danger btn-sm">確認對帳</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                    </div>
                </div>
            </div>
        </div>
        </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
