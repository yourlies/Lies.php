<?php

include(dirname(__FILE__) . '/c/' . 'rewrite' . '.php');

$path = explode('?', $_SERVER['REQUEST_URI'])[0];
$path = trim($path, '/');

$rules = [
  '/' => '/User',
  '/project' => '/Product',
  '/board' => '/Board',
  '/links' => '/Links',
  '/board/comments' => '/Board/selectComments',
];

$rewrite = new Tool\Rewrite($path, $rules);
$query = $rewrite->res();

$controller = $query[0];
$method = $query[1];

include(dirname(__FILE__) . '/p/' . 'layout' . '.php');

class LiesController extends Components\Layout {
  public function __construct () {
    parent::__construct();
  }
}

include(dirname(__FILE__) . '/c/' . $controller . '.php');
$controller = 'Layout\\' . $controller;
$container = new $controller();

call_user_func_array([$container, $method], []);