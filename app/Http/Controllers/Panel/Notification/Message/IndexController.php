<?php

namespace App\Http\Controllers\Panel\Notification\Message;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

use App\Http\Controllers\Controller;
use App\Models\NotificationMessage;
use Illuminate\Http\JsonResponse;

use Carbon\Carbon;

class IndexController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $data = NotificationMessage::orderBy('requested_at', 'desc');

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Successfull',
            'datas' => $data->paginate($request->limit),
        ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function indexRequest(Request $request): JsonResponse
    {
        $data = NotificationMessage::orderBy('scheduled_at', 'desc')
            ->whereNotNull('scheduled_at')
            ->whereNull('sent_at')
            // ->whereNull('requested_at')
            ->where('actived', true);
        
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Successfull',
            'datas' => $data->paginate($request->limit),
        ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function indexSent(Request $request): JsonResponse
    {
         $data = NotificationMessage::orderBy('sent_at', 'desc')
            ->whereNotNull('sent_at')
            ->whereNotNull('requested_at')
            ->whereDate('scheduled_at', '>', $newDateTime = Carbon::now()->subDays(14))
            ->whereDate('scheduled_at', '<', Carbon::now())
            ->where('actived', true);
        
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Successfull',
            'datas' => $data->paginate($request->limit),
        ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function indexDraft(Request $request): JsonResponse
    {
        $data = NotificationMessage::orderBy('requested_at', 'desc')
            ->whereNull('scheduled_at')
            ->whereNull('sent_at')
            ->whereNull('requested_at')
            ->where('actived', true);
        
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Successfull',
            'datas' => $data->paginate($request->limit),
        ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function updateDraftNow(Request $request, $id): JsonResponse
    {
        $data = NotificationMessage::find($id);

        if (!$data) {
            return response()->json([
                'status' => true,
                'code' => 400,
                'message' => 'Data Not Found',
                'datas' => [],
            ], 400, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        }
        $data->scheduled_at = Carbon::now();
        $data->save();

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Successfull',
            'data' => $data,
        ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function updateRequestNow(Request $request, $id): JsonResponse
    {
        $data = NotificationMessage::find($id);

        if (!$data) {
            return response()->json([
                'status' => true,
                'code' => 400,
                'message' => 'Data Not Found',
                'datas' => [],
            ], 400, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
        }
        $data->requested_at = Carbon::now();
        $data->save();

        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Successfull',
            'data' => $data,
        ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

    public function indexArchive(Request $request): JsonResponse
    {
        $data = NotificationMessage::orderBy('requested_at', 'desc')
            ->where('actived', false);
        
        return response()->json([
            'status' => true,
            'code' => 200,
            'message' => 'Successfull',
            'datas' => $data->paginate($request->limit),
        ], 200, [], JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT);
    }

}
