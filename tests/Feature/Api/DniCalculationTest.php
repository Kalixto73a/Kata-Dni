<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\DniLetter;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DniCalculationTest extends TestCase
{   
    use RefreshDatabase;
    public function testValidDniReturnsCorrectLetter()
    {   
        $dniNumber = 10000000;
        $letters = ['T', 'R', 'W', 'A', 'G', 'M', 'Y', 'F', 'P', 'D', 'X', 'B', 'N', 'J', 'Z', 'S', 'Q', 'V', 'H', 'L', 'C', 'K', 'E'];
        foreach ($letters as $index => $letter) {
            DniLetter::create([
                'id' => $index + 1,
                'letter' => $letter,
            ]);
        }
        $response = $this->json('GET', '/api/dni', ['dni_number' => $dniNumber]);

        return $response->assertStatus(200)
                ->assertJson([
                    'data' => [
                        'dni_number' => $dniNumber,
                        'dni_letter' => 'Z',
                    ]
                ]);
    }
    public function testItReturns400ForInvalidDni()
    {
        $dniNumber = 4356;
        DniLetter::all();
        $response = $this->json('GET', '/api/dni', ['dni_number' => $dniNumber]);
        return $response->assertStatus(400)
                        ->assertJson([
                            'message' => [
                                'dni_number' => [
                                'The dni number field must be 8 digits.',
                                ],
                            ],
                        ]);
    }
    public function testIfReturns404IfLetterNotFound()
    {
        DniLetter::create(['letter' => 'T']);
        DniLetter::create(['letter' => 'R']);
        $dniNumber = 99999999;
        $response = $this->json('GET', '/api/dni', ['dni_number' => $dniNumber]);
        $response->assertStatus(404)
                 ->assertJson([
                     'error' => 'Letter not found',
                 ]);
    }
}
