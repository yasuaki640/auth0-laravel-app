<?php

use Illuminate\Support\Facades\Route;

Route::get('/private', function () {
    return response('Welcome! You are logged in.');
})->middleware('auth');

Route::get('/scope', function () {
    return response('You have the `read:messages` permissions, and can therefore access this resource.');
})->middleware('auth')->can('read:messages');

Route::get('/', function () {
    if (! auth()->check()) {
        return response('You are not logged in.');
    }

    $user = auth()->user();
    $name = $user->name ?? 'User';
    $email = $user->email ?? '';

    return response("Hello {$name}! Your email address is {$email}.");
});

// TODO
//Route::get('/colors', function () {
//    $endpoint = Auth0::management()->users();
//
//    $colors = ['red', 'blue', 'green', 'black', 'white', 'yellow', 'purple', 'orange', 'pink', 'brown'];
//
//    $endpoint->update(
//        id: auth()->id(),
//        body: [
//            'user_metadata' => [
//                'color' => $colors[random_int(0, count($colors) - 1)],
//            ],
//        ]
//    );
//
//    $metadata = $endpoint->get(auth()->id());
//    $metadata = Auth0::json($metadata);
//
//    $color = $metadata['user_metadata']['color'] ?? 'unknown';
//    $name = auth()->user()->name;
//
//    return response("Hello {$name}! Your favorite color is {$color}.");
//})->middleware('auth');
