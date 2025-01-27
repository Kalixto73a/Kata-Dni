<?php

namespace App\Http\Controllers;

use App\Models\DniLetter;
use Illuminate\Http\Request;

class DniCalculationController extends Controller
{
    public function calculate(Request $request){
        $validated = $request->validate([
            'dni_number' => 'required|integer|min:0|max:99999999',
        ]);
        $dniNumber = $validated['dni_number'];
        $remainder = $dniNumber % 23;
        $letter = DniLetter::find($remainder + 1);
        if ($letter) {
            return response()->json([
                'dni_number' => $dniNumber,
                'dni_letter' => $letter->letter,
            ]);
        } else {
            return response()->json(['error' => 'Letra no encontrada'], 404);
        }
    }
}
