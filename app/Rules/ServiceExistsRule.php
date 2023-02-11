<?php

namespace App\Rules;

use App\Traits\HttpTrait;
use Closure;
use Exception;
use Illuminate\Contracts\Validation\InvokableRule;

class ServiceExistsRule implements InvokableRule
{
    use HttpTrait;

    public $url;
    public $id;

    public function __construct($url, $id)
    {
        $this->url = $url;
        $this->id = $id;
    }


    /**
     * @param $attribute
     * @param $value
     * @param $fail
     * @return void
     * @throws \Throwable
     */
    public function __invoke($attribute, $value, $fail)
    {
        try {
            $this->request($this->url . "/" . $this->id, "get");
        } catch (Exception $e) {
            $fail(":attribute kayıtlı değil");
        }
    }
}
