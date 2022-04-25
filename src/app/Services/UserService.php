<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class UserService
{
    /**
     * ログイン時、認証しているユーザーIDを取得し、ログインしていない場合はnullを返す
     */
    public function loginUserId()
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
        return $user_id;
    }
}