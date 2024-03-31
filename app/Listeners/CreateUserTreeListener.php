<?php

namespace App\Listeners;

use App\Events\UserCreatedEvent;
use App\Models\UserTree;

class CreateUserTreeListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserCreatedEvent $event): void
    {
        $createdUser = $event->user;

        $user = $createdUser;

        UserTree::create([
            'user_id' => $createdUser->id,
            'parent_id' => $createdUser->id,
            'type' => $createdUser->type,
            'parent_type' => $createdUser->type,
        ]);

        while ($user->parent) {
            $parent = $user->parent;

            UserTree::create([
                'user_id' => $createdUser->id,
                'parent_id' => $parent->id,
                'type' => $createdUser->type,
                'parent_type' => $parent->type,
            ]);

            $user = $parent;
        }
    }
}
