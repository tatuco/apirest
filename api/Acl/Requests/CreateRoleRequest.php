<?php

namespace Api\Acl\Requests;

use Infrastructure\Http\ApiRequest;

class CreateRoleRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'role' => 'array|required',
            'name' => 'required|string',
            'slug' => 'required|string',
            'description' => 'required|string'
        ];
    }

    public function attributes()
    {
        return [
            //'user.email' => 'the user\'s email'
        ];
    }
}
