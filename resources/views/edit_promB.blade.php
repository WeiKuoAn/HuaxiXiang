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
                            <h5 class="card-title">編輯後續處理B資料</h5>

                            <!-- General Form Elements -->
                            <form class="row g-3" action="{{ route('edit-promB.data',$promB->id) }}" method="POST">
                                @csrf
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">方案名稱</label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ $promB->name }}">
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-2 col-form-label">狀態</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example" name="status">
                                            <option value="up" @if($promB->status == 'up') selected @endif>上架</option>
                                            <option value="down" @if($promB->status == 'down') selected @endif>下架</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">編輯</button>
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
