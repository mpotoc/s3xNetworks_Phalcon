<?php
/*
 * Define custom routes. File gets included in the router service definition.
 */
$router = new Phalcon\Mvc\Router();

$router->add('/confirm/{code}/{email}', array(
    'controller' => 'user_control',
    'action' => 'confirmEmail'
));

$router->add('/signup/:params', array(
    'controller' => 'session',
    'action' => 'signup',
    'params' => 1
));

$router->add('/register', array(
    'controller' => 'session',
    'action' => 'register'
));

$router->add('/login', array(
    'controller' => 'session',
    'action' => 'login'
));

$router->add('/logout', array(
    'controller' => 'session',
    'action' => 'logout'
));

$router->add('/forgotPassword', array(
    'controller' => 'session',
    'action' => 'forgotPassword'
));

$router->add('/resendActivation', array(
    'controller' => 'session',
    'action' => 'resendActivation'
));

$router->add('/escort/:params', array(
    'controller' => 'index',
    'action' => 'escort',
    'params' => 1
));

$router->add('/city/:params', array(
    'controller' => 'index',
    'action' => 'city',
    'params' => 1
));

$router->add('/escorts/:params', array(
    'controller' => 'index',
    'action' => 'escorts',
    'params' => 1
));

$router->add('/search/:params', array(
    'controller' => 'index',
    'action' => 'search',
    'params' => 1
));

$router->add('/bonus', array(
    'controller' => 'index',
    'action' => 'bonus'
));

$router->add('/faq', array(
    'controller' => 'index',
    'action' => 'faq'
));

$router->add('/callback', array(
    'controller' => 'index',
    'action' => 'callback'
));

$router->add('/terms', array(
    'controller' => 'index',
    'action' => 'terms'
));

$router->add('/contact', array(
    'controller' => 'index',
    'action' => 'contact'
));

$router->add('/sites', array(
    'controller' => 'index',
    'action' => 'sites'
));

$router->add('/comment', array(
    'controller' => 'index',
    'action' => 'comment'
));

$router->add('/withdraw', array(
    'controller' => 'private',
    'action' => 'withdraw'
));

$router->add('/like/:params', array(
    'controller' => 'index',
    'action' => 'like',
    'params' => 1
));

return $router;