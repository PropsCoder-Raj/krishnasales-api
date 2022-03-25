<?php

namespace App\Models;

use CodeIgniter\Model;

class BonusModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'bonus_master';
	protected $primaryKey           = 'Bonus_Id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ["Bonus_Id", "Item_Id", "Quantity", "Discount", "Created_On", "Last_Update_On"];

	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'Created_On';


	public function csvBatchInsert($data){
		$this->insertBatch($data);
	}
}
