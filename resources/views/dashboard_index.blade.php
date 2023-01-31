@extends('layouts.app')

@section('main-content')

    <div class="pagetitle">
        <h1>首頁</h1>
    </div><!-- End Page Title -->
    <br>
    <section class="section dashboard">
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
                        id="overtime">補簽</button>
                        <div id="overtimecontent">
                            <br>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">上班時間</label>
                                <input type="datetime-local" class="form-control" id="name" name="worktime" value="" >
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">下班時間</label>
                                <input type="datetime-local" class="form-control" id="name" name="dutytime" value="" >
                            </div>
                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">補簽原因</label>
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
                            <input type="datetime-local" class="form-control" id="name" name="worktime" value="" >
                        </div>
                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">下班時間</label>
                            <input type="datetime-local" class="form-control" id="name" name="dutytime" value="" >
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
       
    </section>
@endsection
<script src="{{ asset('js/overtime.js') }}"></script>
