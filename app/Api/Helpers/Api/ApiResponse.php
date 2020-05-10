<?php

namespace App\Api\Helpers\Api;

use Symfony\Component\HttpFoundation\Response as FoundationResponse;
use Illuminate\Support\Facades\Response;

trait ApiResponse
{
    protected $statusCode = FoundationResponse::HTTP_OK;

    public function success($data, $status = "success")
    {
        return $this->status($status, compact('data'));
    }

    public function error($data, $code = null, $status = "error")
    {
        return $this->status($status, compact('data'), $code);
    }

    public function failed($message, $code = FoundationResponse::HTTP_BAD_REQUEST, $status = 'error')
    {
        return $this->message($message, $code, $status);
    }

    public function message($message, $code = null, $status = "success")
    {
        return $this->status($status, compact('message'), $code);
    }

    public function status($status, array $data, $code = null)
    {
        if ($code) {
            $this->setStatusCode($code);
        }
        $status = [
            'status' => $status,
            'code' => $this->statusCode
        ];
        $data = array_merge($status, $data);
        return $this->respond($data);
    }

    public function respond($data, $header = [])
    {
        return Response::json($data, $this->getStatusCode(), $header);
    }

    public function getStatusCode()
    {
        return $this->statusCode;
    }

    public function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
        return $this;
    }
    public function respondForPaginate($collection, $status = 'success', $code = null)
    {
        if ($code) {
            $this->setStatusCode($code);
        }

        $status = [
            'status' => $status,
            'code' => $this->statusCode
        ];

        return $collection->additional($status);
    }
}