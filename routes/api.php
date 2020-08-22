<?php

use Illuminate\Http\Request;

Route::get('user/{id}', 'API\ChatController@getDataUser');