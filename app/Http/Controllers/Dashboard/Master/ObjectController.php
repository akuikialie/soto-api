<?php

namespace App\Http\Controllers\Dashboard\Master;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Target;

class ObjectController extends Controller
{
    public function index(Request $request)
    {
        $data['datas'] = Target::get();

        return view('master.object-index', $data);
    }
}
