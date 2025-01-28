<?php

namespace App\Http\Controllers\Api;

use App\Models\DniLetter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class DniCalculationController extends Controller
{
    public function index(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'dni_number' => 'required|integer|min:0|max:99999999',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => 'El número de DNI es inválido.'], 400);
        }

        $dniNumber = $request->input('dni_number');
        $remainder = $dniNumber % 23;
        $letter = DniLetter::where('id', $remainder + 1)->first();

        if ($letter) {
            return response()->json([
                'data' => [
                    'dni_number' => $dniNumber,
                    'dni_letter' => $letter->letter,
                ]
            ], 200);
        } else {
            return response()->json(['error' => 'Letra no encontrada'], 404);
        }
    }
}
