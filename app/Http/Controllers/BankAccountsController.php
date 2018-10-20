<?php

namespace App\Http\Controllers;

use App\Http\Requests\BankForm;
use App\Http\Resources\BankApi;
use App\Models\BankAccounts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class BankAccountsController extends Controller
{

    public function __construct(BankAccounts $bank)
    {
        $this->bank = $bank;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return BankApi::collection($this->bank->where("user_id", $request->user()->id)->paginate());
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(BankForm $request)
    {
        $bank = new $this->bank($request->all());
        $bank->user_id = $request->user()->id;
        $bank->save();
        DB::commit();
        return new BankApi($bank);


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BankAccounts $bankAccounts
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $validator = \Validator::make(
            ['id' => $id],
            array(
                'id' => 'required|exists:bank_accounts,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );
        if ($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        } else {
            $only = $this->bank->findOrFail($id);

            if ($request->user()->id !== $only->user_id) {
                return response()->json(['error' => 'You can only show your Accounts.'], 403);
            }

            return new BankApi($only);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BankAccounts $bankAccounts
     * @return \Illuminate\Http\Response
     */
    public function edit(BankAccounts $bankAccounts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Models\BankAccounts $bankAccounts
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, BankAccounts $bankAccounts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BankAccounts $bankAccounts
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $validator = \Validator::make(
            ['id' => $id],
            array(
                'id' => 'required|exists:bank_accounts,id|integer',
            ),
            [
                'id' => __("validation.required"),
            ]
        );

        if ($validator->fails()) {
            return response()->json($validator)->setStatusCode(400);
        } else {
            $soft = $this->bank->findOrFail($id);
            if (!$request->user()->id) {
                return response()->json(['error' => 'You can only delete your Account Bank.'], 403);
            }
            $soft->delete();

            return response()->json(["message" => "Account $soft->bank_name is Deleted"]);
        }

    }
}
