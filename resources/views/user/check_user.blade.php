@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>員工管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">資料管理</li>
                <li class="breadcrumb-item active">用戶修改確認</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <div class="row col-lg-12 mx-auto mb-4">
            <div class="col-auto me-auto"></div>
        </div>
        <!-- Left side columns -->
        <div class="col-lg-12 mx-auto">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col">姓名</th>
                                    <th scope="col">修改名稱</th>
                                    <th scope="col">修改內容</th>
                                    <th scope="col">修改時間</th>
                                    <th scope="col">動作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ $data->user_data->name }}</td>
                                        <td>{{ $data->title() }}</td>
                                        <td>{{ $data->text() }}</td>
                                        <td>{{ date('Y-m-d', strtotime($data->created_at)) }}</td>
                                        <form action="{{ route('users-check.data',$data->user_data->id) }}" method="GET">
                                        <td>
                                            <button type="submit" class="btn btn-primary btn-sm" name="btn_submit" onclick="if(!confirm('是否確認?')){event.returnValue=false;return false;}" value="Yes">確認</button>
                                            {{-- <button type="submit" class="btn btn-danger btn-sm" name="btn_submit"  onclick="if(!confirm('是否確認拒絕?')){event.returnValue=false;return false;}" value="No">拒絕</button> --}}
                                        </td>
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                        
                    </div>

                </div>
            </div>
        </div>
        </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
