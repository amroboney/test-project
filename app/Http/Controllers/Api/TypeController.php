<?php

namespace App\Http\Controllers\Api;

use App\Models\Type;
use App\Http\Controllers\Controller;

class TypeController extends Controller
{
    public function getTypes()
    {
        $type = Type::all();
        return response()->json(['responseCode' => 100, 'responseMessage' => 'Success', 'data' => $type]);
    }
}
