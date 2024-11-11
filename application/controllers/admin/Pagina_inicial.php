<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
use MongoDB\Client;
use MongoDB\Driver\ServerApi;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../..');
$dotenv->load();

class Pagina_inicial extends CI_Controller {
	public function index()
	{
		$apiVersion = new ServerApi(ServerApi::V1);
		$mongo = new MongoDB\Client($_ENV['DB_CONN'], [], ['serverApi' => $apiVersion]);
		//$mongo->tutorial_miniblog->blogs->updateMany([], ['$set' => ['publicado' => false]]);
		$dados_dos_blogs = $mongo->tutorial_miniblog->blogs->find([], ['limit' => 100, 'sort' => ['_id' => -1]]);
		$blogs = [];
		foreach ($dados_dos_blogs as $b) {
			array_push($blogs, [
				'id_do_blog' => $b->_id,
				'titulo_do_blog' => $b->titulo_do_blog,
				'descricao_do_blog' => $b->descricao_do_blog,
				'nome_da_imagem_do_blog' => $b->nome_da_imagem_do_blog,
				'publicado' => $b->publicado
			]);
		}
		//echo "<pre>";
		//print_r($blogs);
		//die();
		$this->load->view('adminpanel/pagina_inicial', ['blogs' => $blogs]);
	}
}
