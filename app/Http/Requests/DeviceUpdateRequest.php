<?php

namespace App\Http\Requests;

use App\Models\Device;
use App\Rules\ServiceExistsRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class DeviceUpdateRequest extends FormRequest
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
                "string",
                Rule::unique(Device::class)->ignore($this->id)
            ],
            "name" => [
                "string",
            ],
            "user_id" => [
                "integer",
                (new ServiceExistsRule(env("AUTH_SERVICE_URL") . "users", $this->user_id))
            ]
        ];
    }
}
