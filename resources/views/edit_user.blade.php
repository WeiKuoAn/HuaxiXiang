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
                    @if ($hint == '1')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            恭喜你修改個人資料成功！@if(Auth::user()->level !=2)<a href="{{ route('users') }}">回會員列表</a>@endif
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    
                    <div class="card">
                        <div class="card-body">
                            <br>
                            <h5 class="card-title">編輯會員資料</h5>

                            <!-- General Form Elements -->
                            <form class="row g-3" action="{{ route('users-profile', $user->id) }}" method="POST">
                                @csrf
                                <div class="row mb-3 mt-2">
                                    <label for="name" class="col-sm-2 col-form-label">姓名</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $user->name }}">
                                    </div>
                                </div>
                                <div class="row mb-3 mt-2">
                                    <label for="entry_date" class="col-sm-2 col-form-label">入職時間</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="entry_date" name="entry_date"
                                            value="{{ $user->entry_date }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">信箱</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $user->email }}">
                                    </div>
                                </div>
                                <div class="row mb-3 mt-2">
                                    <label for="mobile" class="col-sm-2 col-form-label">電話</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="mobile" name="mobile"
                                            value="{{ $user->mobile }}">
                                    </div>
                                </div>
                                <div class="row mb-3 mt-2">
                                    <label for="address" class="col-sm-2 col-form-label">地址</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ $user->address }}">
                                    </div>
                                </div>
                                @if (Auth::user()->level == '0' || Auth::user()->level == '1')
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-2 pt-0">等級</legend>
                                        <div class="col-sm-10">
                                            @if ($user->level != '0')
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="level" id="level1"
                                                        value="1" @if ($user->level == '1') checked @endif>
                                                    <label class="form-check-label" for="level1">
                                                        管理員
                                                    </label>
                                                </div>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="level" id="level2"
                                                        value="2" @if ($user->level == '2') checked @endif>
                                                    <label class="form-check-label" for="level2">
                                                        一般員工
                                                    </label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="level" id="level3"
                                                        value="0" @if ($user->level == '0') checked @endif>
                                                    <label class="form-check-label" for="level3">
                                                        <b style="color: red;">超級管理員</b>
                                                    </label>
                                                </div>
                                            @endif
                                        </div>
                                    </fieldset>
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-2 pt-0">權限</legend>
                                        <div class="col-sm-10">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="gridRadios1"
                                                    value="0" @if ($user->status == '0') checked @endif>
                                                <label class="form-check-label" for="gridRadios1">
                                                    開通
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="status" id="gridRadios2"
                                                    value="1" @if ($user->status == '1') checked @endif>
                                                <label class="form-check-label" for="gridRadios2">
                                                    關閉
                                                </label>
                                            </div>
                                        </div>
                                @endif
                                </fieldset>
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
