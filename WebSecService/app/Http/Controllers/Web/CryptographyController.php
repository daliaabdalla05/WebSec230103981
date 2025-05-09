<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Str;

class CryptographyController extends Controller
{
    public function index()
    {
        return view('cryptography');
    }

    public function process(Request $request)
    {
        $action = $request->input('action');
        $result = '';

        switch ($action) {
            case 'encrypt':
                $text = $request->input('text_to_encrypt');
                
                $result = Crypt::encryptString($text);
                break;

            case 'decrypt':
                $text = $request->input('text_to_decrypt');
                
                try {
                    $result = Crypt::decryptString($text);
                } catch (\Exception $e) {
                    $result = "Error: Invalid encrypted text";
                }
                break;

            case 'hash':
                $text = $request->input('text_to_hash');
                $algorithm = $request->input('hash_algorithm', 'sha256');
                $result = hash($algorithm, $text);
                break;
        }

        return view('cryptography', ['result' => $result]);
    }
} 