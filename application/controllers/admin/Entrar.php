<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require 'vendor/autoload.php';
use MongoDB\Client;
use MongoDB\Driver\ServerApi;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../..');
$dotenv->load();
//ob_start();

class Entrar extends CI_Controller {
	public function index()
	{
		$variaveis = [];
		if (isset($_SESSION['erro']))
			$variaveis['erro'] = $_SESSION['erro'];
//echo $_SESSION['erro'];die();
//echo $variaveis['erro'];die();
		if (isset($_SESSION['id_do_usuario']))
			redirect('admin/pagina_inicial');
		else
			$this->load->view('adminpanel/entrar', $variaveis);
	}

	public function autenticar()
	{
		// Specify Stable API version 1
		$apiVersion = new ServerApi(ServerApi::V1);
		// Create a new client and connect to the server
		$client = new MongoDB\Client($_ENV['DB_CONN'], [], ['serverApi' => $apiVersion]);
		//$client->selectDatabase('companydb');
		//$client->dropDatabase();
		//$client->listDatabases();
		// Send a ping to confirm a successful connection
		//$client->selectDatabase('tutorial_miniblog')->command(['ping' => 1]);
		//echo "Pinged your deployment. You successfully connected to MongoDB!\n";
		$usuarios = $client->tutorial_miniblog->usuarios;
		//$collection = $client->pokedle->palpites;
		//$filter = ['$nor' => [['habitat' => 'mountain']]];
		//$result = $collection->findOne($filter);
		//$result2 = $collection->find(['tipo2' => 'monotipo']);
		//$result2 = $client->listDatabases();
		//$usuarios->insertOne(['email' => 't@st.e', 'senha' => '123']);
		//var_dump($_POST);
		$email = $_POST['email'];
		$senha = $_POST['senha'];
		$usuario = $usuarios->findOne(['email' => $email, 'senha' => $senha]);
		if ($usuario) {
			//echo $usuario->_id;
			$this->session->set_userdata('id_do_usuario', $usuario->_id);
			redirect('admin/pagina_inicial');
		} else {
			$this->session->set_flashdata('erro', 'Email ou senha incorreto.');
			redirect('admin/entrar');
		}
		//$result2 = $client->tutorial_miniblog->listCollections();

		//if ($result) {
			//var_dump($result);
			//echo json_encode($result);
			//echo '<br><br><br>';
			//foreach ($result2 as $res) {
				//echo json_encode($res);
				//foreach ($res as $re)
				//	echo json_encode($re);
				//var_dump($res);
				//echo '<br><br>';
			//};
		//} else {
		//	echo 'Document not found';
		//}
		//print_r($_POST);
		//if (isset($_POST)) {
		//	$email = $_POST['email'];
		//	$senha = $_POST['senha'];
		//}
		//else
		//	die('Formulário vazio.');
	}

	public function sair()
	{
		session_destroy();
		//$this->load->view('adminpanel/entrar');
		redirect('admin/entrar');
	}
}
