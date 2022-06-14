<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Gdpaper;
use App\Models\Plan;
use App\Models\PromB;
use App\Models\PromA;
use App\Models\Sale_gdpaper;
use App\Models\Sale_promB;
use App\Models\Sale;
use App\Models\User;
use Illuminate\Support\Facades\Auth;


class SaleDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request) {
            $status = $request->status;
            if (!isset($status) || $status == 'not_check') {
                $sales = Sale::whereIn('status', [1, 2]);
            }
            if ($status == 'check') {
                $sales = Sale::where('status', 9);
            }
            $after_date = $request->after_date;
            if ($after_date) {
                $sales = $sales->where('sale_date', '>=', $after_date);
            }
            $before_date = $request->before_date;
            if ($before_date) {
                $sales = $sales->where('sale_date', '<=', $before_date);
            }
            $sale_on = $request->sale_on;
            if ($sale_on) {
                $sales = $sales->where('sale_on', $sale_on);
            }
            $cust_mobile = $request->cust_mobile;
            if ($cust_mobile) {
                $customer = Customer::where('mobile', $cust_mobile)->first();
                $sales = $sales->where('customer_id', $customer->id);
            }
            $user = $request->user;
            if ($user != "null") {
                if (isset($user)) {
                    $sales = $sales->where('user_id', $user);
                } else {
                    $sales = $sales;
                }
            }
            $pay_id = $request->pay_id;
            if ($pay_id) {
                $sales = $sales->where('pay_id', $pay_id);
            }
            $price_total = $sales->sum('pay_price');
            $sales = $sales->orderby('id', 'desc')->paginate(50);
            $condition = $request->all();

            foreach($sales as $sale){
                $sale_ids[] = $sale->id;
            }
            if(isset($sale_ids)){
                $gdpaper_total = Sale_gdpaper::whereIn('sale_id',$sale_ids)->sum('gdpaper_total');
            }else{
                $gdpaper_total = 0;
            }
            

        } else {
            $condition = ' ';
            $price_total = Sale::where('status', '1')->sum('pay_price');
            $sales = Sale::orderby('id', 'desc')->where('status', '1')->paginate(50);
        }
        $users = User::get();
        return view('sale')->with('sales', $sales)
            ->with('users', $users)
            ->with('request', $request)
            ->with('condition', $condition)
            ->with('price_total', $price_total)
            ->with('gdpaper_total', $gdpaper_total);
    }

    public function preson_index(Request $request)
    {

        if ($request) {
            $status = $request->status;
            if (!isset($status) || $status == 'not_check') {
                $sales = Sale::where('user_id', Auth::user()->id)->whereIn('status', [1, 2]);
            }
            if ($status == 'check') {
                $sales = Sale::where('user_id', Auth::user()->id)->where('status', 9);
            }
            $after_date = $request->after_date;
            if ($after_date) {
                $sales = $sales->where('sale_date', '>=', $after_date);
            }
            $before_date = $request->before_date;
            if ($before_date) {
                $sales = $sales->where('sale_date', '<=', $before_date);
            }
            $sale_on = $request->sale_on;
            if ($sale_on) {
                $sales = $sales->where('sale_on', $sale_on);
            }
            $cust_mobile = $request->cust_mobile;
            if ($cust_mobile) {
                $customer = Customer::where('mobile', $cust_mobile)->first();
                $sales = $sales->where('customer_id', $customer->id);
            }
            $pay_id = $request->pay_id;
            if ($pay_id) {
                $sales = $sales->where('pay_id', $pay_id);
            }
            $sales = $sales->orderby('id', 'desc')->paginate(15);
            $price_total = $sales->sum('pay_price');
            $condition = $request->all();

            foreach($sales as $sale){
                $sale_ids[] = $sale->id;
            }
            if(isset($sale_ids)){
                $gdpaper_total = Sale_gdpaper::whereIn('sale_id',$sale_ids)->sum('gdpaper_total');
            }else{
                $gdpaper_total = 0;
            }
        } else {
            $condition = ' ';
            $price_total = Sale::where('status', '1')->sum('pay_price');
            $sales = Sale::orderby('id', 'desc')->where('status', '1')->paginate(15);
        }
        return view('preson-sale')->with('sales', $sales)
            ->with('request', $request)
            ->with('condition', $condition)
            ->with('price_total', $price_total)
            ->with('gdpaper_total', $gdpaper_total);
    }

    public function wait_index(Request $request) //代確認業務單
    {
        $sales = Sale::where('status', 3)->orderby('id', 'desc')->get();
        return view('wait-sale')->with('sales', $sales);
    }

    public function user_wait_index() //代確認業務單
    {
        $sales = Sale::where('status', 3)->where('user_id', Auth::user()->id)->orderby('id', 'desc')->get();
        return view('wait-sale')->with('sales', $sales);
    }

    public function user_sale($id, Request $request) //從用戶管理進去看業務單
    {
        $user = User::where('id', $id)->first();
        if ($request) {
            $status = $request->status;
            if (!isset($status) || $status == 'not_check') {
                $sales = Sale::where('user_id',  $id)->whereIn('status', [1, 2]);
            }
            if ($status == 'check') {
                $sales = Sale::where('user_id',  $id)->where('status', 9);
            }
            $after_date = $request->after_date;
            if ($after_date) {
                $sales = $sales->where('sale_date', '>=', $after_date);
            }
            $before_date = $request->before_date;
            if ($before_date) {
                $sales = $sales->where('sale_date', '<=', $before_date);
            }
            $sale_on = $request->sale_on;
            if ($sale_on) {
                $sales = $sales->where('sale_on', $sale_on);
            }
            $cust_mobile = $request->cust_mobile;
            if ($cust_mobile) {
                $customer = Customer::where('mobile', $cust_mobile)->first();
                $sales = $sales->where('customer_id', $customer->id);
            }
            $pay_id = $request->pay_id;
            if ($pay_id) {
                $sales = $sales->where('pay_id', $pay_id);
            }
            $sales = $sales->orderby('id', 'desc')->paginate(15);
            $price_total = $sales->sum('pay_price');
            $condition = $request->all();

            foreach($sales as $sale){
                $sale_ids[] = $sale->id;
            }

            if(isset($sale_ids)){
                $gdpaper_total = Sale_gdpaper::whereIn('sale_id',$sale_ids)->sum('gdpaper_total');
            }else{
                $gdpaper_total = 0;
            }
        } else {
            $condition = ' ';
            $sales = Sale::where('user_id', $id)->where('status', '1')->orderby('sale_date', 'desc')->paginate(15);
            $price_total = Sale::where('user_id', $id)->where('status', '1')->sum('pay_price');
        }

        
        return view('user_sale')->with('sales', $sales)
            ->with('user', $user)
            ->with('request', $request)
            ->with('condition', $condition)
            ->with('price_total', $price_total)
            ->with('gdpaper_total', $gdpaper_total);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::get();
        $plans = Plan::where('status', 'up')->get();
        $gdpapers = Gdpaper::where('status', 'up')->get();
        $promBs = PromB::where('status', 'up')->get();
        $promAs = PromA::where('status', 'up')->get();
        return view('new_saledata')->with('customers', $customers)
            ->with('plans', $plans)
            ->with('gdpapers', $gdpapers)
            ->with('promAs', $promAs)
            ->with('promBs', $promBs);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $gdcount = count($request->gdpaper_id);
        $after_count = count($request->after_prom_id);
        $sale = new Sale();
        $sale->sale_on = $request->sale_on;
        $sale->user_id = Auth::user()->id;
        $sale->sale_date = $request->sale_date;
        $sale->customer_id = $request->cust_name_q;
        $sale->pet_name = $request->pet_name;
        $sale->kg = $request->kg;
        $sale->type = $request->type;
        $sale->plan_id = $request->plan_id;
        $sale->plan_price = $request->plan_price;
        $sale->before_prom_id = $request->before_prom_id;
        $sale->before_prom_price = $request->before_prom_price;
        $sale->pay_id = $request->pay_id;
        $sale->pay_price = $request->pay_price;
        $sale->comm = $request->comm;
        $sale->save();

        $sale_id = Sale::orderby('id', 'desc')->first();

        for ($i = 0; $i < $gdcount; $i++) {
            $gdpaper = new Sale_gdpaper();
            $gdpaper->sale_id = $sale_id->id;
            $gdpaper->gdpaper_id = $request->gdpaper_id[$i];
            $gdpaper->gdpaper_num = $request->gdpaper_num[$i];
            if ($request->gdpaper_id[$i] != null) {
                $gdpaper_price = Gdpaper::where('id', $request->gdpaper_id[$i])->first();
                if($request->plan_id!='4'){
                    $gdpaper->gdpaper_total = intval($gdpaper_price->price) * intval($request->gdpaper_num[$i]);
                }else{
                    $gdpaper->gdpaper_total = 0;
                }
            } else {
                $gdpaper->gdpaper_total = null;
            }
            $gdpaper->save();
        }

        if (isset($request->after_prom_id)) {
            for ($i = 0; $i < $after_count; $i++) {
                $after_prom = new Sale_promB();
                $after_prom->sale_id = $sale_id->id;
                $after_prom->after_prom_id = $request->after_prom_id[$i];
                $after_prom->after_prom_total = $request->after_prom_total[$i];
                $after_prom->save();
            }
        }

        //寫入總計
        $sale->total = $this->total();
        $sale->save();

        if (Auth::user()->level != 2) {
            return redirect()->route('sale');
        } else {
            return redirect()->route('preson-sale');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customers = Customer::get();
        $plans = Plan::where('status', 'up')->get();
        $gdpapers = Gdpaper::where('status', 'up')->get();
        $promBs = PromB::where('status', 'up')->get();
        $promAs = PromA::where('status', 'up')->get();
        $sale = Sale::where('id', $id)->first();
        $sale_gdpapers = Sale_gdpaper::where('sale_id', $id)->get();
        $sale_promBs = Sale_promB::where('sale_id', $id)->get();
        return view('edit_saledata')->with('sale', $sale)
            ->with('customers', $customers)
            ->with('plans', $plans)
            ->with('gdpapers', $gdpapers)
            ->with('promAs', $promAs)
            ->with('promBs', $promBs)
            ->with('sale_promBs', $sale_promBs)
            ->with('sale_gdpapers', $sale_gdpapers);
    }

    public function check($id)
    {
        $customers = Customer::get();
        $plans = Plan::where('status', 'up')->get();
        $gdpapers = Gdpaper::where('status', 'up')->get();
        $promBs = PromB::where('status', 'up')->get();
        $promAs = PromA::where('status', 'up')->get();
        $sale = Sale::where('id', $id)->first();
        $sale_gdpapers = Sale_gdpaper::where('sale_id', $id)->get();
        $sale_promBs = Sale_promB::where('sale_id', $id)->get();
        return view('check_saledata')->with('sale', $sale)
            ->with('customers', $customers)
            ->with('plans', $plans)
            ->with('gdpapers', $gdpapers)
            ->with('promAs', $promAs)
            ->with('promBs', $promBs)
            ->with('sale_promBs', $sale_promBs)
            ->with('sale_gdpapers', $sale_gdpapers);
    }

    public function check_update(Request $request, $id)
    {
        $sale = Sale::where('id', $id)->first();

        if (Auth::user()->level != 2) {
            if ($request->admin_check == 'check') {
                $sale->status = '9';
                $sale->save();
            }
            if($request->admin_check == 'not_check') {
                $sale->status = '1';
                $sale->save();
            }
            if($request->admin_check == 'reset') {
                $sale->status = '1';
                $sale->save();
            }
        } else {
            if ($request->user_check == 'usercheck') {
                $sale->status = '3';
                $sale->save();
            }
        }



        return redirect()->route('sale');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (isset($request->gdpaper_id)) {
            $gdcount = count($request->gdpaper_id);
        } else {
            $gdcount = 0;
        }

        if (isset($request->after_prom_id)) {
            $after_count = count($request->after_prom_id);
        } else {
            $after_count = 0;
        }

        $sale = Sale::where('id', $id)->first();
        $sale_gdpapers = Sale_gdpaper::where('sale_id', $id)->get();
        $sale_promBs = Sale_promB::where('sale_id', $id)->get();

        $sale->sale_on = $request->sale_on;
        $sale->sale_date = $request->sale_date;
        $sale->customer_id = $request->customer_id;
        $sale->pet_name = $request->pet_name;
        $sale->kg = $request->kg;
        $sale->type = $request->type;
        $sale->plan_id = $request->plan_id;
        $sale->plan_price = $request->plan_price;
        $sale->before_prom_id = $request->before_prom_id;
        $sale->before_prom_price = $request->before_prom_price;
        $sale->pay_id = $request->pay_id;
        $sale->pay_price = $request->pay_price;
        $sale->comm = $request->comm;
        $sale->save();

        $sale_gdpapers = Sale_gdpaper::where('sale_id', $id)->get();
        $sale_promBs = Sale_promB::where('sale_id', $id)->get();
        foreach ($sale_gdpapers as $sale_gdpaper) {
            $gdpaper_id[] = $sale_gdpaper->gdpaper_id;
        }
        foreach ($sale_promBs as $sale_promB) {
            $sale_promB_id[] = $sale_promB->after_prom_id;
        }

        if (!isset($gdpaper_id)) {
            $gdpaper_id_count = 0;
        } else {
            $gdpaper_id_count = count($gdpaper_id);
        }

        if (!isset($sale_promB_id)) {
            $sale_promB_count = 0;
        } else {
            $sale_promB_count = count($sale_promB_id);
        }





        /*修改金紙 */
        if (!isset($gdpaper_id)) {
            for ($i = 0; $i < $gdcount; $i++) {
                $gdpaper_price = Gdpaper::where('id', $request->gdpaper_id[$i])->first();
                $gdpaper = new Sale_gdpaper();
                $gdpaper->sale_id = $id;
                $gdpaper->gdpaper_id = $request->gdpaper_id[$i];
                $gdpaper->gdpaper_num = $request->gdpaper_num[$i];
                if($sale->plan_id!='4'){
                    $gdpaper->gdpaper_total = intval($gdpaper_price->price) * intval($request->gdpaper_num[$i]);
                }else{
                    $gdpaper->gdpaper_total = 0;
                }
                $gdpaper->save();
            }
        }

        if ($gdcount == 0) {
            $gdpaper = new Sale_gdpaper();
            $gdpaper->sale_id = $id;
            $gdpaper->gdpaper_id = null;
            $gdpaper->gdpaper_num = null;
            $gdpaper->gdpaper_total = null;
            $gdpaper->save();
        }

        if ($gdcount == 0 && $gdpaper_id_count > 0) {
            $sale_gdpapers = Sale_gdpaper::where('sale_id', $id)->delete();
            for ($i = 0; $i < $gdcount; $i++) {
                $gdpaper_price = Gdpaper::where('id', $request->gdpaper_id[$i])->first();
                $gdpaper = new Sale_gdpaper();
                $gdpaper->sale_id = $id;
                $gdpaper->gdpaper_id = $request->gdpaper_id[$i];
                $gdpaper->gdpaper_num = $request->gdpaper_num[$i];
                if($sale->plan_id!='4' || $request->gdpaper_id != null){
                    $gdpaper->gdpaper_total = intval($gdpaper_price->price) * intval($request->gdpaper_num[$i]);
                }else{
                    $gdpaper->gdpaper_total = 0;
                }
                $gdpaper->save();
            }
        }

        if ($gdcount > $gdpaper_id_count  || $gdcount < $gdpaper_id_count || $gdcount == $gdpaper_id_count) {
            $sale_gdpapers = Sale_gdpaper::where('sale_id', $id)->delete();
            for ($i = 0; $i < $gdcount; $i++) {
                $gdpaper_price = Gdpaper::where('id', $request->gdpaper_id[$i])->first();
                $gdpaper = new Sale_gdpaper();
                $gdpaper->sale_id = $id;
                $gdpaper->gdpaper_id = $request->gdpaper_id[$i];
                $gdpaper->gdpaper_num = $request->gdpaper_num[$i];
                if($sale->plan_id!='4' || $request->gdpaper_id != null){
                    $gdpaper->gdpaper_total = intval($gdpaper_price->price) * intval($request->gdpaper_num[$i]);
                }else{
                    $gdpaper->gdpaper_total = 0;
                }
                $gdpaper->save();
            }
        }





        /*修改後續方案B */
        if (!isset($after_count)) {
            for ($i = 0; $i < $after_count; $i++) {
                $after_prom = new Sale_promB();
                $after_prom->sale_id = $id;
                $after_prom->after_prom_id = $request->after_prom_id[$i];
                $after_prom->after_prom_total = $request->after_prom_total[$i];
                $after_prom->save();
            }
        }

        if ($after_count == '0') {
            $after_prom = new Sale_promB();
            $after_prom->sale_id = $id;
            $after_prom->after_prom_id = null;
            $after_prom->after_prom_total = null;
            $after_prom->save();
        }

        if ($after_count > $sale_promB_count || $after_count < $sale_promB_count || $after_count == $sale_promB_count) {
            $sale_promBs = Sale_promB::where('sale_id', $id)->delete();
            for ($i = 0; $i < $after_count; $i++) {
                $after_prom = new Sale_promB();
                $after_prom->sale_id = $id;
                $after_prom->after_prom_id = $request->after_prom_id[$i];
                $after_prom->after_prom_total = $request->after_prom_total[$i];
                $after_prom->save();
            }
        }

        //寫入總計
        $sale->total = $this->total();
        $sale->save();


        return redirect()->route('sale');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $customers = Customer::get();
        $plans = Plan::where('status', 'up')->get();
        $gdpapers = Gdpaper::where('status', 'up')->get();
        $promBs = PromB::where('status', 'up')->get();
        $promAs = PromA::where('status', 'up')->get();
        $sale = Sale::where('id', $id)->first();
        $sale_gdpapers = Sale_gdpaper::where('sale_id', $id)->get();
        $sale_promBs = Sale_promB::where('sale_id', $id)->get();
        return view('del_saledata')->with('sale', $sale)
            ->with('customers', $customers)
            ->with('plans', $plans)
            ->with('gdpapers', $gdpapers)
            ->with('promAs', $promAs)
            ->with('promBs', $promBs)
            ->with('sale_promBs', $sale_promBs)
            ->with('sale_gdpapers', $sale_gdpapers);
    }
    public function destroy($id)
    {
        $sale = Sale::where('id', $id)->first();
        $sale_gdpapers = Sale_gdpaper::where('sale_id', $id);
        $sale_promBs = Sale_promB::where('sale_id', $id);

        $sale->delete();
        $sale_gdpapers->delete();
        $sale_promBs->delete();
        return redirect()->route('sale');
    }

    private function total()
    {
        $sale = Sale::orderby('id','desc')->first();
        $plan_price = intval($sale->plan_price);
        $before_prom_price = intval($sale->before_prom_price);
        $after_prom_price = Sale_promB::where('sale_id', $sale->id)->sum('after_prom_total');

        $sales = Sale::where('id', $sale->id)->get();
        foreach ($sales as $sale) {
            foreach ($sale->gdpapers as $gdpaper) {
                if (isset($gdpaper->gdpaper_id) && $gdpaper->gdpaper_id != null) {
                    $num = $gdpaper->gdpaper_num;
                    $price = $gdpaper->gdpaper_name->price;
                    if($sale->plan_id !=4){
                        $totals[] = intval($num) * intval($price);
                    }else{
                        $totals[] = 0;
                    }
                }
            }
        }
        if (isset($gdpaper->gdpaper_id) && $gdpaper->gdpaper_id != null) {
            $gdpaper_total = intval(array_sum($totals));
        }else{
            $gdpaper_total = 0;
        }
        return $plan_price + $before_prom_price + $after_prom_price + $gdpaper_total;
    }

    private function update_total($id)
    {
        $sale = Sale::where('id',$id)->first();
        $plan_price = intval($sale->plan_price);
        $before_prom_price = intval($sale->before_prom_price);
        $after_prom_price = Sale_promB::where('sale_id', $sale->id)->sum('after_prom_total');

        $sales = Sale::where('id', $sale->id)->get();
        foreach ($sales as $sale) {
            foreach ($sale->gdpapers as $gdpaper) {
                if (isset($gdpaper->gdpaper_id) && $gdpaper->gdpaper_id != null) {
                    $num = $gdpaper->gdpaper_num;
                    $price = $gdpaper->gdpaper_name->price;
                    if($sale->plan_id !=4){
                        $totals[] = intval($num) * intval($price);
                    }else{
                        $totals[] = 0;
                    }
                }
            }
        }
        if (isset($gdpaper->gdpaper_id) && $gdpaper->gdpaper_id != null) {
            $gdpaper_total = intval(array_sum($totals));
        }else{
            $gdpaper_total = 0;
        }
        return $plan_price + $before_prom_price + $after_prom_price + $gdpaper_total;
    }
}
