<?php

namespace App\Validators;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use Request;

class WithdrawAmountValidator extends Validator {
    
    public function validateWithdrawAmount($attribute, $value, $parameters, $validator)
    {
        if (bcmod($value, min(Config::get('developx-ja.available_notes'))) == 0) {
            return true;
        }else{
            return false;
        }
    }
    
}
