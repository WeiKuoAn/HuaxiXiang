@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>報表管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">報表管理</li>
                <li class="breadcrumb-item active">營收總表</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <form action="{{ route('rpg05') }}" method="get">
            @csrf
            <div class="row col-lg-12 mb-4 mt-4">
                <div class="col-auto">
                    <label for="after_date">日期</label>
                    <input type="date" class="form-control date" id="after_date" name="after_date"
                        @if(!isset($request->after_date)) value="{{ $first_date->format("Y-m-d") }}" @endif value="{{ $request->after_date }}">
                </div>
                <div class="col-auto">
                    <label for="before_date">&nbsp;</label>
                    <input type="date" class="form-control date" id="before_date" name="before_date"
                    @if(!isset($request->before_date)) value="{{ $last_date->format("Y-m-d") }}" @endif value="{{ $request->before_date }}">
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
                        <div style="float:right;margin-right:1em;font-size:1.5em;font-weight:bold;margin-bottom:2em;">
                            @if( $sums['total'] < 0)
                                <span style="color:red;">共計： {{   number_format($sums['total']) }}元</span>
                            @else
                                <span>共計：+{{   number_format($sums['total']) }}元</span>
                            @endif
                        </div>
                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr align="center">
                                    <th scope="col" width="10%">日期</th>
                                    <th scope="col" width="">業務收入</th>
                                    <th scope="col" width="">其他收入</th>
                                    <th scope="col" width="">支出</th>
                                    <th scope="col" width="">當日營收</th>
                                    <th scope="col" width="">累積淨利</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($periods as $period)
                                    <tr align="center">
                                        <td>{{ $period->format("Y-m-d") }}</td>
                                        @if(isset($datas[$period->format("Y-m-d")]))
                                            @foreach($datas[$period->format("Y-m-d")] as $data)
                                                <td>{{ number_format($data) }}</td>
                                            @endforeach
                                                <td>{{ number_format($sums[$period->format("Y-m-d")]['day_income']) }}</td>
                                                @if(number_format($sums[$period->format("Y-m-d")]['day_total']) < 0)
                                                <td style="color: red;">{{ number_format($sums[$period->format("Y-m-d")]['day_total']) }}</td>
                                                @else
                                                    <td>{{ number_format($sums[$period->format("Y-m-d")]['day_total']) }}</td>
                                                @endif
                                        @else
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        @endif
                                    </tr>
                                @endforeach
                                <tr align="center">
                                    <td>當月個別總計</td>
                                    <td>{{  number_format($sums['sum_total']) }}</td>
                                    <td>{{  number_format($sums['income_total']) }}</td>
                                    <td>{{  number_format($sums['pay_total']) }}</td>
                                    <td>{{ number_format($sums['all_income_total']) }}</td>
                                    @if( number_format($sums['total']) < 0)
                                        <td>{{ number_format($sums['total']) }}</td>
                                    @else
                                        <td>{{  number_format($sums['total']) }}</td>
                                    @endif
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
