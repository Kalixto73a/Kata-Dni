<?php

namespace App\Http\Controllers\Api;

use App\Models\DniLetter;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class DniCalculationController extends Controller
{
    public function index(Request $request)
    {
        try {
            $validated = $request->validate([
                'dni_number' => 'required|digits:8|numeric',
            ]);
            $dniNumber = $validated['dni_number'];
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
                return response()->json(['error' => 'Letter not found'], 404);
            }
    
        } catch (ValidationException $e) {
            $errors = $e->errors();
            return response()->json([
                'message' => $errors,
            ], 400);
        }
    }
}
