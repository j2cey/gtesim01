<?php

namespace App\Http\Controllers;

use Spatie\Tags\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function fetchall() {
        return Tag::all();
    }
}
