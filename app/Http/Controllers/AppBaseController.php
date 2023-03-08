<?php

namespace App\Http\Controllers;

use App\Helpers\ResponseUtil;

class AppBaseController extends Controller
{
    public function sendResponse($result, $message)
    {
        return response()->json(ResponseUtil::makeResponse($message, $result));
    }

    public function sendError($error, $code = 404)
    {
        return response()->json(ResponseUtil::makeError($error), $code);
    }

    public function sendSuccess($message)
    {
        return response()->json([
            'success' => true,
            'message' => $message
        ], 200);
    }

    public function sendSelec2Response($result, $message, $hasMore)
    {
        return response()->json([
            'success' => true,
            'results' => $result,
            'pagination' => ["more" => $hasMore],
            'message' => $message,
        ]);
    }
}
