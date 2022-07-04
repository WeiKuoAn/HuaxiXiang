@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>報表管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">報表管理</li>
                <li class="breadcrumb-item active">Rpg01</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <form action="{{ route('rpg01') }}" method="get">
            @csrf
            <div class="row col-lg-12 mb-4 mt-4">
                <div class="col-auto">
                    <label for="after_date">年度</label>
                    <select id="inputState" class="form-select" name="year" onchange="this.form.submit()">
                        @foreach($years as $year)
                        <option value="{{$year}}" >{{ $year }}年</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <label for="after_date">月份</label>
                    <select id="inputState" class="form-select" name="month" onchange="this.form.submit()">
                        <option value="01">一月</option>
                        <option value="02">二月</option>
                        <option value="03">三月</option>
                        <option value="04">四月</option>
                        <option value="05">五月</option>
                        <option value="06">六月</option>
                        <option value="07">七月</option>
                        <option value="08">八月</option>
                        <option value="09">九月</option>
                        <option value="10">十月</option>
                        <option value="11">十一月</option>
                        <option value="12">十二月</option>
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
                                    <th scope="col" width="15%">日期</th>
                                    @foreach ($plans as $key => $plan)
                                        <th scope="col">{{ $plan->name }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key => $data)
                                    <tr align="center">
                                        <td>{{ $key }}</td>
                                        @foreach ($plans as $key => $plan)
                                            @if (isset($data[$key]['count']) && $data[$key]['count'] != 0)
                                                <td>{{ $data[$key]['count'] }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                                <tr align="center" style="color:red;font-weight:500;">
                                    <td>總單量</td>
                                    @foreach ($plans as $key => $plan)
                                        @if (isset($sums[$key]['count']) && $sums[$key]['count'] != 0)
                                            <td>{{ $sums[$key]['count'] }}單</td>
                                        @else
                                            <td>0單</td>
                                        @endif
                                    @endforeach
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
