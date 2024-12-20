<?php

namespace ToxyTech\Api\Http\Requests;

use ToxyTech\Base\Rules\OnOffRule;
use ToxyTech\Support\Http\Requests\Request;

class ApiSettingRequest extends Request
{
    public function rules(): array
    {
        return [
            'api_enabled' => [new OnOffRule()],
        ];
    }
}
