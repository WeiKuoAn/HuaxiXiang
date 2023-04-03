@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>報表管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">報表管理</li>
                <li class="breadcrumb-item active">專員金紙</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <form action="{{ route('rpg10') }}" method="get">
            @csrf
            <div class="row col-lg-12 mb-4 mt-4">
                <div class="col-auto">
                    <label for="after_date">年度</label>
                    <select id="inputState" class="form-select" name="year">
                        @foreach($years as $year)
                        <option value="{{$year}}" @if($request->year == $year) selected @endif >{{ $year }}年</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label for="after_date">月份</label>
                    <select id="inputState" class="form-select" name="month">
                        <option value="" selected >請選擇</option>
                        <option value="01" @if($request->month == "01" ) selected  @endif>一月</option>
                        <option value="02" @if($request->month == "02" ) selected  @endif>二月</option>
                        <option value="03" @if($request->month == "03" ) selected  @endif>三月</option>
                        <option value="04" @if($request->month == "04" ) selected  @endif>四月</option>
                        <option value="05" @if($request->month == "05" ) selected  @endif>五月</option>
                        <option value="06" @if($request->month == "06" ) selected  @endif>六月</option>
                        <option value="07" @if($request->month == "07" ) selected  @endif>七月</option>
                        <option value="08" @if($request->month == "08" ) selected  @endif>八月</option>
                        <option value="09" @if($request->month == "09" ) selected  @endif>九月</option>
                        <option value="10" @if($request->month == "10" ) selected  @endif>十月</option>
                        <option value="11" @if($request->month == "11" ) selected  @endif>十一月</option>
                        <option value="12" @if($request->month == "12" ) selected  @endif>十二月</option>
                    </select>
                </div>
                <div class="col-auto">
                    <label for="after_date">專員</label>
                    <select id="inputState" class="form-select" name="user_id">
                        <option value="NULL">不限</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" @if($request->user_id == $user->id) selected @endif >{{ $user->name }}</option>
                        @endforeach
                    </select>
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
                        <!-- Table with hoverable rows -->
                        <br>
                        <table class="table table-hover">
                            <thead align="center">
                                <tr>
                                    <th>No</th>
                                    <th>日期</th>
                                    <th>寶貝名稱</th>
                                    <th>金紙名稱</th>
                                    <th>金紙數量</th>
                                    <th>小計</th>
                                    <th>傭金</th>
                                </tr>
                            </thead>
                            <thead >
                                <tr style="color:red;" align="right">
                                    <th colspan="4"></th>
                                    <th>總共：{{ $sums['total_num'] }}份</th>
                                    <th>總計：{{ number_format($sums['total_price']) }}元</th>
                                    <th>傭金總計：{{ number_format($sums['total_comm_price']) }}元</th>
                                </tr>
                            </thead>
                            @foreach($datas as $user_name => $data)
                                <tbody>
                                    <tr>
                                        <td colspan="7">{{ $user_name }}</td>
                                    </tr>

                                    @foreach($data['sale_datas'] as $key=>$da)
                                    <tr>
                                        <td align="center">{{ $key+1 }}</td>
                                        <td align="center">{{ $da->sale_date }}</td>
                                        <td align="center">{{ $da->pet_name }}</td>
                                        <td align="center">{{ $da->name }}</td>
                                        <td align="right">{{ $da->gdpaper_num }}</td>
                                        <td align="right">{{ $da->gdpaper_total }}</td>
                                        <td align="right">{{ $da->comm_price }}</td>
                                    </tr>
                                   @endforeach
                                   <tr>
                                       <td colspan="4"></td>
                                       <td align="right">共：{{ number_format($data['total_num']) }}份</td>
                                       <td align="right">小計：{{ number_format($data['total_price']) }}元</td>
                                       <td align="right">傭金小記：{{ number_format($data['total_comm_price']) }}元</td>
                                   </tr>
                                </tbody>
                            @endforeach
                            
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
