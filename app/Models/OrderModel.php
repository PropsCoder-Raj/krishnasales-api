<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'orders';
	protected $primaryKey           = 'Order_Id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	protected $protectFields        = true;
	protected $allowedFields        = ['Order_Id', 'Unique_Id', 'Customer_Id', 'Order_Date', 'Amount', 'Status', 'Remark', 'Last_Update_On'];

	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'Order_Date';

}
