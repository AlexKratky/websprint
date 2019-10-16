<?php
Route::set('/login', 'auth/login.latte')->setController("AuthController")->setAlias('login');
Route::set('/login/verify', function() {
    $auth = $GLOBALS["auth"];
    if($auth->login()) {
        $auth->captchaPassed();
        redirect($GLOBALS["CONFIG"]["auth"]["LANDING_PAGE"]);
    } else {
        $auth->captchaFailed();
        redirect('/login');
    }
}, ["POST"])->setAlias('login-verify');
Route::set('/login/forgot-password', 'auth/forgot.latte')->setController("AuthController")->setAlias('forgot-password');
Route::set('/login/forgot-password/submit', function() {
    $auth = $GLOBALS["auth"];
    if($auth->forgot()) {
        $auth->captchaPassed();
        redirect("/login");
    } else {
        $auth->captchaFailed();
        redirect('/login/forgot-password');
    }

}, ["POST"])->setAlias('forgot-password-submit');
Route::set('/login/forgot-password/{TOKEN}', 'auth/forgot-new.latte')->setController("AuthController")->setAlias('forgot-password-token');
Route::set('/login/forgot-password/{TOKEN}/save', function () {
    $auth = $GLOBALS["auth"];
    if($auth->forgotSave()) {
        $auth->captchaPassed();
        redirect("/login");
    } else {
        $auth->captchaFailed();
        redirect('/login/forgot-password/' . Route::getValue('TOKEN'));
    }
}, ["POST"])->setAlias('forgot-password-token-save');

Route::set('/login-2fa', 'auth/2fa.latte')->setController("AuthController")->setAlias('login-2fa');
Route::set('/login-2fa/verify', function() {
    $auth = $GLOBALS["auth"];
    if ($auth->login($_SESSION["username"], $_SESSION["password"], true)) {
        $auth->captchaPassed();
        redirect($GLOBALS["CONFIG"]["auth"]["LANDING_PAGE"]);
    } else {
        $auth->captchaFailed();
        redirect('/login');
    }
}, ["POST"])->setAlias('login-2fa-verify');


Route::set('/register', 'auth/register.latte')->setController("AuthController")->setAlias('register');
Route::set('/register/submit', function() {
    $auth = $GLOBALS["auth"];
    if($auth->register()) {
        $auth->captchaPassed();
        redirect('/login');
    } else {
        $auth->captchaFailed();
        redirect('/register');
    }
}, ["POST"])->setAlias('register-submit');
Route::set('/edit', 'auth/edit.latte')->setController("AuthController")->setAlias('edit');
Route::set('/2fa/setup', 'auth/2fa-setup.latte')->setController("AuthController")->setAlias('2fa-setup');
Route::set('/2fa/save', function() {
    $auth = $GLOBALS["auth"];
    if($auth->save2FA()) {
        $auth->captchaPassed();
        redirect("/edit");
    } else {
        $auth->captchaFailed();
        redirect('/2fa/setup');
    }
}, ["POST"])->setAlias('2fa-save');
Route::set('/2fa/disable', function() {
    $auth = $GLOBALS["auth"];
    $auth->disable2FA();
    redirect('/edit');
})->setAlias('2fa-disable');
Route::set('/edit/save', function() {
    $auth = $GLOBALS["auth"];
    if($auth->edit()) {
        $auth->captchaPassed();
    } else {
        $auth->captchaFailed();
    }
    redirect('/edit');
}, ["POST"])->setAlias('edit-save');
Route::set('/logout', function () {
    $auth = $GLOBALS["auth"];
    $auth->logout();
})->setAlias('logout');
Route::set('/verifymail/{TOKEN}', function() {
    $auth = $GLOBALS["auth"];
    $v = $auth->verify(Route::getValue("TOKEN"));
    ($v === true) ? redirect($GLOBALS["CONFIG"]["auth"]["LANDING_PAGE"]) : die('Invalid token');
})->setMiddleware(['AuthMiddleware'])->setAlias('verifymail');
Route::set('/session', function() {
    dump($_SESSION);
});
Route::set('/cookies', function() {
    dump($_COOKIE);
});
