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

        $providers = User::select("*")
            ->where('is_vendor',PROVIDER)
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
                $provider->is_verify = PROVIDER_ACTIVE;
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

                'provider_id' => 'required|integer|exists:users,id|in:' . $id,
            ]
        )->validate();

        DB::beginTransaction();

        $provider = User::find($request->provider_id);

        $provider->promo_code = str_random(8);

        if($provider->save()){
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
