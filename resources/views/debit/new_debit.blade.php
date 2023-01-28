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
                    {{-- @if ($hint == '1')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            恭喜你修改個人資料成功！
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif --}}
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">借支/補錢單申請ˋ</h5>

                            <!-- General Form Elements -->
                            <form class="row g-3" action="{{ route('new-debit.data') }}" method="POST">
                                @csrf
                                <div class="col-4">
                                    <label for="inputNanme4" class="form-label">類別</label>
                                    <div class="col-sm-10">
                                        <div class="form-check col-auto">
                                            <input class="form-check-input" type="radio" name="type" id="gridRadios1"
                                                value="0" required>
                                            <label class="form-check-label" for="gridRadios1">
                                                借支單（申請。。。用）
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <label for="inputNanme4" class="form-label">&nbsp;</label>
                                    <div class="form-check col-auto">
                                        <input class="form-check-input" type="radio" name="type" id="gridRadios2"
                                            value="1" required>
                                        <label class="form-check-label" for="gridRadios2">
                                            補錢單（申請。。。用）
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">金額</label>
                                    <input type="text" class="form-control" id="price" name="price" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">用途備註</label>
                                    <textarea class="form-control" id="floatingTextarea" name="comment" rows="8"></textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">送出申請</button>
                                    <button type="button" class="btn btn-secondary" onclick="history.go(-1)">回上一頁</button>
                                </div>
                            </form><!-- End General Form Elements -->

                        </div>
                    </div>
                </div>
            </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
