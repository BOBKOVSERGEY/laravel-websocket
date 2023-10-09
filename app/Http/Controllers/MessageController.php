<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageStoreRequest;
use App\Http\Resources\MessageResource;
use App\Models\Message;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class MessageController extends Controller
{
    public function index(): Response
    {
        $messagesData = Message::latest()->get();
        $messages = MessageResource::collection($messagesData)->resolve();
        return Inertia::render('Message/Index', compact('messages'));
    }

    public function store(MessageStoreRequest $request)
    {
        $data = $request->validated();

        $message = Message::query()->create($data);

        return MessageResource::make($message)->resolve();
    }
}
