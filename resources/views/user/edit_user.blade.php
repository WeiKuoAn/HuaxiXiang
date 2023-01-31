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
                    @if(Auth::user()->level == 0 || Auth::user()->level == 1)
                        @if ($hint == '1')
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                    恭喜你修改個人資料成功！<a href="{{ route('users') }}">回會員列表</a>                            
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif
                    @endif
                    
                    {{-- @if($user->state == 0) --}}
                    <div class="card">
                        <div class="card-body">
                            <br>
                            <h5 class="card-title">編輯會員資料</h5>

                            <!-- General Form Elements -->
                            <form class="row g-3" action="{{ route('edit-user-profile.data', $user->id) }}" method="POST">
                                @csrf
                                <div class="row mb-3 mt-2">
                                    <label for="entry_date" class="col-sm-2 col-form-label">入職時間</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="entry_date" name="entry_date"
                                            value="{{ $user->entry_date }}" readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">職稱</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="job_id">
                                            @foreach($jobs as $job)
                                            <option value="{{ $job->id }}" @if($user->job_id == $job->id) selected @endif>{{ $job->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 ">
                                    <label for="name" class="col-sm-2 col-form-label">姓名*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="name" name="name"
                                            value="{{ $user->name }}" >
                                    </div>
                                </div>
                                <div class="row mb-3 ">
                                    <label for="name" class="col-sm-2 col-form-label">生理性別*</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="sex" >
                                            <option value="男生" @if($user->sex == '男生') selected @endif>男生</option>
                                            <option value="女生" @if($user->sex == '女生') selected @endif>女生</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3 mt-2">
                                    <label for="birthday" class="col-sm-2 col-form-label">生日*</label>
                                    <div class="col-sm-10">
                                        <input type="date" class="form-control" id="birthday" name="birthday"
                                            value="{{ $user->birthday }}" >
                                    </div>
                                </div>
                                <div class="row mb-3 ">
                                    <label for="ic_card" class="col-sm-2 col-form-label">身份證*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="ic_card" name="ic_card"
                                            value="{{ $user->ic_card  }}" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="mobile" class="col-sm-2 col-form-label">聯絡電話*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="mobile" name="mobile"
                                            value="{{ $user->mobile }}" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">信箱E-mail*</label>
                                    <div class="col-sm-10">
                                        <input type="email" class="form-control" id="email" name="email"
                                            value="{{ $user->email }}" >
                                    </div>
                                </div>
                                <div class="row mb-3 ">
                                    <label for="marriage" class="col-sm-2 col-form-label">婚姻狀況*</label>
                                    <div class="col-sm-10">
                                        <select class="form-select" aria-label="Default select example" name="marriage" >
                                            <option value="請選擇" @if($user->marriage == '請選擇') selected @endif>請選擇</option>
                                            <option value="結婚" @if($user->marriage == '結婚') selected @endif>結婚</option>
                                            <option value="未婚" @if($user->marriage == '未婚') selected @endif>未婚</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="address" class="col-sm-2 col-form-label">通訊地址*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="address" name="address"
                                            value="{{ $user->address }}" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="census_address" class="col-sm-2 col-form-label">戶籍地址*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="census_address" name="census_address"
                                            value="{{ $user->census_address }}" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="bank_id" class="col-sm-2 col-form-label">薪資帳戶*</label>
                                    <div class="col-sm-3">
                                        <input type="text" class="form-control" id="bank_id" name="bank_id"
                                            value="{{ $user->bank_id }}" placeholder="銀行代碼" >
                                    </div>
                                    <div class="col-sm-7">
                                        <input type="text" class="form-control" id="bank_number" name="bank_number"
                                            value="{{ $user->bank_number }}" placeholder="帳戶號碼" >
                                    </div>
                                </div>
                                <hr class="mt-3">
                                <div class="row mb-3 mt-3">
                                    <label for="urgent_name" class="col-sm-2 col-form-label">緊急聯絡人姓名*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="urgent_name" name="urgent_name"
                                            value="{{ $user->urgent_name }}" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="urgent_relation" class="col-sm-2 col-form-label">緊急聯絡人關係*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="urgent_relation" name="urgent_relation"
                                            value="{{ $user->urgent_relation }}" >
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="urgent_mobile" class="col-sm-2 col-form-label">緊急聯絡人電話*</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="urgent_mobile" name="urgent_mobile"
                                            value="{{ $user->urgent_mobile }}" >
                                    </div>
                                </div>
                                <hr class="mt-3">
                                @if (Auth::user()->level == '0' || Auth::user()->level == '1')
                                    <fieldset class="row mb-3 mt-3">
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
                                    <button type="button" class="btn btn-secondary" onclick="history.go(-1)">回上一頁</button>
                                </div>
                                {{-- @endif --}}
                            </form><!-- End General Form Elements -->

                        </div>
                    </div>
                </div>
            </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
