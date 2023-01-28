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
                            <h5 class="card-title">新增用戶資料</h5>

                            <!-- General Form Elements -->
                            <form class="row g-3" action="{{ route('users-add.data') }}" method="POST">
                                @csrf
                                <div class="row mb-3 mt-2">
                                    <label class="col-sm-2 col-form-label">職稱</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="job_id">
                                            @foreach($jobs as $job)
                                            <option value="{{ $job->id }}" selected>{{ $job->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 ">
                                    <label for="name" class="col-sm-2 col-form-label">姓名</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="username" class="col-sm-2 col-form-label">帳號</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="username" name="username"
                                            value="">
                                    </div>
                                </div>
                                <div class="row mb-3 mt-2">
                                    <label for="password" class="col-sm-2 col-form-label">密碼</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password"
                                            value="">
                                    </div>
                                </div>
                                <div class="row mb-3 mt-2">
                                    <label for="mobile" class="col-sm-2 col-form-label">電話</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="mobile" name="mobile"
                                            value="">
                                    </div>
                                </div>
                                <div class="row mb-3 mt-2">
                                    <label for="entry_date" class="col-sm-2 col-form-label">入職時間</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="entry_date" name="entry_date"
                                            value="">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">新增</button>
                                    <button type="reset" class="btn btn-secondary">重設</button>
                                </div>
                            </form><!-- End General Form Elements -->

                        </div>
                    </div>
                </div>
            </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
