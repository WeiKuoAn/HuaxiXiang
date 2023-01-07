@extends('layouts.app')

@section('main-content')
    <div class="pagetitle">
        <h1>新增</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">支出管理</li>
                <li class="breadcrumb-item active">新增支出</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section dashboard">
        <form class="row g-3  pb-1" action="{{ route('new-pay.data') }}" method="POST">

        <div class="row">

            <!-- Left side columns -->
            <div class="col-lg-12 mx-auto mt-5">
                <div class="row">
                    {{-- @if ($hint == '1')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            恭喜你修改個人資料成功！
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif --}}
                    <div class="card">
                        <div class="card-body">
                            @csrf
                            <h5 class="card-title pb-0">支出總單</h5><hr>
                            <table class="table table-striped mt-1">
                                <tr>
                                    <td style="width: 5%"><label for="cust_id" class="col-form-label">支出日期*</label></td>
                                    <td style="width: 15%">
                                        <div class="form-check">
                                            <input type="date" class="form-control" id="pay_date" name="pay_date" required>
                                        </div>
                                    </td>
                                    <td style="width: 5%"><label for="cust_id" class="col-form-label">會計項目*</label></td>
                                    <td style="width: 15%">
                                        <select class="form-select" aria-label="Default select example" name="pay_id" required>
                                            @foreach($pays as $pay)
                                            <option value="{{ $pay->id }}">{{ $pay->name  }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td style="width: 5%"><label for="cust_id" class="col-form-label">總金額*</label></td>
                                    <td style="width: 15%">
                                        <input type="text" class="form-control" id="price" name="price" required>
                                    </td>
                                    <td style="width: 5%"><label for="branch_name" class="col-form-label">用途說明</label></td>
                                    <td style="width: 15%">
                                        <input type="text" class="form-control" id="comment" name="comment">
                                    </td>

                                </tr>
                            </table>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">購買清單</h5>
                            <div class="table-responsive">
                                <table id="cart" class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th scope="col"></th>
                                            <th scope="col">消費日期</th>
                                            <th scope="col">發票號碼</th>
                                            <th scope="col">支出金額</th>
                                            <th scope="col">發票類型</th>
                                            <th scope="col">廠商統編</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    {{-- @for ($i = 0; $i < 2; $i++)
                                        <tr id="row-{{ $i }}">
                                            <td>
                                            <button class="btn btn-primary del-row" alt="{{ $i }}" type="button" name="button" onclick="del_row(this)">刪除</button>
                                            </td>
                                            <td scope="row">
                                            <input id="pay_date-{{ $i }}" class="form-control" type="date" name="pay_data_date[]" value="" required>
                                            </td>
                                            <td>
                                            <input id="pay_invoice-{{ $i }}" class="form-control" type="text" name="pay_invoice_number[]" value="" required>
                                            </td>
                                            <td>
                                            <input id="pay_price-{{ $i }}" class="form-control" type="text" name="pay_price[]" value="" required>
                                            </td>
                                            <td>
                                                <select id="pay_invoice_type-{{ $i }}" class="form-select" aria-label="Default select example" name="pay_invoice_type[]">
                                                <option value="" selected>請選擇</option>
                                                <option value="FreeUniform" >免用統一發票</option><!--FreeUniform-->
                                                <option value="Uniform" >統一發票</option><!--Uniform-->
                                                <option value="Other" >其他</option><!--Other-->
                                            </select>
                                            </td>
                                            <td>
                                            <input id="vendor-{{ $i }}" class="form-control" type="text" name="vender_id[]" value="">
                                            </td>
                                        </tr>
                                    @endfor --}}
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                <input id="add_row" class="btn btn-secondary" type="button" name="" value="新增筆數">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="text-center">
                        <button type="submit" class="btn btn-primary">新增</button>
                        <button type="button" class="btn btn-secondary" onclick="history.go(-1)">回上一頁</button>
                    </div>
                    </form>
                </div>
            </div><!-- End News & Updates -->

        </div><!-- End Right side columns -->

    </section>
    <script>
        function del_row(obj){
            $number = $(obj).attr("alt");
            $('#row-'+$number).remove();
        }
        $(document).ready(function(){
            
                $("#add_row").click(function(){
                $rowCount = $('#cart tr').length - 1;
                var $lastRow = $("#cart tr:last"); //grab row before the last row

                $newRow = '<tr id="row-'+$rowCount+'">';
                $newRow += '<td>';    
                $newRow += '<button class="btn btn-primary del-row" alt="'+$rowCount+'" type="button" name="button" onclick="del_row(this)">刪除</button>';
                $newRow += '</td>';
                $newRow += '<td scope="row">';
                $newRow += '<input id="pay_date-'+$rowCount+'" class="form-control" type="date" name="pay_data_date[]" value="" required>';
                $newRow += '</td>';
                $newRow += '<td>';
                $newRow += '<input id="pay_invoice-'+$rowCount+'" class="form-control" type="text" name="pay_invoice_number[]" value="" required>';
                $newRow += '</td>';
                $newRow += '<td>';
                $newRow += '<input id="pay_price-'+$rowCount+'" class="form-control" type="text" name="pay_price[]" value="" required>';
                $newRow += '</td>';
                $newRow += '<td>';
                $newRow += '<select id="pay_invoice_type-'+$rowCount+'" class="form-select" aria-label="Default select example" name="pay_invoice_type[]">';
                $newRow += '<option value="" selected>請選擇</option>';
                $newRow += '<option value="FreeUniform" >免用統一發票</option>';
                $newRow += '<option value="Uniform" >統一發票</option>';
                $newRow += '<option value="Other" >其他</option>';
                $newRow += '</select>';
                $newRow += '</td>';
                $newRow += '<td>';
                $newRow += '<input id="vendor-'+$rowCount+'" class="form-control" type="text" name="vender_id[]" value="">';
                $newRow += '</td>';
                $newRow += '</tr>';

                $lastRow.after($newRow); //add in the new row at the end
            });
            $.ajaxSetup({ headers: { 'csrftoken' : '{{ csrf_token() }}' } });
        });
    </script>
    <script>
    </script>
@endsection