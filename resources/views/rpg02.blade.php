@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>報表管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">報表管理</li>
                <li class="breadcrumb-item active">支出報表</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <form action="{{ route('rpg02') }}" method="get">
            @csrf
            <div class="row col-lg-12 mb-4 mt-4">
                <div class="col-auto">
                    <label for="after_date">支出日期</label>
                    <input type="date" class="form-control date" id="after_date" name="after_date"
                        @if(!isset($request->after_date)) value="{{ $first_date->format("Y-m-d") }}" @endif value="{{ $request->after_date }}">
                </div>
                <div class="col-auto">
                    <label for="before_date">&nbsp;</label>
                    <input type="date" class="form-control date" id="before_date" name="before_date"
                    @if(!isset($request->before_date)) value="{{ $last_date->format("Y-m-d") }}" @endif value="{{ $request->before_date }}">
                </div>
                <div class="col-auto">
                    <label for="after_date">科目</label>
                    <select id="inputState" class="form-select" name="pay" onchange="this.form.submit()">
                        <option value="" @if(!isset($request->pay)) selected @endif>不限</option>
                        @foreach($pays as $pay)
                        <option value="{{$pay->id}}" @if($request->pay == $pay->id) selected @endif >{{ $pay->name }}</option>
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
                        <h5 class="card-title"></h5>

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr align="center">
                                    <th scope="col" width="33.3%">科目</th>
                                    <th scope="col" width="10%">支出金額</th>
                                    {{-- <th scope="col" width="40%">備註</th> --}}
                                    <th scope="col" width="33.3%">百分比</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($datas as $key=>$data)
                                    <tr align="center">
                                        <td>{{ $data['pay_name'] }}</td>
                                        <td align="right">{{ number_format($data['total_price']) }}</td>
                                        {{-- <td align="right">{{ $data['comment'] }}</td> --}}
                                        <td>{{ $data['percent'] }}%</td>
                                    </tr>
                                @endforeach
                                <tr align="center" style="color:red;font-weight:500;">
                                    <td>總支出</td>
                                    <td align="right">{{ number_format( $sums['total_amount']) }}</td>
                                    {{-- <td align="right"></td> --}}
                                    <td align="center">@if(isset($sums['percent'])){{ $sums['percent'] }}% @endif</td>
                                </tr>
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
