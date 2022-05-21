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
                            <h5 class="card-title">新增客戶資料</h5>

                            <!-- General Form Elements -->
                            <form class="row g-3" action="{{ route('new-customer.data') }}" method="POST">
                                @csrf
                                <div class="col-12">
                                  <label for="inputNanme4" class="form-label">姓名</label>
                                  <input type="text" class="form-control" id="name" name="name">
                                </div>
                                <div class="col-12">
                                  <label for="inputEmail4" class="form-label">電話</label>
                                  <input type="tel" class="form-control" id="mobile" name="mobile">
                                </div>
                                <div class="col-12">
                                  <label for="inputAddress" class="form-label">地址</label>
                                  <input type="text" class="form-control" id="address" name="address">
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
