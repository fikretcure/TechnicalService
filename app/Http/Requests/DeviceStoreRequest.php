<?php

namespace App\Http\Requests;

use App\Models\Device;
use App\Rules\ServiceExistsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeviceStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            "imei" => [
                "required",
                "string",
                Rule::unique(Device::class)
            ],
            "name" => [
                "required",
                "string",
            ],
            "user_id" => [
                "required",
                "integer",
                (new ServiceExistsRule(env("AUTH_SERVICE_URL") . "users", $this->user_id))
            ]
        ];
    }
}
