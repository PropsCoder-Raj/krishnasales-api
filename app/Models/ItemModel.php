<?php

namespace App\Models;

use CodeIgniter\Model;

class ItemModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'item_master';
	protected $primaryKey           = 'Id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['Id', 'Item_Id', 'Item_Name', 'Unit_Price', 'Discount', 'Vat', 'Stock_State', 'Bonus_Qty', 'Bonus_Discount', 'Created_On', 'Last_Update_On'];
	
	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'Created_On';

	public function csvBatchInsert($data){
		$this->truncate('item_master');
		$this->insertBatch($data);
	}

	public function csvBatchUpdate($data){
		$this->updateBatch($data, 'Item_Id');
	}

}
