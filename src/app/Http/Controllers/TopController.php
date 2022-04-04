<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopController extends Controller
{
    /**
     * 総合トップ画面
     */
    public function top()
    {
        // ユーザーがログイン済み
        if (Auth::check()) {
            // 認証しているユーザーを取得
            $user = Auth::user();
            // 認証しているユーザーIDを取得
            $user_id = $user->id;
        } else {
            $user_id = null;
        }

        return view('top', compact('user_id'));
    }
}
