<?php

namespace App\Http\Controllers;

use App\Models\Catalog;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function getCatalog()
    {
        $data = Catalog::all();
        return response()->json(['data' => $data], 200);
    }
}
