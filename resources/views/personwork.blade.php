@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>{{ Auth::user()->name }}的出勤狀況</h1>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <form action="{{ route('personwork') }}" method="get">
            @csrf
            <div class="row col-lg-12 mb-4 mt-4">
                <div class="col-auto">
                    <label for="after_date">&nbsp;</label>
                    <input type="date" class="form-control date" id="after_date" name="startdate"
                        value="{{ $request->startdate }}">
                </div>
                <div class="col-auto">
                    <label for="before_date">&nbsp;</label>
                    <input type="date" class="form-control date" id="before_date" name="enddate"
                        value="{{ $request->enddate }}">
                </div>
                <div class="col">
                    <div style="margin-top: 22px;">
                        <label for="after_date">&nbsp;</label>
                        <button type="submit" class="btn btn-danger">查詢</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="col-lg-12 mx-auto">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <h2 class="card-title" style="font-size: 1.6em;text-align:right;">總時數：<b
                                        style="color:red;">{{ number_format($work_sum) }}</b>小時</h2>
                            </div>
                        </div>
                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">日期</th>
                                    <th scope="col">上班時間</th>
                                    <th scope="col">下班時間</th>
                                    <th scope="col">狀態</th>
                                    <th scope="col">時間</th>
                                    <th scope="col">備註</th>
                                    {{-- <th scope="col">操作</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($works as $work)
                                    <tr>
                                        <td>{{ date('Y-m-d', strtotime($work->worktime)) }}</td>
                                        <td>{{ date('H:i', strtotime($work->worktime)) }}</td>
                                        <td>
                                            @if ($work->dutytime != null)
                                                {{ date('H:i', strtotime($work->dutytime)) }}
                                            @else
                                                <b><span style="color: red;">尚未下班</span></b>
                                            @endif
                                        </td>
                                        <td>
                                            @if ($work->status == '0')
                                                值班
                                            @else
                                                <b style="color:red;">加班</b>
                                            @endif
                                        </td>
                                        <td>{{ $work->total }}</td>
                                        <td>{{ $work->remark }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                        {{ $works->appends($condition)->links('vendor.pagination.bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
        </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
