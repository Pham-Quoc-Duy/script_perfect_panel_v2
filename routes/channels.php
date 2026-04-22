<?php

use Illuminate\Support\Facades\Broadcast;

/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('App.Models.User.{id}', function ($user, $id) {
    return (int) $user->id === (int) $id;
});

// Private channel for ticket messages
Broadcast::channel('ticket.{ticketId}', function ($user, $ticketId) {
    $ticket = \App\Models\Ticket::find($ticketId);
    
    if (!$ticket) {
        return false;
    }
    
    // User can access if they own the ticket or are admin
    return $user->id === $ticket->user_id || $user->role === 'admin';
});