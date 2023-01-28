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
                            <h5 class="card-title">借支/補錢單核銷</h5>

                            <!-- General Form Elements -->
                            <form class="row g-3" action="{{ route('edit-debit.data',$data->id) }}" method="POST">
                                @csrf
                                <div class="col-4">
                                    <label for="inputNanme4" class="form-label">類別</label>
                                    <div class="col-sm-10">
                                        <div class="form-check col-auto">
                                            <input class="form-check-input" type="radio" name="type" id="gridRadios1"
                                                value="0" @if($data->type == 0) checked @endif>
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
                                            value="1" @if($data->type == 1) checked @endif>
                                        <label class="form-check-label" for="gridRadios2">
                                            補錢單（申請。。。用）
                                        </label>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">金額</label>
                                    <input type="text" class="form-control" id="price" name="price" value="{{ $data->price }}">
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">申請人備註</label>
                                    <input type="text" class="form-control" id="comment" name="comment" value="{{ $data->comment }}">
                                </div>
                                <div class="col-12 mt-4">
                                    <label for="inputNanme4" class="form-label">核銷人員備註</label>
                                    <textarea class="form-control" id="floatingTextarea" name="admin_comment" rows="8">{{ $data->admin_comment }}</textarea>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary" name="btn_submit" value="agree">同意</button>
                                    <button type="submit" class="btn btn-secondary" name="btn_submit" value="no_agree">不同意</button>
                                </div>
                            </form><!-- End General Form Elements -->

                        </div>
                    </div>
                </div>
            </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
