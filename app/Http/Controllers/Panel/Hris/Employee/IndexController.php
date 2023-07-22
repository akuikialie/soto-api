<?php

namespace App\Http\Controllers\Panel\Hris\Employee;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\HrisEmployee;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $data = HrisEmployee::orderBy('name', 'asc');

        if ($request->name) {
            $data->where('name', 'like', '%'.$request->name.'%');
        }

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Successfull',
            'datas' => $data->paginate($request->limit),
        ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
