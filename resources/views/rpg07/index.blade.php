@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>報表管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">報表管理</li>
                <li class="breadcrumb-item active">團火查詢</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <form action="{{ route('rpg07') }}" method="get">
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
                {{-- <div class="col-auto">
                    <label for="cust_mobile">客戶電話</label>
                    <input type="text" class="form-control date" id="cust_mobile" name="cust_mobile"
                        value="{{ $request->cust_mobile }}" >
                </div>
                <div class="col-auto">
                    <label for="sale_on">單號</label>
                    <input type="text" class="form-control date" id="sale_on" name="sale_on"
                        value="{{ $request->sale_on }}">
                </div>
                <div class="col-auto">
                    <label for="pet_name">寶貝名稱</label>
                    <input type="text" class="form-control date" id="pet_name" name="pet_name"
                        value="{{ $request->pet_name }}">
                </div> --}}
                <div class="col-auto">
                    <div style="margin-top: 22px;">
                        <label for="after_date">&nbsp;</label>
                        <button type="submit" class="btn btn-danger">查詢</button>
                    </div>
                </div>
                <div class="col-auto">
                    <div style="margin-top: 22px;">
                        <label for="after_date">&nbsp;</label>
                        <a href="{{ route('rpg07.export',request()->input()) }}"><button
                            type="button" class="btn btn-outline-dark">匯出</button></a>
                    </div>
                </div>
            </div>
        </form>
        <!-- Left side columns -->
        <div class="col-lg-12 mx-auto">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row"></div>
                        <!-- Table with hoverable rows -->
                        <br>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    {{-- <th scope="col">單號</th>
                                    <th scope="col">Key單人員</th> --}}
                                    <th scope="col">日期</th>
                                    <th scope="col">客戶</th>
                                    <th scope="col">寶貝名</th>
                                    <th scope="col">公斤數</th>
                                    <th scope="col">類別</th>
                                    <th scope="col">方案</th>
                                    <th scope="col">金紙</th>
                                    <th scope="col">後續處理A</th>
                                    <th scope="col">後續處理B</th>
                                    <th scope="col">付款方式</th>
                                    <th scope="col">實收價格</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        {{-- <td>{{ $data->sale_on }}</td>
                                        <td>{{ $data->user_name->name }}</td> --}}
                                        <td>{{ $data->sale_date }}</td>
                                        <td>
                                            @if (isset($data->customer_id))
                                                @if(isset($data->cust_name))
                                                    {{ $data->cust_name->name }}
                                                @else
                                                {{ $data->customer_id }}
                                                @endif
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($data->pet_name))
                                                {{ $data->pet_name }}
                                            @endif
                                        </td>
                                        <td>
                                            {{ $data->kg }}
                                        </td>
                                        <td>
                                            @if (isset($data->type))
                                                {{ $data->source_type->name }}
                                            @endif
                                        </td>
                                        <td>
                                            @if (isset($data->plan_id))
                                                {{ $data->plan_name->name }}
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($data->gdpapers as $gdpaper)
                                                @if (isset($gdpaper->gdpaper_id))
                                                    @if ($data->plan_id != '4')
                                                        {{ $gdpaper->gdpaper_name->name }}-{{ $gdpaper->gdpaper_num }}份<br>
                                                    @else
                                                        {{ $gdpaper->gdpaper_name->name }}{{ number_format($gdpaper->gdpaper_num) }}份<br>
                                                    @endif
                                                @else
                                                    無
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @if (isset($data->before_prom_id))
                                                {{ $data->promA_name->name }}
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($data->promBs as $promB)
                                                @if (isset($promB->after_prom_id))
                                                    {{ $promB->promB_name->name }}<br>
                                                @else
                                                    無
                                                @endif
                                            @endforeach
                                        </td>
                                        <td>
                                            @if (isset($data->pay_id))
                                                {{ $data->pay_type() }}
                                            @endif
                                        </td>
                                        <td>{{ number_format($data->pay_price) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                    </div>
                    {{-- {{ $datas->appends($condition)->links('vendor.pagination.bootstrap-4') }} --}}
                </div>
            </div>
        </div>
        </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
