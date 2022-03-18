<?php

namespace App\Http\Controllers;
use Dingo\Api\Routing\Helpers;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use League\Fractal\Serializer\ArraySerializer;
use Ramsey\Uuid\Uuid;

class BaseController extends Controller
{
    use Helpers, AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function successWithPages($paginator, $transformer, $resourceName = null)
    {
        $collection = $paginator->getCollection();

        if (!$resourceName) {
            $resourceName = "items";
        }

        $data = fractal()
            ->collection($collection)
            ->transformWith($transformer)
            ->serializeWith(new ArraySerializer())
            ->withResourceName($resourceName)
            ->paginateWith(new IlluminatePaginatorAdapter($paginator))
            ->toArray();

        return response()->json([
            'status' => "success",
            'data' => $data,
        ]);
    }

    protected function transform($model, $transformer)
    {
        $data = fractal($model, $transformer)->serializeWith(new \Spatie\Fractalistic\ArraySerializer());
        return $this->success($data);
    }

    public function sendReply($result, $message)
    {
    	$response = [
            'success' => true,
            'data'    => $result,
            'message' => $message,
        ];
        return response()->json($response, 200);
    }

    // protected function handleErrorResponse($response)
    // {
    //     if (isset($response['error'])) {
    //         return $this->error($response['message'], $response['status_code']);
    //     }
    //     return $this->fail($response['message'], $response['status_code']);
    // }

    public function sendError($error, $errorMessages = [], $code = 404)
    {
    	$response = [
            'success' => false,
            'message' => $error,
        ];
        if(!empty($errorMessages)){
            $response['data'] = $errorMessages;
        }
        return response()->json($response, $code);
    }

    protected function fail($data, $code = null)
    {
        if (!$code || is_string($code)) {
            $code = 422;
        }
        return response()->json([
            'status' => "fail",
            'data' => $data,

        ], $code);
    }

    public function generateUuid()
    {
        return Uuid ::uuid4()->toString();
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            // 'expires_in' => auth()->factory()->getTTL()*60
           ]);
    }
}
