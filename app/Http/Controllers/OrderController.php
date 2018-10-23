<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use App\Models\Services;
use App\Models\SubServices;
use App\Payment;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Session;

class OrderController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        $Orders = Orders::with([
            'user' => function($q)  {
                $q->with('user');
            } ,
            'Items' => function($q){
                $q->with("Items");
            },]);


        if($request->has('client_name')){
            $Orders = $Orders->where('user_id', 'LIKE' ,'%' . e(trim($request->client_name)) . '%');
        }


        // Get orders depending on user login
        $loginType = Session::get('login_type');

        // if logged as admin get all
        if($loginType == ADMIN){ // if logged as provider get only where the user is vendor
            $admin = Products::where('user_id',Auth::user()->id)->first(['id']);
            $Orders = $Orders->where('provider_id',$admin->id);
        }elseif ($loginType == PROVIDER){ // if logged as delivery show orders where the users is delivery
            $vendor = Products::where('user_id',Auth::user()->id)->first(['id']);
            $Orders = $Orders->where('delivery_id',$vendor->id);
        }

        //dd($Orders->get()->toArray());

        $outputView = ltrim(Route::current()->action['prefix'],'/') . ".orders.index";
        $editRoute = Route::current()->action['prefix'] . "/orders/";

        $Orders = $Orders->orderBy('created_at','desc')->paginate(10);

        if(Request()->expectsJson()){
            $OrdersOutput = 55 ;
            return response()->json(['status' => true , 'result' => $OrdersOutput->toArray() , 'recordsTotal' => $Orders->total() , 'recordsFiltered' => $Orders->total() , 'draw' => Request()->input('draw') , 'editRoute' => $editRoute]);
        }

        // Get System active Categories
        $categories = SubServices::where('status',CATEGORY_ACTIVE)->get();

        // Get Categories Translated
        $categories = $this->localizeSytemActiveCategories($categories);

        // Get system active Main Services
        $servicesTypes = Services::where('status',SERVICE_TYPE_ACTIVE)->get();

        // Get System active payment Types
        $paymentTypes = Payment::where('payment_type',PAYMENT_TYPE_ACTIVE)->get();

        return view($outputView)
            ->with(
                [
                    'categories' => $categories,
                    'services' => $servicesTypes,
                    'paymentTypes' => $paymentTypes,
                    'editRoute' => $editRoute,
                    'orderStatuses' => $this->orderStatuses
                ]
            );
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function userStatistics(){

        App::setLocale(Session::get('userLanguage.symbol'));

        // Get orders depending on user login
        $loginType = Auth::user();

        // if logged as admin get all
        $provider = $delivery = null;

        if($loginType->is_provider == 1){ // if logged as provider get only where the user is vendor
            $provider = User::where('is_vendor',Auth::user()->id)->get();
        }elseif ($loginType->is_admin == 1){ // if logged as delivery show orders where the users is delivery
            $delivery = User::where('is_admin',Auth::user()->id)->get();
        }

        //-------------- Get Orders status counts for Pie chart

        $ordersCountStatistics = Orders::select("*")->groupBy('status')->select(DB::raw('count(*) as orders_count') , 'status')->get();

        // parse orders by status
        $orderByStatus = ['data' => [] , 'status' => []];


        foreach($ordersCountStatistics as $k => $order){
            $orderByStatus['data'][$k] = $order->orders_count;
            $orderByStatus['status'][$k] = __("general.".\StaticArray::$orderStatus[$order->status]);
            $orderByStatus['dataStatus'][$order->status] = $order->orders_count;
        }


        //------------------------------------------------------------------//

        //-------------- Get Orders count per(all , today , this month , this year)

        // Get total orders by day year Month
        $now = Carbon::now("Africa/Cairo");


        $ordersByDate['all'] = Orders::select("*")->count();


        $ordersByDate['day'] = Orders::select("*")->where(DB::raw("DATE(created_at)") , $now->format("Y-m-d"))->count();


        $ordersByDate['month'] = Orders::select("*")->where(DB::raw("MONTH(created_at)") , $now->month)->count();


        $ordersByDate['year'] = Orders::select("*")->where(DB::raw("YEAR(created_at)") , $now->year)->count();

        //------------------------------------------------------------------//

        //-------------- Get Orders Achievement per minute for (all , today , this month , this year)
        $orderAchievement['total'] = Orders::select("*")
            ->where('status',ORDER_STATUS_DELIVERY_CONFIRMED)
            ->select(DB::raw('TIMESTAMPDIFF(MINUTE,created_at,updated_at)  as minute_diff'))
            ->sum(DB::raw('TIMESTAMPDIFF(MINUTE,created_at,updated_at)'));

        $orderAchievement['day'] = Orders::select("*")
            ->where('status',ORDER_STATUS_DELIVERY_CONFIRMED)
            ->where(DB::raw("DATE(created_at)") , $now->format("Y-m-d"))
            ->select(DB::raw('TIMESTAMPDIFF(MINUTE,created_at,updated_at)  as minute_diff'))
            ->sum(DB::raw('TIMESTAMPDIFF(MINUTE,created_at,updated_at)'));

        $orderAchievement['month'] = Orders::select("*")
            ->where('status',ORDER_STATUS_DELIVERY_CONFIRMED)
            ->where(DB::raw("MONTH(created_at)") , $now->month)
            ->select(DB::raw('TIMESTAMPDIFF(MINUTE,created_at,updated_at)  as minute_diff'))
            ->sum(DB::raw('TIMESTAMPDIFF(MINUTE,created_at,updated_at)'));

        $orderAchievement['year'] = Orders::select("*")
            ->where('status',ORDER_STATUS_DELIVERY_CONFIRMED)
            ->where(DB::raw("YEAR(created_at)") , $now->year)
            ->select(DB::raw('TIMESTAMPDIFF(MINUTE,created_at,updated_at)  as minute_diff'))
            ->sum(DB::raw('TIMESTAMPDIFF(MINUTE,created_at,updated_at)'));
        //------------------------------------------------------------------//

        //-------------- Get Orders Count per this year month [For Line chart]
        $ordersPerMonth['yearMonths'] = [__("general.January"), __("general.February"), __("general.March"), __("general.April"), __("general.May"), __("general.June"), __("general.July") , __("general.August") , __("general.September") , __("general.October") , __("general.November") , __("general.December")];

        $ordersPerMonth['data'] = [];

        $ordersTempPerMonth = Orders::select("*")
            ->select(DB::raw("MONTH(created_at) as month") , DB::raw("(COUNT(*)) as total_orders"))
            ->where(DB::raw("YEAR(created_at)") , $now->year)
            ->groupBy(DB::raw("MONTH(created_at)"))
            ->get()
            ->mapWithKeys(function ($item) {
                return [$item['month'] => $item['total_orders']];
            });
        foreach($ordersPerMonth['yearMonths'] as $k => $month){
            $ordersPerMonth['data'][$k] = isset($ordersTempPerMonth[$k + 1]) ? $ordersTempPerMonth[$k + 1] : 0;
        }
        //------------------------------------------------------------------//

        //-------------- Get Orders Grouped by Location submitted
        $ordersWithLocation = Orders::select("*")->groupBy('created_at')->select(DB::raw('count(*) as orders_count') , 'created_at')->get();

        return response()->json(['success' => 'true' , 'result' => ['orderStatusCount' => $orderByStatus , 'ordersCounts' => $ordersByDate , 'orderAchievement' => $orderAchievement , 'ordersPerMonth' => $ordersPerMonth , 'ordersWithLocationCount' => $ordersWithLocation]]);
    }

}
