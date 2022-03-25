<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');
use App\Models\BonusModel;
use App\Models\ItemModel;

class Bonus extends BaseController
{
	protected $bonusModel, $itemModal;
	public function __construct(){
		$this->bonusModel = new BonusModel();
		$this->itemModel = new ItemModel();
		helper(['form', 'url']);
	}

	public function index()
	{
	}

	public function get_all_bonus(){
		$data = $this->itemModel->query("SELECT Id, Bonus_Qty, Bonus_Discount, Item_Name from item_master WHERE Bonus_Qty!=0 AND Bonus_Discount!=0;")->getResultArray();
		$ar = array("status"=>"success","message"=>"Bonus Data","data"=>$data);
		echo json_encode($ar);
	}

	public function delete_bonus_master($id){
		$item = [
			'Bonus_Qty' => '0',
			'Bonus_Discount' => '0',
		];
		if($this->itemModel->update($id,$item)){
			$ar = array("status"=>"success","message"=>"Delete Bonus");
			echo json_encode($ar);
		}else{
			$ar = array("status"=>"error","message"=>"Database Error");
			echo json_encode($ar);
		}
	}

	public function get_bonus_using_item_id($id = null){
		if(!empty($id)){
			$this->bonusModel->where('Item_Id',$id);
			$query = $this->bonusModel->get()->getResultArray();
			$ar = array("status"=>"success","message"=>"Bonus Data","data"=>$query);
			echo json_encode($ar);
		}else{
			$ar = array("status"=>"error","message"=>"Filled is Empty");
			echo json_encode($ar);
		}
	}

	public function update_bonus_master($id){
		$item = [
			'Bonus_Qty' => $this->request->getPost('Quantity'),
			'Bonus_Discount' => $this->request->getPost('Discount'),
		];
		if($this->itemModel->update($id,$item)){
			$ar = array("status"=>"success","message"=>"Data Updated");
			echo json_encode($ar);
		}else{
			$ar = array("status"=>"error","message"=>"Database Error");
			echo json_encode($ar);
		}
	}

	public function create_bonus_master($id){
			$item = [
				'Bonus_Qty' => $this->request->getPost('Quantity'),
				'Bonus_Discount' => $this->request->getPost('Discount'),
			];
			if($this->itemModel->update($id,$item)){
				$ar = array("status"=>"success","message"=>"Bonus Created");
				echo json_encode($ar);
			}else{
				$ar = array("status"=>"error","message"=>"Database Error");
				echo json_encode($ar);
			}
	}

	public function post_excel_bonus_master_file() {
		$path = $this->request->getFile('file')->store();
		if (($handle = fopen(WRITEPATH.'uploads/'.$path, "r")) !== FALSE) {
			$row = 0;
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$row++;
				if($row == 1)
					continue;
				$insert_data[] = array('Item_Id'=> $data[0],'Bonus_Qty' => $data[1],'Bonus_Discount' => $data[2]);
			}
			$this->itemModel->csvBatchUpdate($insert_data);
			fclose($handle);
			$ar = array("status"=>"success","message"=>"File Upload","data"=>"NUll");
			echo json_encode($ar);
		} else {
			$ar = array('status'=>'error','message'=>'CSV File Error');
			print_r(json_encode($ar));
		}
	}

}
