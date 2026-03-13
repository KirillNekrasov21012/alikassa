<?php

namespace App\Traits\Logs;

use Illuminate\Support\Facades\Log;

trait Logs
{
    public function recordLogError(
        string $context,
        \Throwable|\Exception|\Error $exception
    ): void {
        Log::error($context. ":\n" . print_r([
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'code'    => $exception->getCode(),
        ], true));
    }

    public function recordLogInfo(
        string $context,
        \Throwable|\Exception|\Error $exception
    ): void {
        Log::info($context. ":\n" . print_r([
            'message' => $exception->getMessage(),
            'file' => $exception->getFile(),
            'line' => $exception->getLine(),
            'code'    => $exception->getCode(),
        ], true));
    }

    public function recordLogNotice(
        string $context,
    ): void {
        Log::notice($context);
    }
}
