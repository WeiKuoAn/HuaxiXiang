@extends('layouts.app')

@section('main-content')

    <div class="pagetitle">
        <h1>首頁</h1>
    </div><!-- End Page Title -->
    <br>
    <section class="section dashboard">
        <div class="row">
            @if(Auth::user()->level != '2')
            <!-- Left side columns -->
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title"><b>今日收益</b></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($total_today) }}元</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="col-xxl-6 col-md-6">
                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title"><b>其他收益</b></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-currency-dollar"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($income_today) }}元</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                    <!-- Sales Card -->
                    
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card sales-card">

                            {{-- <div class="filter">
                                <a class="icon" href="#" data-bs-toggle="dropdown"><i
                                        class="bi bi-three-dots"></i></a>
                                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                                    <li class="dropdown-header text-start">
                                        <h6>Filter</h6>
                                    </li>

                                    <li><a class="dropdown-item" href="#">Today</a></li>
                                    <li><a class="dropdown-item" href="#">This Month</a></li>
                                    <li><a class="dropdown-item" href="#">This Year</a></li>
                                </ul>
                            </div> --}}

                            <div class="card-body">
                                <h5 class="card-title"><b>今日業務單量</b></span></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>
                                            {{ $sale_today }}單
                                        </h6>
                                       </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Sales Card -->

                    <!-- Revenue Card -->
                    <div class="col-xxl-4 col-md-6">
                        <div class="card info-card revenue-card">
                            <div class="card-body">
                                <h5 class="card-title"><b>待對帳單量</b></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-cart"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($check_sale) }}單</h6>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div><!-- End Revenue Card -->

                    <!-- Customers Card -->
                    <div class="col-xxl-4 col-xl-12">

                        <div class="card info-card customers-card">
                            <div class="card-body">
                                <h5 class="card-title"><b>累積客戶數量</b></h5>

                                <div class="d-flex align-items-center">
                                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                        <i class="bi bi-people"></i>
                                    </div>
                                    <div class="ps-3">
                                        <h6>{{ number_format($cust_nums) }}人</h6>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div><!-- End Customers Card -->

               
                    @endif

                    <!-- Reports -->
                    <div class="col-12">
                        <div class="card">

                            

                            <div class="card-body">
                                <h5 class="card-title"><b>線上打卡</b></h5>

                                
                        <div class="alert alert-primary" role="alert">
                            目前時間為 <b>{{ $now }}</b>
                        </div>
                        <form action="{{ route('dashboard.worktime') }}" method="POST">
                            @csrf
                            @if (!isset($work->worktime))
                                <button type="Submit" class="btn btn-primary" name="work_time" value="0">上班</button>
                                <button type="button" class="btn btn-success" name="overtime" value="1"
                                    id="overtime">加班</button>
                                <div id="overtimecontent">
                                    <br>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">加班原因</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="remark"></textarea><br>
                                        <button type="Submit" class="btn btn-danger" name="overtime"
                                            value="1">送出</button>
                                    </div>
                                </div>
                            @elseif($work->dutytime != null)
                                <button type="Submit" class="btn btn-primary" name="work_time" value="0">上班</button>
                                <button type="button" class="btn btn-success" value="1" id="overtime">補簽</button>
                                <div id="overtimecontent">
                                    <br>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">上班時間</label>
                                        <input type="datetime-local" class="form-control" id="name" name="worktime" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">下班時間</label>
                                        <input type="datetime-local" class="form-control" id="name" name="dutytime" value="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleFormControlTextarea1" class="form-label">補簽原因</label>
                                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" name="remark"></textarea><br>
                                        <button type="Submit" class="btn btn-danger" name="overtime"
                                            value="1">送出</button>
                                    </div>
                                </div>
                            @elseif($work->dutytime == null)
                                <button type="Submit" class="btn btn-danger" name="dutytime" value="2">下班</button>
                            @endif

                            </div>
                        </form>
                        </div>
                    </div><!-- End Reports -->

                    <!-- Recent Sales -->
    </section>
@endsection
<script src="{{ asset('js/overtime.js') }}"></script>
