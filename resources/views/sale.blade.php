@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>業務管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">業務管理</li>
                <li class="breadcrumb-item active">業務key單</li>
            </ol>
            {{-- <div class="col-auto">
                <a href="{{ route('new-sale') }}"><button type="button" class="btn btn-primary btn-sm">新增業務</button></a>
            </div> --}}
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <form action="{{ route('sale') }}" method="get">
            @csrf
            <div class="row col-lg-12 mb-4 mt-4">
                <div class="col-auto">
                    <label for="after_date">單號日期</label>
                    <input type="date" class="form-control date" id="after_date" name="after_date"
                        value="{{ $request->after_date }}">
                </div>
                <div class="col-auto">
                    <label for="before_date">&nbsp;</label>
                    <input type="date" class="form-control date" id="before_date" name="before_date"
                        value="{{ $request->before_date }}">
                </div>
                <div class="col-2">
                    <label for="sale_on">單號</label>
                    <input type="text" class="form-control date" id="sale_on" name="sale_on"
                        value="{{ $request->sale_on }}">
                </div>
                <div class="col-2">
                    <label for="cust_mobile">客戶電話</label>
                    <input type="text" class="form-control date" id="cust_mobile" name="cust_mobile"
                        value="{{ $request->cust_mobile }}">
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
                    <label for="after_date">狀態</label>
                    <select id="inputState" class="form-select" name="status" onchange="this.form.submit()">
                        <option value="not_check" @if (isset($request->status) || $request->status == 'not_check') selected @endif>未對帳</option>
                        <option value="check" @if ($request->status == 'check') selected @endif>已對帳</option>
                    </select>
                </div>
                <div class="col">
                    <label for="after_date">付款方式</label>
                    <select id="inputState" class="form-select" name="pay_id" onchange="this.form.submit()">
                        <option value="" @if (!isset($request->pay_id)) selected @endif>請選擇</option>
                        <option value="A" @if ($request->pay_id == 'A') selected @endif>現金</option>
                        <option value="B" @if ($request->pay_id == 'B') selected @endif>匯款</option>
                        <option value="C" @if ($request->pay_id == 'C') selected @endif>訂金</option>
                        <option value="D" @if ($request->pay_id == 'D') selected @endif>尾款</option>
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
                            <div class="col-10 col-md-10">
                                <h2 class="card-title" style="font-size: 1.6em;text-align:right;">金紙費：<b
                                        style="color:red;">{{ number_format($gdpaper_total) }}</b></h2>
                            </div>
                            <div class="col-2 col-md-2">
                                <h2 class="card-title" style="font-size: 1.6em;text-align:right;">實收：<b
                                        style="color:red;">{{ number_format($price_total) }}</b></h2>
                            </div>
                        </div>

                        <br>
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
                                    <th scope="col">實收價格</th>
                                    <th scope="col">動作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->sale_on }}</td>
                                        <td>{{ $sale->user_name->name }}</td>
                                        <td>{{ $sale->sale_date }}</td>
                                        <td>
                                            @if (isset($sale->customer_id))
                                                @if(isset($sale->cust_name))
                                                    {{ $sale->cust_name->name }}
                                                @else
                                                {{ $sale->customer_id }}
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($sale->type))
                                                {{ $sale->source_type->name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($sale->plan_id))
                                                {{ $sale->plan_name->name }}
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($sale->gdpapers as $gdpaper)
                                                @if (isset($gdpaper->gdpaper_id))
                                                    @if ($sale->plan_id != '4')
                                                        {{ $gdpaper->gdpaper_name->name }}{{ number_format($gdpaper->gdpaper_total) }}元<br>
                                                    @else
                                                        {{ $gdpaper->gdpaper_name->name }}{{ number_format($gdpaper->gdpaper_num) }}份<br>
                                                    @endif
                                                @else
                                                    無
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @if (isset($sale->before_prom_id))
                                                {{ $sale->promA_name->name }}
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($sale->promBs as $promB)
                                                @if (isset($promB->after_prom_id))
                                                    {{ $promB->promB_name->name }}<br>
                                                @else
                                                    無
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @if (isset($sale->pay_id))
                                                {{ $sale->pay_type() }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($sale->pay_price) }}</td>
                                        <td>
                                            @if ($sale->status != '9')
                                                <a href="{{ route('edit-sale', $sale->id) }}"><button type="button"
                                                        class="btn btn-secondary btn-sm">修改</button></a>
                                                        <a href="{{ route('del-sale', $sale->id) }}"><button type="button"
                                                            class="btn btn-secondary btn-sm">刪除</button></a>
                                                <a href="{{ route('check-sale', $sale->id) }}"><button type="button"
                                                        class="btn btn-success btn-sm">送出對帳</button></a>
                                            @else
                                                <a href="{{ route('check-sale', $sale->id) }}"><button type="button"
                                                        class="btn btn-danger btn-sm">查看</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                    </div>
                    {{ $sales->appends($condition)->links('vendor.pagination.bootstrap-4') }}
                </div>
            </div>
        </div>
        </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
