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
                            <h5 class="card-title">進貨金紙-刪除</h5>

                            <!-- General Form Elements -->
                            <form class="row g-3" action="{{ route('del-restock.data',$restock->id) }}" method="POST">
                                @csrf
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">進貨日期</label>
                                    <input type="date" class="form-control" id="date" name="date" value="{{ $restock->date }}">
                                </div>
                                <div class="col-12">
                                    <label class="col-sm-2 col-form-label">名稱</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example" name="gdpaper_id">
                                            @foreach($gdpapers as $gdpaper)
                                            <option value="{{ $gdpaper->id }}">{{ $gdpaper->name  }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">進貨單價</label>
                                    <input type="text" class="form-control" id="price" name="price" value="{{ $restock->price }}">
                                </div>
                                <div class="col-12">
                                    <label for="inputNanme4" class="form-label">進貨數量</label>
                                    <input type="text" class="form-control" id="num" name="num" value="{{ $restock->num }}">
                                </div>
                                <div class="text-center">
                                    <button type="submit" class="btn btn-primary">刪除</button>
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
