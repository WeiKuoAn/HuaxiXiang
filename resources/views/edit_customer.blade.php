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
                            <h5 class="card-title">編輯客戶資料</h5>

                            <!-- General Form Elements -->
                            <form class="row g-3" action="{{ route('edit-customer.data', $customer->id) }}"
                                method="POST">
                                @csrf
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">姓名</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $customer->name }}">
                                </div>
                                <div class="col-12">
                                    <label for="inputEmail4" class="form-label">電話</label>
                                    <input type="tel" class="form-control" id="mobile" name="mobile"
                                        value="{{ $customer->mobile }}">
                                </div>
                                <div class="col-sm-12">
                                    <label for="inputEmail4" class="form-label">群組</label>
                                    <select class="form-select" aria-label="Default select example" name="group_id">
                                        <option value="" selected>請選擇</option>
                                        @foreach($groups as $group)
                                        <option value="{{ $group->id }}" @if( $customer->group_id == $group->id ) selected @endif>{{ $group->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div id="twzipcode" class="row g-3">
                                    <label for="inputEmail4" class="form-label">新地址</label>
                                    <div class="col-md-2">
                                        <div data-role="county" data-style="form-control" data-name="county" data-value="{{ $customer->county }}"></div>
                                    </div>
                                    <div class="col-md-2">
                                        <div data-role="district" data-style="form-control" data-name="district" data-value="{{ $customer->district }}"></div>
                                    </div>
                                    <div class="col-md-2">
                                        <div data-role="zipcode" data-style="form-control" data-name="zipcode" data-value=""></div>
                                    </div>
                                    <div class="col-md-6">
                                        <input type="text" class="form-control" id="address" name="address" placeholder="輸入地址"  value="{{ $customer->address }}">
                                    </div>
                                </div>
                                
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">舊地址</label>
                                    <input type="text" class="form-control" id="address" name="old-address"
                                        value="{{ $customer->address }}">
                                </div>
                                @if (Auth::user()->level != 2)
                                    <div class="text-center mt-5">
                                        <button type="submit" class="btn btn-primary">編輯</button>
                                        <button type="button" class="btn btn-secondary"
                                            onclick="history.go(-1)">回上一頁</button>
                                    </div>
                                @else
                                    <div class="text-center mt-5">
                                        <button type="button" class="btn btn-secondary"
                                            onclick="history.go(-1)">回上一頁</button>
                                    </div>
                                @endif
                            </form><!-- End General Form Elements -->

                        </div>
                    </div>
                </div>
            </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
