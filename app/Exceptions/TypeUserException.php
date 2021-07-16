<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\Log;

class TypeUserException extends Exception
{
        /**
     * Report or log an exception.
     *
     * @return void
     */
    public function report()
    {
        Log::error('Type does not exists.');
    }
}
