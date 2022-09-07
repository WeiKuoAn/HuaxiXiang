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

class CustomerController extends Controller
{
    /*ajax*/
    public function customer(Request $request)
    {
        if ($request->ajax()) {
            $output = "";
            $custs = Customer::where('name', 'like', $request->cust_name . '%')->get();

            if($custs){
                foreach ($custs as $key => $cust) {
                    $output.=  '<option value="'.$cust->id.'" label="('.$cust->name.')-'.$cust->mobile.'">';
                  }
            }
            return Response($output);
        }
       
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $customers = Customer::paginate(30);
        if ($request) {
            $name = $request->name . '%';
            if (!empty($name)) {
                $customers = Customer::where('name', 'like', $name)->paginate(30);
            }
            $mobile = $request->mobile . '%';
            if (!empty($mobile)) {
                $customers = Customer::where('mobile', 'like', $mobile)->paginate(30);
            }
            if (!empty($name) && !empty($mobile)) {
                $customers = Customer::where('name', 'like', $name)->where('mobile', 'like', $mobile)->paginate(30);
            }
            $condition = $request->all();
        } else {
            $condition = '';
        }
        return view('customers')->with('customers', $customers)
            ->with('request', $request)
            ->with('condition', $condition);
    }


    public function customer_sale($id, Request $request)
    {
        $customer = Customer::where('id', $id)->first();
        if ($request) {
            if (Auth::user()->level != 2) {
                $sales = Sale::where('customer_id',  $id)->where('status', 9);
            } else {
                $sales = Sale::where('customer_id',  $id)->where('user_id', Auth::user()->id)->where('status', 9);
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
            $sales = $sales->orderby('id', 'desc')->paginate(15);
            $price_total = $sales->sum('pay_price');
            $condition = $request->all();

            foreach ($sales as $sale) {
                $sale_ids[] = $sale->id;
            }

            if (isset($sale_ids)) {
                $gdpaper_total = Sale_gdpaper::whereIn('sale_id', $sale_ids)->sum('gdpaper_total');
            } else {
                $gdpaper_total = 0;
            }
        } else {
            $condition = ' ';
            $sales = Sale::where('user_id', $id)->where('status', '1')->orderby('sale_date', 'desc')->paginate(15);
            $price_total = Sale::where('user_id', $id)->where('status', '1')->sum('pay_price');
        }
        $users = User::get();
        return view('cust_sale')->with('sales', $sales)
            ->with('request', $request)
            ->with('customer', $customer)
            ->with('users', $users)
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
        return view('new_customer');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer = new Customer;
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->county = $request->county;
        $customer->district = $request->district;
        $customer->address = $request->address;
        $customer->created_up = Auth::user()->id;
        $customer->save();
        return redirect()->route('customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::where('id', $id)->first();
        return view('edit_customer')->with('customer', $customer);
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
        $customer = Customer::where('id', $id)->first();
        $customer->name = $request->name;
        $customer->mobile = $request->mobile;
        $customer->county = $request->county;
        $customer->district = $request->district;
        $customer->address = $request->address;
        $customer->save();
        return redirect()->route('customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::where('id', $id)->first();
        return view('del_customer')->with('customer', $customer);
    }

    public function delete($id)
    {
        $customer = Customer::where('id', $id)->first();
        $customer->delete();
        return redirect()->route('customer');
    }
}
