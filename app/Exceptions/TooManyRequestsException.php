<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\Exceptions\ThrottleRequestsException;

class TooManyRequestsException extends Exception
{
}
