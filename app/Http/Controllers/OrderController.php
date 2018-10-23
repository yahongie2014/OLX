<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use App\Models\Services;
use App\Models\SubServices;
use App\Payment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

class OrderController extends Controller
{

    protected $providerCancelableStatus = [ORDER_STATUS_NEW,ORDER_STATUS_DELIVERY_CANCELLED,ORDER_STATUS_DELIVERY_ASSIGNED,ORDER_STATUS_DELIVERY_ACCEPTED];

    protected $adminCancelableStatus = [ORDER_STATUS_NEW,ORDER_STATUS_DELIVERY_ASSIGNED,ORDER_STATUS_DELIVERY_ACCEPTED,ORDER_STATUS_DELIVERY_STARTED,ORDER_STATUS_DELIVERY_LOADING];

    protected $providerUpdatableOrderStatus = [ORDER_STATUS_NEW,ORDER_STATUS_DELIVERY_CANCELLED,ORDER_STATUS_DELIVERY_ASSIGNED,ORDER_STATUS_DELIVERY_ACCEPTED];

    protected $adminOrderAssignableStatus = [ORDER_STATUS_NEW,ORDER_STATUS_DELIVERY_ASSIGNED,ORDER_STATUS_DELIVERY_ACCEPTED , ORDER_STATUS_DELIVERY_CANCELLED];

    protected $adminReusableOrderStatus = [ORDER_STATUS_NEW,ORDER_STATUS_DELIVERY_ASSIGNED,ORDER_STATUS_DELIVERY_ACCEPTED];

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
                    'orderStatuses' => $this->orderStatuses,
                    'selectedStatuses' => $selectedStatuses,
                    'selectedWithLocation' => $selectedWithLocation
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
}
