<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TopController extends Controller
{
    /**
     * 総合トップ画面
     */
    public function top()
    {
        return view('top');
    }
}
