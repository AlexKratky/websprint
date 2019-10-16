<?php
Route::set('/', "home.latte")->setController("MainController");
Route::set('/view', 'view.latte')->setController("MainController");
Route::set('/add', 'add.latte')->setController("MainController")->setMiddleware(["AuthMiddleware"]);
Route::set('/add/submit', null, ["GET", "POST"])->setController("MainController")->setMiddleware(["AuthMiddleware"]);
