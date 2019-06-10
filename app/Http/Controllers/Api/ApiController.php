<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ApiController extends Controller
{
    /**
     * Instancja encji User
     *
     * @var object
     */
    protected $user_api;

    /**
     * Konstruktor i autoryzacja api_token
     */
    public function __construct()
    {
        $this->user_api = auth('api')->user() ?  auth('api')->user() : auth('api_token_guard')->user();
    }
}
