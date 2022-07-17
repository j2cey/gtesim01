<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Traits\Base\UuidTrait;

class UuidController extends Controller
{
    use UuidTrait;

    public function generate() {
        return UuidController::generateUuid();
    }
}
