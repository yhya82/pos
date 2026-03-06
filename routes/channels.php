<?php

use Illuminate\Support\Facades\Broadcast;


 // privae channle only logged in users have acces to it
Broadcast::channel('sales', function($user){
    return $user !=null;
});
// channel that check for users online
Broadcast::channel('system-online', function($user){
            return ['id' => $user->id,
                    'name' => $user->name
            ];
});