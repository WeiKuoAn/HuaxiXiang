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
    <form class="row g-3" action="{{ route('new-sale.data') }}" method="POST">
        @csrf
        <section class="section">
            <div class="row">
                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">業務Key單</h5>

                            <!-- Horizontal Form -->
                            <div class="row">
                                <div class="col-6">
                                    <label for="inputNanme4" class="form-label">單號</label>
                                    <input type="text" class="form-control" id="sale_on" name="sale_on">
                                </div>
                                <div class="col-6">
                                    <label for="inputNanme4" class="form-label">日期</label>
                                    <input type="date" class="form-control" id="sale_date" name="sale_date">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 mt-3">
                                    <label class="col-sm-12 col-form-label">客戶名稱</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example"
                                            name="customer_id">
                                            <option value="" selected>請選擇</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: 21px;">
                                    <label for="inputNanme4" class="form-label">寵物名稱</label>
                                    <input type="text" class="form-control" id="pet_name" name="pet_name">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <label class="col-sm-12 col-form-label">案件來源</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example" name="type">
                                            <option value="" selected>請選擇</option>
                                            <option value="I">網路</option>
                                            <option value="H">醫院</option>
                                            <option value="F">朋友</option>
                                            <option value="O">老客戶</option>
                                            <option value="B">禮儀社</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="col-sm-12 col-form-label">方案選擇</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example" name="plan_id">
                                            <option value="" selected>請選擇</option>
                                            @foreach ($plans as $plan)
                                                <option value="{{ $plan->id }}">{{ $plan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="inputNanme4" class="form-label" style="margin-top: 6px;">方案價格</label>
                                    <input type="text" class="form-control" id="plan_price" name="plan_price">
                                </div>
                            </div>
                            <!-- End Horizontal Form -->

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">後續處理</h5>

                            <!-- Multi Columns Form -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="col-sm-12 col-form-label">後續處理A名稱</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example"
                                            name="before_prom_id">
                                            <option value="" selected>請選擇</option>
                                            @foreach ($promAs as $promA)
                                                <option value="{{ $promA->id }}">{{ $promA->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5" style="margin-top: 21px;">
                                    <label for="inputNanme4" class="form-label">價格</label>
                                    <input type="text" class="form-control" id="before_prom_price"
                                        name="before_prom_price">
                                </div>
                            </div>
                            <div class="row g-3" id="after_prom">
                                <div class="col-md-6">
                                    <label class="col-sm-12 col-form-label">後續處理B名稱1</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example"
                                            name="after_prom_id[]">
                                            <option value="" selected>請選擇</option>
                                            @foreach ($promBs as $promB)
                                                <option value="{{ $promB->id }}">{{ $promB->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: 21px;">
                                    <label for="inputNanme4" class="form-label">價格</label>
                                    <input type="text" class="form-control" id="after_prom_total"
                                        name="after_prom_total[]">
                                </div>
                                <div class="col-md-1">
                                    <div style="margin-top: 35px;">
                                        <button type="button" class="btn btn-outline-secondary"
                                            id="add_after_prom">＋</button>
                                    </div>
                                </div>
                            </div><!-- End Multi Columns Form -->

                        </div>
                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">選擇金紙</h5>

                            <!-- Vertical Form -->
                            <div class="row g-3" id="gdpaper">
                                <div class="col-md-6">
                                    <label class="col-sm-12 col-form-label">金紙名稱1</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example"
                                            name="gdpaper_id[]">
                                            <option value="" selected>請選擇</option>
                                            @foreach ($gdpapers as $gdpaper)
                                                <option value="{{ $gdpaper->id }}">
                                                    {{ $gdpaper->name }}（{{ $gdpaper->price }}元）</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: 21px;">
                                    <label for="inputNanme4" class="form-label">數量</label>
                                    <input type="text" class="form-control" id="gdpaper_num" name="gdpaper_num[]">
                                </div>
                                <div class="col-md-1">
                                    <div style="margin-top: 35px;">
                                        <button type="button" class="btn btn-outline-secondary" id="add_gdpaper">＋</button>
                                    </div>
                                </div>
                            </div>
                            <!-- Vertical Form -->

                        </div>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">付款方式</h5>

                            <!-- No Labels Form -->
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="col-sm-12 col-form-label">付款方式</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example" name="pay_id">
                                            <option value="" selected>請選擇</option>
                                            <option value="A">現金</option>
                                            <option value="B">匯款</option>
                                            <option value="C">訂金</option>
                                            <option value="D">尾款</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: 21px;">
                                    <label for="validationDefault02" class="form-label">付款金額</label>
                                    <input type="text" class="form-control" id="validationDefault02" value=""
                                        name="pay_price" required>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 21px;">
                                <label for="validationDefault02" class="form-label">備註</label>
                                <textarea class="form-control" id="floatingTextarea" name="comm" rows="8"></textarea>
                            </div>
                            <!-- End No Labels Form -->

                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="text-center mt-2">
            <button type="submit" class="btn btn-primary">新增</button>
            <button type="button" class="btn btn-secondary" onclick="history.go(-1)">回上一頁</button>
        </div>

    </form>
    <script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
    <script>
        $(document).ready(function(){
            var i=1;
            var j=1;
            var no = i+1;
            var no1 = j+1;
            $("#add_gdpaper").click(function(e) {  
            var str ='<div class="row g-3"><div class="col-md-6">';
                str+='<label class="col-sm-12 col-form-label remove_gdpaper">金紙名稱'+no+'</label><div class="col-sm-12">';
                str+='<select class="form-select" aria-label="Default select example" name="gdpaper_id[]">';
                str+='<option value="" selected>請選擇</option>@foreach ($gdpapers as $gdpaper)<option value="{{ $gdpaper->id }}">{{ $gdpaper->name }}（{{ $gdpaper->price }}元）</option>@endforeach</select></div></div>';     
                str+='<div class="col-md-4 remove_gdpaper" style="margin-top: 21px;" ><label for="inputNanme4" class="form-label" >數量</label>';     
                str+='<input type="text"  class="form-control" id="gdpaper_num" name="gdpaper_num[]"></div>';
                str+='<div class="col-md-1 remove_gdpaper"><div style="margin-top: 35px;">';
                str+='<button type="button" class="btn btn-outline-secondary" id="btn_remove">－</button></div></div></div>';           
            var gdpapers = '<?php echo count($gdpapers) ?>';
                if(i<Number(gdpapers)){
                    $("#gdpaper").append(str);
                    i++;
                    no++;
                }      
            });
            $("#gdpaper").on("click", "#btn_remove", function() {
                $(this).closest('div.row').remove();
                i=i-1;
                no=no-1;
            });

            $("#add_after_prom").click(function(e) {  
            var str ='<div class="row g-3"><div class="col-md-6"><label class="col-sm-12 col-form-label">後續處理B名稱'+no1+'</label>';
                str+='<div class="col-sm-12"><select class="form-select" aria-label="Default select example" name="after_prom_id[]">';
                str+='<option value="" selected>請選擇</option>@foreach ($promBs as $promB)<option value="{{ $promB->id }}">{{ $promB->name }}</option>@endforeach';
                str+='</select></div></div><div class="col-md-4" style="margin-top: 21px;"><label for="inputNanme4" class="form-label">數量</label>';
                str+='<input type="text" class="form-control" id="after_prom_total" name="after_prom_total[]"></div><div class="col-md-1">';
                str+='<div style="margin-top: 35px;">';
                str+='<button type="button" class="btn btn-outline-secondary" id="remove_after_prom">－</button></div></div></div>';
   
            var promBs = '<?php echo count($promBs) ?>';
                if(j<Number(promBs)){
                    $("#after_prom").append(str);
                    j++;
                    no1++;
                }  
            });
            $("#after_prom").on("click", "#remove_after_prom", function() {
                $(this).closest('div.row').remove();
                j=j-1;
                no1=no1-1;
            });    
            
        });
    </script>
@endsection

