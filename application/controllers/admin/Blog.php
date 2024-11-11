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
		$this->load->view('adminpanel/lista', ['blogs' => $blogs]);
	}

	public function novo()
	{
		$this->load->view('adminpanel/novo');
	}

	public function criar()
	{
		//echo '<pre>';
		//print_r($_POST);
		//print_r($_FILES);
		//die();
		//$this->load->view('adminpanel/novo');
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
					'nome_da_imagem_do_blog' => $this->upload->data()['file_name'],
					'publicado' => isset($_POST['publicar']) ? true : false
				];
				//echo '<pre>';
				//print_r($blog);
				//die();
				$apiVersion = new ServerApi(ServerApi::V1);
				$mongo = new MongoDB\Client($_ENV['DB_CONN'], [], ['serverApi' => $apiVersion]);
				$res = $mongo->tutorial_miniblog->blogs->insertOne($blog);
				//print_r($mongo->tutorial_miniblog->blogs->findOne(['nome_da_imagem_do_blog' => $this->upload->data()['file_name']]));
				if ($res->getInsertedCount() > 0) {
					$this->session->set_flashdata(['criou' => true]);
					redirect('admin/blog');
				} else {
					$this->session->set_flashdata(['criou' => false]);
					redirect('admin/blog');
					//echo 'Falha ao inserir documento no banco de dados.<br>';
					//echo '<pre>';
					//print_r($res);
				}
			}
		}
	}

	public function editar($id) {
		$apiVersion = new ServerApi(ServerApi::V1);
		$mongo = new MongoDB\Client($_ENV['DB_CONN'], [], ['serverApi' => $apiVersion]);
		$res = $mongo->tutorial_miniblog->blogs->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
		//echo '<pre>';
		//print_r($res);die();
		$blog = [
			'id' => $res['_id'],
			'titulo' => $res['titulo_do_blog'],
			'descricao' => $res['descricao_do_blog'],
			'nome_da_imagem' => $res['nome_da_imagem_do_blog']
		];
		$this->load->view('adminpanel/editar', $blog);
	}

	public function salvar($id)
	{
		$blog = [];
		if ($_POST['titulo'])
			//array_push($blog, ['titulo_do_blog' => $_POST['titulo']]);
			$blog['titulo_do_blog'] = $_POST['titulo'];
		if ($_POST['descricao'])
			$blog['descricao_do_blog'] = $_POST['descricao'];
			//array_push($blog, ['descricao_do_blog' => $_POST['descricao']]);
		if ($_FILES['imagem']['size']) {
			$configs['upload_path'] = './assets/upload/blogimg/';
			$configs['allowed_types'] = 'gif|jpeg|jpg|png';
			//$configs['file_name'] = date('YmdHis') . '-' . $_FILES['imagem']['name'];
			$this->load->library('upload', $configs);
			if (!$this->upload->do_upload('imagem')) {
				//$erro = 
				//echo '<pre>';
				//print_r($_FILES['imagem']);
				die('ERRO');
			} else {
				$blog['nome_da_imagem_do_blog'] = $this->upload->data()['file_name'];
				//array_push($blog, ['nome_da_imagem_do_blog' => $this->upload->data()['file_name']]);
				//$dados = ['dados' => $this->upload->data()];
				//echo '<pre>';
				//print_r($dados);
				//die();
			}
		}
		if ($blog) {
			//echo '<pre>';
			//print_r(['$set' => $blog]);
			//die();
			$apiVersion = new ServerApi(ServerApi::V1);
			$mongo = new MongoDB\Client($_ENV['DB_CONN'], [], ['serverApi' => $apiVersion]);
			$res = $mongo->tutorial_miniblog->blogs->updateOne(['_id' => new MongoDB\BSON\ObjectId($id)], ['$set' => $blog]);
			if ($res->getModifiedCount() > 0)
				$this->session->set_flashdata(['editou' => true]);
			else
				$this->session->set_flashdata(['editou' => false]);
		}
		redirect('admin/blog');
	}

	public function excluir($id)
	{
		//echo 'excluindo '.$id;
		$apiVersion = new ServerApi(ServerApi::V1);
		$mongo = new MongoDB\Client($_ENV['DB_CONN'], [], ['serverApi' => $apiVersion]);
		$res = $mongo->tutorial_miniblog->blogs->deleteOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
		//print_r($mongo->tutorial_miniblog->blogs->findOne(['nome_da_imagem_do_blog' => $this->upload->data()['file_name']]));
		if ($res->getDeletedCount() > 0) {
			$this->session->set_flashdata(['excluiu' => true]);
			redirect('admin/blog');
		} else {
			$this->session->set_flashdata(['excluiu' => false]);
			redirect('admin/blog');
			//echo 'Falha ao inserir documento no banco de dados.<br>';
			//echo '<pre>';
			//print_r($res);
		}
		//redirect('admin/blog');
	}

	public function publicar($id) {
		$apiVersion = new ServerApi(ServerApi::V1);
		$mongo = new MongoDB\Client($_ENV['DB_CONN'], [], ['serverApi' => $apiVersion]);
		$res = $mongo->tutorial_miniblog->blogs->updateOne(
			['_id' => new MongoDB\BSON\ObjectId($id)], ['$set' => ['publicado' => true]]
		);
		if ($res->getModifiedCount() > 0)
			$this->session->set_flashdata(['publicou' => true]);
		else
			$this->session->set_flashdata(['publicou' => false]);
		redirect('admin/blog');
	}

	public function despublicar($id) {
		$apiVersion = new ServerApi(ServerApi::V1);
		$mongo = new MongoDB\Client($_ENV['DB_CONN'], [], ['serverApi' => $apiVersion]);
		$res = $mongo->tutorial_miniblog->blogs->updateOne(
			['_id' => new MongoDB\BSON\ObjectId($id)], ['$set' => ['publicado' => false]]
		);
		if ($res->getModifiedCount() > 0)
			$this->session->set_flashdata(['despublicou' => true]);
		else
			$this->session->set_flashdata(['despublicou' => false]);
		redirect('admin/blog');
	}

	public function ver($id) {
		$apiVersion = new ServerApi(ServerApi::V1);
		$mongo = new MongoDB\Client($_ENV['DB_CONN'], [], ['serverApi' => $apiVersion]);
		$res = $mongo->tutorial_miniblog->blogs->findOne(['_id' => new MongoDB\BSON\ObjectId($id)]);
		//echo '<pre>';
		//print_r($res);die();
		$blog = [
			'id' => $res['_id'],
			'titulo' => $res['titulo_do_blog'],
			'descricao' => $res['descricao_do_blog'],
			'nome_da_imagem' => $res['nome_da_imagem_do_blog']
		];
		$this->load->view('adminpanel/blog', ['blog' => $blog]);
	}
}
