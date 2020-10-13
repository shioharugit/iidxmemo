<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\Admin\UserService as UserService;

class UserController extends Controller
{
    private $user;

    public function __construct()
    {
        $this->user = new UserService();
    }

    /**
     * ユーザー一覧
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('admin.user.index');
    }
}
