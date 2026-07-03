<?php

namespace App\Actions;

use App\Models\WorkReport;
use Illuminate\Support\Facades\Validator;


class AddTask 
{

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
/*         Validator::make($input, [
            ...$this->profileRules(),
            'password' => $this->passwordRules(),
        ])->validate();

        return WorkReport::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
        ]); */
    }
}
