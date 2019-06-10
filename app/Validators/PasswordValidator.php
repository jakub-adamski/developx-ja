<?php

namespace App\Validators;

use Illuminate\Support\Facades\Validator;
use Request;

class PasswordValidator extends Validator {
    
    public function validatePassword($attribute, $value, $parameters, $validator)
    {
        if(strlen($value) < 6){
            return false;
        }else if(!preg_match("#[0-9]+#", $value)){
            return false;
        }else{
            return true;
        }
    }
    
}