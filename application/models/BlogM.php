<?php

require 'vendor/autoload.php';
use MongoDB\Client;
use MongoDB\Driver\ServerApi;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../..');
$dotenv->load();

class BlogM extends CI_Model
{
  public function obterTodos() {
		$apiVersion = new ServerApi(ServerApi::V1);
		$mongo = new MongoDB\Client($_ENV['DB_CONN'], [], ['serverApi' => $apiVersion]);
		$blogs = $mongo->tutorial_miniblog->blogs->find([], ['limit' => 100, 'sort' => ['_id' => -1]]);
		//echo "<pre>model";
		//print_r($blogs);
		//die();
    return $blogs;
  }
}
