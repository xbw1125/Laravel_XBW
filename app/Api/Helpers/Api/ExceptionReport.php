<?php

namespace App\Api\Helpers\Api;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;

class ExceptionReport
{
    use ApiResponse;

    public $exception;
    public $request;
    protected $report;

    public $doReport = [
        AuthenticationException::class => ['未授权', 401],
        ModelNotFoundException::class => ['模型未找到', 404],
        ValidationException::class => ['error_message', 200],
        UnauthorizedHttpException::class => ['JWT', 401],
    ];

    function __construct(Request $request, Exception $exception)
    {
        $this->request = $request;
        $this->exception = $exception;
    }

    public function shouldReturn()
    {
//        if (!($this->request->wantsJson() || $this->request->ajax())) {
//            return false;
//        }
        foreach (array_keys($this->doReport) as $report) {
            if ($this->exception instanceof $report) {
                $this->report = $report;
                return true;
            }
        }
        return false;
    }

    public static function make(Exception $e)
    {
        return new static(\request(), $e);
    }

    public function report()
    {
        $message = $this->doReport[$this->report];
        if ($this->exception instanceof ValidationException) {
            $message[0] = $this->exception->errors();
        }
        if ($this->exception instanceof UnauthorizedHttpException) {
            $message[0] = $this->exception->getMessage();
        }
        return $this->failed($message[0], $message[1]);
    }
}