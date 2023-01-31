@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>支出管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">支出管理</li>
                <li class="breadcrumb-item active">借出補錢管理</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <!-- Left side columns -->
        <form action="{{ route('debit') }}" method="get">
            @csrf
            <div class="row col-lg-12 mb-4 mt-4">
                <div class="col-auto">
                    <label for="after_date">申請日期</label>
                    <input type="date" class="form-control date" id="after_date" name="after_date"
                        value="{{ $request->after_date }}">
                </div>
                <div class="col-auto">
                    <label for="before_date">&nbsp;</label>
                    <input type="date" class="form-control date" id="before_date" name="before_date"
                        value="{{ $request->before_date }}">
                </div>
                <div class="col-auto">
                    <label for="after_date">類別</label>
                    <select id="inputState" class="form-select" name="type" onchange="this.form.submit()">
                        <option value="null" @if (!isset($request->type) || $request->type == "null") selected @endif>請選擇</option>
                        <option value="0" @if ($request->type == '0') selected @endif>借出單</option>
                        <option value="1" @if ($request->type == '1') selected @endif>補錢單</option>
                    </select>
                </div>
                <div class="col-auto">
                    <label for="after_date">狀態</label>
                    <select id="inputState" class="form-select" name="state" onchange="this.form.submit()">
                        <option value="null" @if (!isset($request->state) || $request->state == "null") selected @endif>待審核</option>
                        <option value="7" @if ($request->state == '7') selected @endif>重新審核</option>
                        <option value="8" @if ($request->state == '8') selected @endif>不同意</option>
                        <option value="9" @if ($request->state == '9') selected @endif>同意</option>
                    </select>
                </div>
                <div class="col-auto">
                    <div style="margin-top: 22px;">
                        <label for="after_date">&nbsp;</label>
                        <button type="submit" class="btn btn-danger">查詢</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="col-lg-12 mx-auto">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th scope="col" width="13%">日期</th>
                                    <th scope="col" width="13%">類別</th>
                                    <th scope="col" width="13%">金額</th>
                                    <th scope="col" width="13%">申請人</th>
                                    <th scope="col">備註</th>
                                    <th scope="col" width="13%">狀態</th>
                                    <th scope="col">動作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $data)
                                    <tr>
                                        <td>{{ date('Y-m-d',strtotime($data->created_at)) }}</td>
                                        <td>
                                            @if($data->type == 0) 借出單
                                            @else 補錢單
                                            @endif
                                        </td>
                                        <td>{{ $data->price }}</td>
                                        <td>{{ $data->user_data->name }}</td>
                                        <td>{{ $data->comment }}</td>
                                        <td>
                                            @if($data->state == 9) 同意
                                            @elseif($data->state == 8) 不同意
                                            @elseif($data->state == 7) 重新審核
                                            @else 待審核
                                            @endif
                                        </td>
                                        @if($data->state <= 7)
                                        <td>
                                            <a href="{{ route('edit-debit', $data->id) }}"><button type="button"
                                                    class="btn btn-primary btn-sm">核銷</button></a>
                                        </td>
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                        {{ $datas->links('vendor.pagination.bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
        </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
