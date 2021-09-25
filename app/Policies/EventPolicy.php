<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Event;
use Illuminate\Auth\Access\HandlesAuthorization;

class EventPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can participate to the event.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function participate(?User $user, Event $event)
    {
        if($event->team==="none" || $event->public===true) {
            return true;
        } else {
            return optional($user)->isInTeam($event->team);
        }
    }

}
