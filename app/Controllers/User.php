<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');
use App\Models\UserModel;
use App\Controllers\BaseController;

class User extends BaseController
{
	protected $userModel;
	public function __construct(){
		$this->userModel = new UserModel();
	}
    
	public function index()
	{
		echo json_encode($this->userModel->orderBy('User_Id', 'DESC')->findAll());
	}

	public function login($email,$password){
		if(!empty($email) && !empty($password)){
			$this->userModel->where('Email',$email);
			$this->userModel->where('Password',$password);
			$this->userModel->limit(1);
			$query = $this->userModel->get()->getResultArray();
			if($query){
				$ar = array("status"=>"success","message"=>"User Login Successfully","data"=>$query[0]);
				echo json_encode($ar);
			}else{
				$ar = array("status"=>"error","message"=>"Email Or Password does not Match");
				echo json_encode($ar);
			}
		}else{
			$ar = array("status"=>"error","message"=>"Filled is Empty");
			echo json_encode($ar);
		}
	}

	public function chnagePassword($uid,$password){
		$this->userModel->set("Password",$password);
		$this->userModel->Where("User_Id",$uid);
		$this->userModel->update();
	}

}