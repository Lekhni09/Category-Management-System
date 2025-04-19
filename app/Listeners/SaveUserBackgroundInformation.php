<?php

namespace App\Listeners;

use App\Events\UserSaved;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use App\Services\UserService;


class SaveUserBackgroundInformation
{
    /**
     * Create the event listener.
     */
    protected $userService;

    public function __construct(UserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Handle the event.
     */
    public function handle(UserSaved $event): void
    {
        $this->userService->saveUserDetails($event->user);

    }
}
