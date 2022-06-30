@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>報表管理</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">報表管理</li>
                <li class="breadcrumb-item active">Rpg01</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <!-- Left side columns -->
        <div class="col-lg-12 mx-auto">
            <div class="row">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"></h5>

                        <!-- Table with hoverable rows -->
                        <table class="table table-hover">
                            <thead>
                                <tr align="center">
                                    <th scope="col" width="15%">日期</th>
                                    @foreach ($plans as $key => $plan)
                                        <th scope="col">{{ $plan->name }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($datas as $key => $data)
                                    <tr align="center">
                                        <td>{{ $key }}</td>
                                        @foreach ($plans as $key => $plan)
                                            @if (isset($data[$key]['count']) && $data[$key]['count'] != 0)
                                                <td>{{ $data[$key]['count'] }}</td>
                                            @else
                                                <td></td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                                <tr align="center" style="color:red;font-weight:500;">
                                    <td>總單量</td>
                                    @foreach ($plans as $key => $plan)
                                        @if (isset($sums[$key]['count']) && $sums[$key]['count'] != 0)
                                            <td>{{ $sums[$key]['count'] }}單</td>
                                        @else
                                            <td>0單</td>
                                        @endif
                                    @endforeach
                                </tr>
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
