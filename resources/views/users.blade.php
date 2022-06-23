@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>員工管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">資料管理</li>
                <li class="breadcrumb-item active">員工管理</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        {{-- <div class="row col-lg-10 mx-auto">
            <div class="col-auto me-auto">.col-auto .me-auto</div>
            <div class="col-auto">.col-auto</div>
        </div> --}}
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
                                    <th scope="col">入職時間</th>
                                    <th scope="col">等級</th>
                                    <th scope="col">權限</th>
                                    <th scope="col">動作</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->entry_date }}</td>
                                        <td>
                                            @if ($user->level == '0')
                                                <b style="color:red;"> {{ $user->level_state() }}</b>
                                            @else
                                                {{ $user->level_state() }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user->status == '0')
                                                開通
                                            @else
                                                關閉
                                            @endif
                                        </td>
                                        <td>
                                            @if($user->level != '0')
                                            <a href="{{ route('users-profile', $user->id) }}"><button type="button"
                                                    class="btn btn-danger btn-sm">修改</button></a>
                                            @endif
                                            <a href="{{ route('user-sale', $user->id) }}"><button type="button"
                                                    class="btn btn-primary btn-sm">查看業務單</button></a>
                                            @if(Auth::user()->level == 0)
                                            <a href="{{ route('userwork', $user->id) }}"><button type="button"
                                                    class="btn btn-success btn-sm">出勤狀況</button></a>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <!-- End Table with hoverable rows -->
                        {{ $users->links('vendor.pagination.bootstrap-4') }}
                    </div>

                </div>
            </div>
        </div>
        </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
@endsection
