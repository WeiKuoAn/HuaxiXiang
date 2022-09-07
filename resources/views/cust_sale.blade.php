@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>客戶管理 - {{ $customer->name }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">客戶管理</li>
                <li class="breadcrumb-item active">客戶分別查詢key單</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <form action="{{ route('customer-sale', $customer->id) }}" method="get">
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
                @if(Auth::user()->level !=2)
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
                @endif
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
                                    <th scope="col">寶貝名</th>
                                    <th scope="col">日期</th>
                                    <th scope="col">類別</th>
                                    <th scope="col">方案</th>
                                    <th scope="col">金紙</th>
                                    <th scope="col">後續處理A</th>
                                    <th scope="col">後續處理B</th>
                                    <th scope="col">付款方式</th>
                                    <th scope="col">總價格</th>
                                    <th scope="col">Key單人員</th>
                                    {{-- <th scope="col">動作</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($sales as $sale)
                                    <tr>
                                        <td>{{ $sale->sale_on }}</td>
                                        <td>{{ $sale->pet_name }}</td>
                                        <td>{{ $sale->sale_date }}</td>
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
                                                    {{ $gdpaper->gdpaper_name->name }}{{ number_format($gdpaper->gdpaper_total) }}元<br>
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
                                            {{ $sale->user_name->name }}
                                        </td>
                                        {{-- <td>
                                            <a href="{{ route('edit-sale', $sale->id) }}"><button type="button"
                                                    class="btn btn-primary btn-sm">修改</button></a>
                                        </td> --}}
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
