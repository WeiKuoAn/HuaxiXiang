@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>報表管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">報表管理</li>
                <li class="breadcrumb-item active">年度營收報表</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <form action="{{ route('rpg09') }}" method="get">
            @csrf
            <div class="row col-lg-12 mb-4 mt-4">
                <div class="col-auto">
                    <label for="after_date">年度</label>
                    <select id="inputState" class="form-select" name="year" onchange="this.form.submit()">
                        @foreach($years as $year)
                        <option value="{{$year}}" @if($request->year == $year) selected @endif >{{ $year }}年</option>
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
                            <thead>
                                <tr align="center">
                                    <th scope="col">月份</th>
                                    <th scope="col">業務單量</th>
                                    <th scope="col">營收</th>
                                </tr>
                            </thead>
                            <tbody align="center">
                                @foreach ($datas as $key=>$data)
                                    <tr>
                                        <td>{{ $data['month'] }}</td>
                                        <td>{{ $data['cur_count'] }}</td>
                                        <td>{{ number_format($data['cur_price_amount']) }}</td>
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
