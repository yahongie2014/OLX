<?php

namespace App\Http\Controllers;

use App\PaymentType;
use App\ServiceType;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Jobs\SendNotification;
use App\Provider;
use Validator;
class ProviderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $providers = User::select("id")
            ->where('is_vendor',\PROVIDER)
            ->orderBy('id','desc')
            ->get();

        return view('admin.provider.index')->with("providers",$providers);
    }

    public function adminProviderActivation($provider_id){
        $provider = User::find($provider_id);

        if(!$provider)
            return redirect()->back()->with(['messageDanger' => __("general.provider dose not exists")]);
        else{
            if($provider->is_verify == PROVIDER_ACTIVE){
                $provider->is_verify = PROVIDER_INACTIVE;
                $msg = __("general.yourProviderAccountDeActivated");
            }else{
                $provider->status = PROVIDER_ACTIVE;
                $msg = __("general.yourProviderAccountActivated");
            }

            if($provider->save()){
                dispatch(new SendNotification($msg ,$provider->user_id , false));
                return redirect()->back()->with(['messageSuccess' => __("general.provider status changed")]);
            }else{
                return redirect()->back()->with(['messageDanger' => __("general.provider status could not be changed")]);
            }
        }
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
        Validator::make(
            $request->all(),
            [

                'provider_id' => 'required|integer|exists:providers,id|in:' . $id,
                'service' => 'present|array|nullable' ,
                'service.*' => 'numeric|max:100',
                'paymentType' => 'present|array',
                'paymentType.*' => 'numeric|max:100|nullable'
            ]
        )->validate();

        DB::beginTransaction();

        $provider = Provider::find($request->provider_id);

        $provider->promo_code = str_random(8);

        if($provider->save()){
            // Save provider applied discount on services

            $selectedServices = ServiceType::whereIn('id',array_keys($request->service))->pluck('id')->toArray();
            $servicesDiscounts = [];
            foreach ($request->service as $k => $discount){
                if(in_array($k , $selectedServices) && (intval($discount) > 0))
                    $servicesDiscounts[$k]['discount'] = intval($discount);
            }

            $provider->services_discounts()->sync($servicesDiscounts);

            // Save provider applied discount on payment types

            $selectedPaymentTypes = PaymentType::whereIn('id',array_keys($request->paymentType))->pluck('id')->toArray();
            $paymentTypesDiscounts = [];
            foreach ($request->paymentType as $k => $discount){
                if(in_array($k , $selectedPaymentTypes) && (intval($discount) > 0))
                    $paymentTypesDiscounts[$k]['discount'] = intval($discount);
            }

            // Clear previous payment types for this provider before saveing the new ones
            $provider->payment_type_discounts()->sync($paymentTypesDiscounts);
            DB::commit();

            return redirect()->back()->with(['messageSuccess' => __("general.providerPromoCodeUpdated")]);
        }else{
            DB::rollBack();
            return redirect()->back()->with(['messageDanger' => __("general.providerPromoCodeUpdatedError")]);
        }
    }

    /**
     * Update the specified provider promo code discounts.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return \Illuminate\Http\Response
     */

    public function updateProviderPromoCodeDiscounts(Request $request){

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
