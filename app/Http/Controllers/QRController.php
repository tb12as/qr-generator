<?php

namespace App\Http\Controllers;

use App\Services\QRService;
use Illuminate\Http\Request;

class QRController extends ApiController
{
    public function generate(Request $request)
    {
        $request->validate([
            'text' => 'required|string|min:20',
        ]);

        return $this->json([
            'result' => QRService::generate($request->text),
            'text' => $request->text,
        ]);
    }
}
