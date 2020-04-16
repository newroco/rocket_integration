<?php

namespace OCA\Messenger\Rocket;

use Httpful\Request;

class User extends Client
{
    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        try {
            $response = Request::get($this->api . 'users.list')->send();

            if ($response->code == 200 && isset($response->body->success) && $response->body->success == true) {
                return [
                    'status' => 'success',
                    'users' => $response->body->users,
                ];
            }

            return [
                'status' => 'fail',
                'message' => $response->body->error,
            ];
        } catch (\Exception $exception) {
            return [
                'status' => 'fail',
                'message' => 'Connection Error',
            ];
        }
    }
}
