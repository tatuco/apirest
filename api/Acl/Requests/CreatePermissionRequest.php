<?php

namespace Api\Acl\Requests;

use Infrastructure\Http\ApiRequest;

class CreatePermissionRequest extends ApiRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
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
