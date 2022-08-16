@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>報表管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">報表管理</li>
                <li class="breadcrumb-item active">Rpg04-金紙統計</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <form action="{{ route('rpg04') }}" method="get">
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
                                    <th scope="col" width="20%">日期</th>
                                    @foreach ($gdpapers as $gdpaper)
                                        <th>{{ $gdpaper->name }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($periods as $period)
                                    <tr align="center">
                                        <td>{{ $period->format("Y-m-d") }}</td>
                                        @foreach ($gdpapers as $gdpaper)
                                            @if(isset($datas[$period->format("Y-m-d")][$gdpaper->id]))
                                                <td>{{ number_format($datas[$period->format("Y-m-d")][$gdpaper->id]) }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                                <tr align="center" style="color: red;">
                                    <td>總計</td>
                                    @foreach ($gdpapers as $gdpaper)
                                        @if(isset($sums[$gdpaper->id]))
                                            <td>{{ number_format($sums[$gdpaper->id]) }}</td>
                                        @else
                                            <td></td>
                                        @endif
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                        <div style="float:right;margin-right:3em;font-size:1.5em">
                            <span>共計：{{ number_format($sums['total']) }}元</span>
                        </div>
                        <!-- End Table with hoverable rows -->
                    </div>

                </div>
            </div>
        </div>
        </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
