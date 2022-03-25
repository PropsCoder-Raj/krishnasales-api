<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');
use App\Models\UserModel;

class Home extends BaseController
{
	public function index()
	{
		return view('welcome_message');
	}

	public function getUsers()
	{
		return "Hi Usera";
		$userModel = new UserModel();
		return $userModel->findAll();
	}
}
