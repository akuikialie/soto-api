<?php

namespace App\Http\Controllers\Panel\Notification\Device;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\NotificationWhatsappDevice;
use Illuminate\Http\JsonResponse;

class IndexController extends Controller
{
    public function index(): JsonResponse
    {
        $data = NotificationWhatsappDevice::all();

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Successfull',
            'data' => $data,
        ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }
}
