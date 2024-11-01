<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//use Exception;
require 'vendor/autoload.php';
use MongoDB\Client;
use MongoDB\Driver\ServerApi;
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__.'/../../..');
$dotenv->load();
 
class Login extends CI_Controller {
	public function index()
	{
		$this->load->view('adminpanel/loginview');
	}
	public function login_post()
	{
		$uri = $_ENV['DB_CONN'];
		// Specify Stable API version 1
		$apiVersion = new ServerApi(ServerApi::V1);
		// Create a new client and connect to the server
		$client = new MongoDB\Client($uri, [], ['serverApi' => $apiVersion]);
				// Send a ping to confirm a successful connection
				$client->selectDatabase('pokedle')->command(['ping' => 1]);
				//echo "Pinged your deployment. You successfully connected to MongoDB!\n";
$collection = $client->pokedle->palpites;
$filter = ['$nor' => [['habitat' => 'mountain']]];
$result = $collection->findOne($filter);
$result2 = $collection->find(['tipo2' => 'monotipo']);
//if ($result) {
	var_dump($result);
	//echo json_encode($result);
	echo '<br><br><br>';
	foreach ($result2 as $res) {
		echo json_encode($res);
		//var_dump($res);
		echo '<br><br>';
	};
//} else {
    //echo 'Document not found';
//}
		//print_r($_POST);
		//if (isset($_POST)) {
		//	$email = $_POST['email'];
		//	$senha = $_POST['senha'];
		//}
		//else
		//	die('Formulário vazio.');
	}
}
