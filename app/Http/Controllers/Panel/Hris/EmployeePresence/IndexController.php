<?php

namespace App\Http\Controllers\Panel\Hris\EmployeePresence;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\HrisEmployeePresence;
use App\Models\HrisEmployee;
use Illuminate\Http\JsonResponse;

use Carbon\Carbon;
use Illuminate\Support\Str;

class IndexController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $data = HrisEmployeePresence::orderBy('presence_date', 'desc');

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Successfull',
            'datas' => $data->paginate($request->limit),
        ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
