<?php

namespace App\Models;

use App\Services\UserService;
use App\Traits\RegCodeTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Throwable;

class Device extends Model
{
    use HasFactory, RegCodeTrait;

    /**
     * @var string[]
     */
    protected $fillable = [
        "name",
        "imei",
        "reg_code",
        "user_id",
        "desc"
    ];


    /**
     * @var string[]
     */
    protected $appends = [
        "user_detail"
    ];

    /**
     * @var string
     */
    public static string $reg_code = "C";


    /**
     * @return mixed
     * @throws Throwable
     */
    public function getUserDetailAttribute(): mixed
    {
        return ((new UserService())->show(1))["data"];
    }
}
