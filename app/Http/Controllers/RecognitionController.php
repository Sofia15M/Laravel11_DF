<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RecognitionController extends Controller
{
    public function recognize(Request $request)
    {
        $response = Http::post('10.171.146.125:5000', [
            'id' => $request->input('id'),
            'photo' => base64_encode(file_get_contents($request->file('photo')->getRealPath())), // Codifica la foto en base64
        ]);

        $result = $response->json();

        return response()->json($result);
    }
}
