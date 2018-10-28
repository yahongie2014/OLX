<?php

namespace App\Http\Controllers;

use App\Models\Services;
use App\Models\SubServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class ServiceTypeAdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(SubServices $serviceTransformer)
    {
        $this->serviceTransformer = $serviceTransformer;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $loginType = Auth::user();

        if($loginType->is_admin == 1)
            $services = $this->serviceTransformer->with("services")->withTranslation()->get();
        else{
            return response() ->json(['status' => true , 'result' => $this->serviceTransformer->withTranslation()->toArray()]);
        }

        return view('admin.service.index')
            ->with([
                'services' => $services,
            ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $services = Services::withTranslation()->get();

        return view('admin.service.create')->with([
            'services' => $services,
        ]);
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
        $data = $request->all();
        \Validator::make(
            $data,
            [
                'is_active' => 'sometimes|required|integer|in:' . SERVICE_TYPE_ACTIVE,
                'en_name' => 'required|max:190',
                'services_id' => 'required|exists:services,id|integer',
                'ar_name' => 'required|max:190',
                'en_desc' => 'required|max:190',
                'ar_desc' => 'required|max:190',
            ]
        )->validate();

        //dd($request->all());

        DB::beginTransaction();
        $serviceType = new $this->serviceTransformer();

        if($request->has('is_active'))
            $serviceType->is_active = SERVICE_TYPE_ACTIVE;

        $serviceType->services_id = $request->services_id;


        if($serviceType->save()) {
            $article_data = [
                'en' => [
                    'name' => $request->input('en_name'),
                    'desc' => $request->input('en_desc'),
                ],
                'ar' => [
                    'name' => $request->input('ar_name'),
                    'desc' => $request->input('en_name'),
                ],
            ];
            $article = $this->serviceTransformer->findOrFail($serviceType->id);
            $article->update($article_data);

            DB::commit();
            return redirect('/admin/services')->with([
                'messageSuccess' => __("general.serviceAddedSuccessfully")
            ]);
        }else{
            DB::rollBack();
            return redirect()->back()->with([
                'messageDander' => __("general.errorAddingService")
            ]);
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
        $main_service = Services::all();
        $service = $this->serviceTransformer->whereHas('translations')->where('id',$id)->first();
        if($service) {
            return view('admin.service.edit')->with([
                'service' => $service,
                'main_service' => $main_service,
            ]);
        } else
            return redirect('/admin/service')->with(['messageDanger' => __('general.serviceNotFound') ]);
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
        $data = $request->all();

        \Validator::make(
            $data,
            [
                'is_active' => 'sometimes|required|integer|in:' . SERVICE_TYPE_ACTIVE,
                'en_name' => 'required|max:190',
                'services_id' => 'required|exists:services,id|integer',
                'ar_name' => 'required|max:190',
                'en_desc' => 'required|max:190',
                'ar_desc' => 'required|max:190',
            ]
        )->validate();

        //dd($request->all());

        DB::beginTransaction();
        $serviceType = $this->serviceTransformer->find($request->service_type_id);


        if($request->has('is_active'))
            $serviceType->is_active = SERVICE_TYPE_ACTIVE;

        $serviceType->services_id = $request->services_id;

        if($serviceType->save()) {
            $article_data = [
                'en' => [
                    'name' => $request->input('en_name'),
                    'desc' => $request->input('en_desc'),
                ],
                'ar' => [
                    'name' => $request->input('ar_name'),
                    'desc' => $request->input('en_name'),
                ],
            ];
            $article = $this->serviceTransformer->findOrFail($serviceType->id);
            $article->update($article_data);

            DB::commit();
            return redirect('/admin/services')->with([
                'messageSuccess' => __("general.serviceUpdatedSuccessfully")
            ]);
        }else{
            DB::rollBack();
            return redirect()->back()->with([
                'messageDander' => __("general.serviceUpdatingError")
            ]);
        }

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
