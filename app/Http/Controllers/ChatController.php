<?php

namespace App\Http\Controllers;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ChatController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Chat/Chat');
    }
}
