<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(UserRepository $model)
    {
        $users = $model->allNotLoggedIn();
        return view('pages.chat.index', compact('users'));
    }
}