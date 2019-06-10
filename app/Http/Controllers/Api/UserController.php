<?php

namespace App\Http\Controllers\Api;

use App\Models\User\User;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserController extends ApiController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Konstruktor i autoryzacja api_token
     * Wyłącza niektóre metody z autoryzacji po tokenie
     */
    public function __construct()
    {
        parent::__construct();
    }

    public function get()
    {
        return response()->json([
            'User' => $this->user_api,
        ]);
    }

    public function create(Request $request)
    {
        //1. validate received data
        $validation = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'email' => 'required|email|max:100|unique:user',
            'password' => 'required|min:6|max:255|validatePassword',
            'password_confirmation' => 'required|same:password'
        ]);
        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ],422);
        } else {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->api_token = bcrypt(implode('|', [$request->name, $request->email, $request->password]));
            $user->save();
            return response()->json([
                'user' => $user
            ]);
        }
    }

    public function update(Request $request)
    {
        //1. validate received data
        $validation = Validator::make($request->all(), [
            'name' => 'required|min:2|max:100',
            'password' => 'required|min:6|max:255|validatePassword',
            'password_confirmation' => 'required|same:password'
        ]);
        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ],422);
        } else {
            $user = $this->user_api;
            $user->name = $request->name;
            $user->password = bcrypt($request->password);
            $user->save();

            return response()->json([
                'user' => User::with('transactions')->whereKey($user->id)->first()
            ]);
        }
    }

    public function updatePartially(Request $request)
    {
        //1. validate received data
        $validation = Validator::make($request->all(), [
            'name' => 'min:2|max:100|validateUserFirstName',
            'password' => 'min:6|max:255|validatePassword',
            'password_confirmation' => 'same:password'
        ]);
        if ($validation->fails()) {
            return response()->json([
                'errors' => $validation->errors()
            ],422);
        } else {

            $user = $this->user_api;
            if (!empty($request->name)) {
                $user->name = $request->name;
            }
            if (!empty($request->password)) {
                $user->password = bcrypt($request->password);
            }
            $user->save();

            return response()->json([
                'user' => User::with('transactions')->whereKey($user->id)->first()
            ]);
        }
    }

    public function delete()
    {
        $user = $this->user_api;
        $user->delete();
        return response()->json([
            'alert' => ['deleted' => ["User was deleted. (id=" . $user->id . ")"]]
        ]);
    }

}
