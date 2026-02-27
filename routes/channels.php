<?php

use Illuminate\Support\Facades\Broadcast;


 
Broadcast::channel('sales', function($user){
    return $user !=null;
});