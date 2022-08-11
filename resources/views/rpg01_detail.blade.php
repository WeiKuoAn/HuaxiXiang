@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>{{ $date."【".$plan_name[$plan_id]."】火化" }}</h1>
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
                            <tbody>
                                <tr align="center">
                                    <td>No</td>
                                    <td>客戶名稱</td>
                                    <td>寵物名稱</td>
                                    <td>後續處理A</td>
                                    <td>後續處理B</td>
                                </tr>
                            </tbody>
                            <tbody>
                                @foreach($datas as $key=>$data)
                                    <tr align="center">
                                        <td>{{ $key+1 }}</td>
                                        <td>{{ $data->user_name->name }}</td>
                                        <td>{{ $data->pet_name }}</td>
                                        <td>
                                            @if (isset($data->before_prom_id))
                                                {{ $data->promA_name->name }}
                                            @endif
                                        </td>
                                        <td>
                                            @foreach ($data->promBs as $promB)
                                                @if (isset($promB->after_prom_id))
                                                    {{ $promB->promB_name->name }}<br>
                                                @else
                                                    無
                                                @endif
                                            @endforeach
                                        </td>
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
        <div class="text-center mt-2">
            <button type="button" class="btn btn-secondary" onclick="history.go(-1)">回上一頁</button>
        </div>
        </div><!-- End Right side columns -->

    </section>
@endsection
