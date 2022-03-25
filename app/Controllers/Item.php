<?php

namespace App\Controllers;
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header('Access-Control-Allow-Headers: origin, x-requested-with, content-type');
use App\Models\ItemModel;

class Item extends BaseController
{
	protected $itemModel;
	public function __construct(){
		$this->itemModel = new ItemModel();
		helper(['form', 'url']);
	}

	public function index()
	{
	}

	public function search_item_with_item_id($name){
			$data = $this->itemModel->query("SELECT * FROM item_master WHERE Item_Name LIKE '%$name%' LIMIT 10")->getResultArray();
			$ar = array("status"=>"success","message"=>"Itmes Data","data"=>$data);
			echo json_encode($ar);
	}

	public function get_all_items_with_bonus_master_count($count)
	{
		$this->itemModel->limit($count);
		$data = $this->itemModel->get()->getResultArray();
		$ar = array("status"=>"success","message"=>"Itmes Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_all_items_with_bonus_master() {
		$data = $this->itemModel->get()->getResultArray();
		$ar = array("status"=>"success","message"=>"Itmes Data","data"=>$data);
		echo json_encode($ar);
	}

	public function get_all_items(){
		$data = $this->itemModel->get()->getResultArray();
		$ar = array("status"=>"success","message"=>"Items Data","data"=>$data);
		echo json_encode($ar);
	}

	public function delete_item_master($id){
		$this->itemModel->delete($id);
		$ar = array("status"=>"success","message"=>"Item Deleted");
		echo json_encode($ar);
	}

	public function get_user_item_master($id){
		if(!empty($id)){
			$this->itemModel->where('Item_Id',$id);
			$query = $this->itemModel->get()->getResultArray();
			if($query){
				$ar = array("status"=>"success","message"=>"Users Item Data","data"=>$query);
				echo json_encode($ar);
			}else{
				$ar = array("status"=>"error","message"=>"User Data Not Found");
				echo json_encode($ar);
			}
		}else{
			$ar = array("status"=>"error","message"=>"Filled is Empty");
			echo json_encode($ar);
		}
	}

	public function update_item_master($id){
		$item = [
				'Item_Id' => $this->request->getPost('Item_Id'),
				'Item_Name' => $this->request->getPost('Item_Name'),
				'Unit_Price' => $this->request->getPost('Unit_Price'),
				'Discount' => $this->request->getPost('Discount'),
				'Vat' => $this->request->getPost('Vat'),
				'Stock_State' => $this->request->getPost('Stock_State'),
		];
		if($this->itemModel->update($id,$item)){
			$ar = array("status"=>"success","message"=>"Item Matser Updated");
			echo json_encode($ar);
		}else{
			$ar = array("status"=>"error","message"=>"Data Not Updated");
			echo json_encode($ar);
		}
	}
	
	public function create_item_master(){
			$item = [
				'Item_Id' => $this->request->getPost('Item_Id'),
				'Item_Name' => $this->request->getPost('Item_Name'),
				'Unit_Price' => $this->request->getPost('Unit_Price'),
				'Discount' => $this->request->getPost('Discount'),
				'Vat' => $this->request->getPost('Vat'),
				'Stock_State' => $this->request->getPost('Stock_State'),
			];
			
			if($this->itemModel->insert($item)){
				$ar = array("status"=>"success","message"=>"Item Master Created");
				echo json_encode($ar);
			}else{
				$ar = array("status"=>"error","message"=>"Database Error");
				echo json_encode($ar);
			}
	}

	public function post_excel_item_master_file() {

		$path = $this->request->getFile('file')->store();

		if (($handle = fopen(WRITEPATH.'uploads/'.$path, "r")) !== FALSE) {
			$row = 0;
			while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
				$row++;
				if($row == 1)
					continue;
				$insert_data[] = array('Item_Id' => $data[0],'Item_Name' => $data[1],'Unit_Price' => $data[2], 'Discount'=>$data[3], 'Vat'=>$data[4], 'Stock_State'=>$data[5] );
			}
			$this->itemModel->csvBatchInsert($insert_data);
			fclose($handle);
			$ar = array("status"=>"success","message"=>"File Upload","data"=>"NUll");
			echo json_encode($ar);
		} else {
			$ar = array('status'=>'error','message'=>'CSV File Error');
			print_r(json_encode($ar));
		}
	}
	
	public function get_item($id = null){
		$data = $this->itemModel->find($id);
		if($data){
			$ar = array("status"=>"success","message"=>"Item Master Found","data"=>$data);
			echo json_encode($ar);
		}else{
			$ar = array("status"=>"error","message"=>"No User Found");
			echo json_encode($ar);
		}
	}
}
