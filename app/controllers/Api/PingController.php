<?php
namespace App\Controllers\Api;

use Core\ApiResponse;

class PingController
{
    public function index(): string
    {
        return ApiResponse::success('pong', [
            'time' => date('c')
        ]);
    }
}
