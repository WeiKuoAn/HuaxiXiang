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
    <form class="row g-3" action="{{ route('del-sale.data',$sale->id) }}" method="POST">
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
                                    <input type="text" class="form-control" id="sale_on" name="sale_on" value="{{ $sale->sale_on }}">
                                </div>
                                <div class="col-6">
                                    <label for="inputNanme4" class="form-label">日期</label>
                                    <input type="date" class="form-control" id="sale_date" name="sale_date" value="{{ $sale->sale_date }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <label class="col-sm-12 col-form-label">客戶名稱</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example"
                                            name="customer_id">
                                            <option value="" selected>請選擇</option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}" @if($sale->customer_id == $customer->id) selected @endif>{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: 21px;">
                                    <label for="inputNanme4" class="form-label">寵物名稱</label>
                                    <input type="text" class="form-control" id="pet_name" name="pet_name" value="{{ $sale->pet_name }}">
                                </div>
                                <div class="col-md-4" style="margin-top: 21px;">
                                    <label for="inputNanme4" class="form-label">公斤數</label>
                                    <input type="text" class="form-control" id="kg" name="kg" value="{{ $sale->kg }}">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 mt-3">
                                    <label class="col-sm-12 col-form-label">案件來源</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example" name="type">
                                            <option value="" selected>請選擇</option>
                                            <option value="I" @if($sale->type == 'I') selected @endif>網路</option>
                                            <option value="H" @if($sale->type == 'H') selected @endif>醫院</option>
                                            <option value="F" @if($sale->type == 'F') selected @endif>朋友</option>
                                            <option value="O" @if($sale->type == 'O') selected @endif>老客戶</option>
                                            <option value="B" @if($sale->type == 'B') selected @endif >禮儀社</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label class="col-sm-12 col-form-label">方案選擇</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example" name="plan_id">
                                            <option value="" selected>請選擇</option>
                                            @foreach ($plans as $plan)
                                                <option value="{{ $plan->id }}" @if($sale->plan_id == $plan->id) selected @endif>{{ $plan->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4 mt-3">
                                    <label for="inputNanme4" class="form-label" style="margin-top: 6px;">方案價格</label>
                                    <input type="text" class="form-control" id="plan_price" name="plan_price" value="{{ $sale->plan_price }}">
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
                                                <option value="{{ $promA->id }}" @if($sale->before_prom_id == $promA->id) selected @endif>{{ $promA->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-5" style="margin-top: 21px;">
                                    <label for="inputNanme4" class="form-label">價格</label>
                                    <input type="text" class="form-control" id="before_prom_price"
                                        name="before_prom_price" value="{{ $sale->before_prom_price }}">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div style="margin-top: 35px;">
                                    <button type="button" class="btn btn-outline-secondary"
                                        id="add_after_prom">新增後續處理B</button>
                                </div>
                            </div>
                            @foreach($sale_promBs as $sale_promB)
                            <div class="row g-3 after_prom">
                                <div class="col-md-6">
                                    <label class="col-sm-12 col-form-label">後續處理B名稱</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example"
                                            name="after_prom_id[]">
                                            <option value="" selected>請選擇</option>
                                            @foreach ($promBs as $promB)
                                                <option value="{{ $promB->id }}" @if($sale_promB->after_prom_id == $promB->id) selected @endif>{{ $promB->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: 21px;">
                                    <label for="inputNanme4" class="form-label">價格</label>
                                    <input type="text" class="form-control" id="after_prom_total"
                                        name="after_prom_total[]" value="{{ $sale_promB->after_prom_total }}">
                                </div>
                                <div class="col-md-1">
                                    <div style="margin-top: 35px;">
                                        <button type="button" class="btn btn-outline-secondary"
                                            id="remove_after_prom">－</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div id="after_prom"></div><!-- End Multi Columns Form -->

                        </div>
                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">選擇金紙</h5>
                            <div class="col-md-12 ">
                                <div>
                                    <button type="button" class="btn btn-outline-secondary" id="add_gdpaper">新增金紙</button>
                                </div>
                            </div>
                            <!-- Vertical Form -->
                            @foreach($sale_gdpapers as $sale_gdpaper)
                            <div class="row g-3 gdpaper">
                                <div class="col-md-6">
                                    <label class="col-sm-12 col-form-label">金紙名稱</label>
                                    <div class="col-sm-12">
                                        <select class="form-select" aria-label="Default select example"
                                            name="gdpaper_id[]">
                                            <option value="" selected>請選擇</option>
                                            @foreach ($gdpapers as $gdpaper)
                                                <option value="{{ $gdpaper->id }}" @if($sale_gdpaper->gdpaper_id == $gdpaper->id) selected @endif>
                                                    {{ $gdpaper->name }}（{{ $gdpaper->price }}元）</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4" style="margin-top: 21px;">
                                    <label for="inputNanme4" class="form-label">數量</label>
                                    <input type="text" class="form-control" id="gdpaper_num" name="gdpaper_num[]" value="{{ $sale_gdpaper->gdpaper_num }}">
                                </div>
                                <div class="col-md-1">
                                    <div style="margin-top: 35px;">
                                        <button type="button" class="btn btn-outline-secondary" id="btn_remove">－</button>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <div id="gdpaper"></div>
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
                                            <option value="A" @if($sale->pay_id == 'A') selected @endif>現金</option>
                                            <option value="B" @if($sale->pay_id == 'B') selected @endif>匯款</option>
                                            <option value="C" @if($sale->pay_id == 'C') selected @endif>訂金</option>
                                            <option value="D" @if($sale->pay_id == 'D') selected @endif>尾款</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6" style="margin-top: 21px;">
                                    <label for="validationDefault02" class="form-label">付款金額</label>
                                    <input type="text" class="form-control" id="validationDefault02"
                                        name="pay_price" @if($sale->pay_price==null) value="0" @else value="{{ $sale->pay_price }}"  @endif  required>
                                </div>
                            </div>
                            <div class="col-md-12" style="margin-top: 21px;">
                                <label for="validationDefault02" class="form-label">備註</label>
                                <textarea class="form-control" id="floatingTextarea" name="comm" rows="6">{{ $sale->comm }}</textarea>
                            </div>
                            <!-- End No Labels Form -->
                            <div class="col-md-12" style="margin-top: 21px;font-size:1.8em;font-weight:600;">
                                <label for="validationDefault02" class="form-label">總金額</label>
                                <label for="validationDefault02" class="form-label" style="color: red;">{{ number_format($sale->total()) }}</label>
                                <label for="validationDefault02" class="form-label">元</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="text-center mt-2">
            <button type="submit" class="btn btn-danger">刪除
            </button>
            <button type="button" class="btn btn-secondary" onclick="history.go(-1)">回上一頁</button>
        </div>
    </form>

   
    <script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
    <script>
            var i=1;
            var j=1;
            var no = i+1;
            var no1 = j+1;
            $("#add_gdpaper").click(function(e) {  
            var str ='<div class="row g-3"><div class="col-md-6">';
                str+='<label class="col-sm-12 col-form-label remove_gdpaper">金紙名稱</label><div class="col-sm-12">';
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
            $(".gdpaper").on("click", "#btn_remove", function() {
                $(this).closest('div.row').remove();
                i=i-1;
            });
            $("#gdpaper").on("click", "#btn_remove", function() {
                $(this).closest('div.row').remove();
                i=i-1;
            });

            $("#add_after_prom").click(function(e) {  
            var str ='<div class="row g-3"><div class="col-md-6"><label class="col-sm-12 col-form-label">後續處理B名稱</label>';
                str+='<div class="col-sm-12"><select class="form-select" aria-label="Default select example" name="after_prom_id[]">';
                str+='<option value="" selected>請選擇</option>@foreach ($promBs as $promB)<option value="{{ $promB->id }}">{{ $promB->name }}</option>@endforeach';
                str+='</select></div></div><div class="col-md-4" style="margin-top: 21px;"><label for="inputNanme4" class="form-label">數量</label>';
                str+='<input type="text" class="form-control" id="after_prom_total" name="after_prom_total[]"></div><div class="col-md-1">';
                str+='<div style="margin-top: 35px;">';
                str+='<button type="button" class="btn btn-outline-secondary" id="remove_after_prom">－</button></div></div></div>';
   
            var promBs = '<?php echo count($promBs) ?>';
                if(j<promBs){
                    $("#after_prom").append(str);
                    j++;
                } 
            });
            $(".after_prom").on("click", "#remove_after_prom", function() {
                $(this).closest('div.row').remove();
                j=j-1;
            });    
            $("#after_prom").on("click", "#remove_after_prom", function() {
                $(this).closest('div.row').remove();
                j=j-1;
            });    
    </script>
@endsection

