<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
use MongoDB\Client;
use MongoDB\Driver\ServerApi;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../..');
$dotenv->load();

class Blog extends CI_Controller {

	public function index()
	{
		$apiVersion = new ServerApi(ServerApi::V1);
		$mongo = new MongoDB\Client($_ENV['DB_CONN'], [], ['serverApi' => $apiVersion]);
		$dados_dos_blogs = $mongo->tutorial_miniblog->blogs->find([],['limit' => 100, 'sort' => ['_id' => -1]]);
		$blogs = [];
		foreach ($dados_dos_blogs as $b) {
			array_push($blogs, [
				'id_do_blog' => $b->_id,
				'titulo_do_blog' => $b->titulo_do_blog,
				'descricao_do_blog' => $b->descricao_do_blog,
				'nome_da_imagem_do_blog' => $b->nome_da_imagem_do_blog
			]);
		}
		//echo "<pre>";
		//print_r($blogs);
		//die();
		$this->load->view('adminpanel/viewblog', ['blogs' => $blogs]);
	}

	public function addblog()
	{
		$this->load->view('adminpanel/addblog');
	}

	public function addblog_post()
	{
		//echo '<pre>';
		//print_r($_POST);
		//print_r($_FILES);
		//$this->load->view('adminpanel/addblog');
		if ($_FILES) {
			$configs['upload_path'] = './assets/upload/blogimg/';
			$configs['allowed_types'] = 'gif|jpeg|jpg|png';
			//$configs['file_name'] = date('YmdHis') . '-' . $_FILES['imagem']['name'];
			$this->load->library('upload', $configs);
			if (!$this->upload->do_upload('imagem')) {
				//$erro = 
				echo '<br>';
				die('ERRO');
			} else {
				//$dados = ['dados' => $this->upload->data()];
				//echo '<pre>';
				//print_r($dados);
				//die();
				$blog = [
					'titulo_do_blog' => $_POST['titulo'],
					'descricao_do_blog' => $_POST['descricao'],
					'nome_da_imagem_do_blog' => $this->upload->data()['file_name']
				];
				//print_r($blog);
				$apiVersion = new ServerApi(ServerApi::V1);
				$mongo = new MongoDB\Client($_ENV['DB_CONN'], [], ['serverApi' => $apiVersion]);
				$res = $mongo->tutorial_miniblog->blogs->insertOne($blog);
				//print_r($mongo->tutorial_miniblog->blogs->findOne(['nome_da_imagem_do_blog' => $this->upload->data()['file_name']]));
				if ($res->getInsertedCount() > 0) {
					$this->session->set_flashdata(['criou' => true]);
					redirect('admin/blog/addblog');
				} else {
					echo 'Falha ao inserir documento no banco de dados.<br>';
					echo '<pre>';
					print_r($res);
					//print_r($res->insertedId);
				}
			}
		}
	}
}
