<?php

namespace App\Http\Controllers;

use App\Cities;
use App\Jobs\SendNotification;
use App\Language;
use App\Models\Country;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Rule;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admins = User::select("*")
            ->where('is_admin', ADMIN)
            ->orderBy('id', 'desc')
            ->get();

        return view('admin.admins.index')->with("admins", $admins);

    }

    public function adminActivation($id)
    {
        $admin = User::find($id);

        if (!$admin)
            return redirect()->back()->with(['messageDanger' => __("general.provider dose not exists")]);
        else {
            if ($admin->is_verify == PROVIDER_ACTIVE) {
                $admin->is_verify = PROVIDER_INACTIVE;
                $msg = __("general.yourAdminAccountDeActivated");
            } else {
                $admin->is_verify = PROVIDER_ACTIVE;
                $msg = __("general.yourAdminAccountActivated");
            }

            if ($admin->save()) {
                dispatch(new SendNotification($msg, $admin->id, false));
                return redirect()->back()->with(['messageSuccess' => __("general.provider status changed")]);
            } else {
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

        $countries = Country::withTranslation()->get();
        // Get user country cities
        $cities = Cities::where('country_id', $countries[0]->id)->withTranslation()->get();

        $languages = Language::all();

        $outputData['countries'] = $countries;
        $outputData['languages'] = $languages;
        $outputData['cities'] = $cities;

        return view("admin.admins.show")
            ->with($outputData);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = $request->all();

        \Validator::make(
            $data,
            [
                'name' => 'sometimes|required|string|max:190',
                'email' => 'sometimes|required|email|max:190|unique:users,email,',
                'phone' => ['sometimes', 'required', 'unique:users,phone'],
                'language_id' => 'sometimes|required|exists:languages,id|integer',
                'country_id' => 'sometimes|required|exists:countries,id|integer',
                'city_id' => ['sometimes', 'required'],
            ]
        )->validate();

        // Get that user data
        $user = new User();

        $user->name = e(trim($request->name));

        $user->password =  bcrypt($request->password);

        $user->email = e(trim($request->email));

        $user->phone = $request->phone;

        $user->language_id = $request->language_id;

        $user->is_admin = ADMIN;

        $user->city_id = $request->city_id;

        if ($request->hasfile('image')) {

            $userImage = $request->file(['image']);
            $name_cover = $userImage->getClientOriginalName();
            $imgExtension = $userImage->getClientOriginalExtension();
            $path = Storage::putFileAs('/public/Avatar', $userImage, $name_cover);
            $user->image = $name_cover;
        }

        if ($request->hasfile('coverImage')) {

            $userImage = $request->file(['coverImage']);

            // get the image extension
            $imgExtension = $userImage->getClientOriginalExtension();

            //profile Images uploading path
            $path = 'uploads/profile/';

            // assign name to the image
            $fileName = uniqid() . '.' . $imgExtension;

            // move the image to profile folder
            $userImage->move($path, $fileName);

            $user->cover_image = $path . $fileName;
        }

        if ($user->save())
            return redirect()->back()->with(['messageSuccess' => __('general.User profile updated successfully')]);
        else
            return redirect()->back()->with(['messageDanger' => __('general.User profile is not updated try again later')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
