<?php

namespace App\Http\Controllers\Api;

use App\Models\User\User;
use App\Models\User\UserTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;

class UserTransactionController extends ApiController
{
    public function get()
    {
        return response()->json([
            'results' => UserTransaction::where('user_id', '=', $this->user_api->id)->orderBy('id', 'desc')->take(10)->get()
        ]);
    }

    public function create(Request $request)
    {
        //1. validate received data
        $validation = Validator::make($request->all(), [
            'value' => 'required|numeric|min:'.min(Config::get('developx-ja.available_notes')).'|max:999999999999|validateWithdrawAmount',
        ]);
        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ],422);
        } else {

            $user_transaction = new UserTransaction();
            $user_transaction->user_id = $this->user_api->id;
            $user_transaction->value = $request->value;
            $user_transaction->save();

            $available_notes = Config::get('developx-ja.available_notes');
            $noteCount = array_fill(0, count(Config::get('developx-ja.available_notes')), 0);
            $results = [];

            for($i=0; $i<count($available_notes); $i++){
                if($available_notes[$i] < $request->value || $available_notes[$i] == $request->value){
                    $noteCount[$i] = intval($request->value/$available_notes[$i]);
                    $request->value = $request->value-$noteCount[$i]*$available_notes[$i];
                }
            }

            for($i=0; $i<count($noteCount); $i++){
                if($noteCount[$i] != 0){
                    $output = [
                        'note' => $available_notes[$i],
                        'note_count' => $noteCount[$i],
                        'total' => $available_notes[$i] * $noteCount[$i]
                    ];
                    array_push($results, $output);
                }
            }

            return response()->json([
                'results' => $results
            ]);
        }
    }

    public function update(Request $request)
    {

    }

    public function updatePartially(Request $request)
    {

    }

    public function delete()
    {

    }

}
