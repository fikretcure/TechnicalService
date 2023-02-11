<?php

namespace App\Services;


use Throwable;

/**
 *
 */
class UserService extends Services
{


    /**
     * @throws Throwable
     */
    public function show($id)
    {
        return $this->request(env("AUTH_SERVICE_URL") . "users/" . $id, "get");
    }
}
