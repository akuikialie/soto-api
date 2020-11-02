<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DigitalImpressionController extends Controller
{
    public function indexImpression(Request $request)
    {
        echo "digital impression";
    }

    public function indexBrief()
    {
        echo "digital brief";
    }
}
