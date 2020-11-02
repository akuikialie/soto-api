<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompareImpressionController extends Controller
{
    public function indexInternal(Request $request)
    {
        echo "compare internal";
    }

    public function indexExternal(Request $request)
    {
        echo "compare external";
    }
}
