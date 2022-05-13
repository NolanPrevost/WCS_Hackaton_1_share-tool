<?php

// list of accessible routes of your application, add every new route here
// key : route to match
// values : 1. controller name
//          2. method name
//          3. (optional) array of query string keys to send as parameter to the method
// e.g route '/Tool/edit?id=1' will execute $itemController->edit(1)
return [
    '' => ['ToolController', 'index',],
    'tools' => ['ToolController', 'index',],
    // 'tools/edit' => ['ToolController', 'edit', ['id']],
    'tools/show' => ['ToolController', 'show', ['id']],
    'tools/reservation' => ['ReservationController', 'insertReservation',],

    'reservation-confirmed' => ['ReservationController', 'reservationConfirmed',],
    'mes-reservations' => ['ReservationController', 'myReservations',],
    'annuler-ma-reservation' => ['ReservationController', 'annulation',],

    'pots' => ['PotController', 'index',],
    'pots/edit' => ['PotController', 'edit', ['id']],
    'pots/show' => ['PotController', 'show', ['id']],
    'pots/add' => ['PotController', 'add',],
    'pots/delete' => ['PotController', 'delete',],

    'wishlist' => ['WishlistController', 'index',],
    'wishlist/edit' => ['WishlistController', 'edit', ['id']],
    'wishlist/show' => ['WishlistController', 'show', ['id']],
    'wishlist/add' => ['WishlistController', 'add',],
    'wishlist/delete' => ['WishlistController', 'delete',],

    'users' => ['UserController', 'index',],
    'users/edit' => ['UserController', 'edit', ['id']],
    'users/show' => ['UserController', 'show', ['id']],
    'users/add' => ['UserController', 'add',],
    'users/delete' => ['UserController', 'delete',],
];
