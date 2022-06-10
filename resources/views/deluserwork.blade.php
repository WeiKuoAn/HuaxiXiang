@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1></h1>
        <nav>
            <ol class="breadcrumb">
                {{-- <li class="breadcrumb-item active">個人資料設定</li> --}}
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-8 mx-auto">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">編輯出勤時間</h5>

                            <!-- General Form Elements -->
                            <form class="row g-3" action="{{ route('delUserWork.data',$work->id) }}" method="POST">
                                @csrf
                                <div class="row mb-3 mt-2">
                                    <label for="name" class="col-sm-2 col-form-label">上班時間</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" id="name" name="worktime" value="{{ $work->worktime }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="username" class="col-sm-2 col-form-label">下班時間</label>
                                    <div class="col-sm-10">
                                        <input type="datetime-local" class="form-control" id="username" name="dutytime" value="{{ $work->dutytime }}">
                                    </div>
                                </div>
                                <fieldset class="row mb-3">
                                    <legend class="col-form-label col-sm-2 pt-0">狀態</legend>
                                    <div class="col-sm-10">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="gridRadios1"
                                                value="0" @if($work->status == '0') checked @endif>
                                            <label class="form-check-label" for="gridRadios1">
                                                值班
                                            </label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="status" id="gridRadios2"
                                                value="1" @if($work->status == '1') checked @endif>
                                            <label class="form-check-label" for="gridRadios2">
                                                補簽
                                            </label>
                                        </div>
                                    </div>
                                </fieldset>
                                <div class="row mb-3">
                                    <label for="username" class="col-sm-2 col-form-label">備註</label>
                                    <div class="col-sm-10">
                                        <textarea class="form-control" id="floatingTextarea" name="remark" rows="6">{{ $work->remark }}</textarea>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">刪除</button>
                                    <button type="reset" class="btn btn-secondary"  onclick="history.go(-1)">回上一頁</button>
                                </div>
                            </form><!-- End General Form Elements -->

                        </div>
                    </div>
                </div>
            </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
