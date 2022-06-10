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
                            <h5 class="card-title">編輯會員密碼</h5>
                            @if ($hint == '1')
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    會員密碼修改失敗！請重新再一次
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif
                            <!-- General Form Elements -->
                            <form class="row g-3" action="{{ route('users-password.data') }}" method="POST">
                                @csrf
                                <div class="row mb-3 mt-2">
                                    <label for="name" class="col-sm-2 col-form-label">舊密碼</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password" name="password"
                                            value="">
                                    </div>
                                </div>
                                <div class="row mb-3 mt-2">
                                    <label for="name" class="col-sm-2 col-form-label">新密碼</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password_new" name="password_new"
                                            value="">
                                    </div>
                                </div>
                                <div class="row mb-3 mt-2">
                                    <label for="name" class="col-sm-2 col-form-label">確認密碼</label>
                                    <div class="col-sm-10">
                                        <input type="password" class="form-control" id="password_conf"
                                            name="password_conf" value="">
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">編輯</button>
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
