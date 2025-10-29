<?php

namespace App\Http\Controllers;

use App\Annotation\SuccessResponse;
use App\Annotation\SwaggerAPI;
use App\Core\Http\Request;
use App\Core\Http\Response;
use App\Models\User;

/**
 * 認證控制器，示範登入流程並回傳使用者資訊。
 */
class AuthController extends Controller
{
    #[SwaggerAPI(
        title: '登入',
        desc: '提供帳號與密碼以取得登入結果。',
        success: new SuccessResponse(value: '登入成功', type: User::class)
    )]
    public function login(Request $request): Response
    {
        $account = (string) $request->query('account', 'demo');
        $password = (string) $request->query('password', 'secret');

        $user = new User(1, '示範使用者', $account . '@example.com');

        return Response::json([
            'message' => '登入成功',
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'account' => $account,
                'password_hint' => $password !== '' ? '******' : '',
            ],
        ]);
    }
}
