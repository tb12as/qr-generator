<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class ApiController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function json($param, int $statusCode = 200)
    {
        return response()->json($this->setDefaultResponseKey($param), $statusCode);
    }

    private function setDefaultResponseKey($content)
    {
        if (is_string($content)) {
            return ['message' => $content];
        }

        return $content;
    }
}
