<?php

namespace App\Models;

use CodeIgniter\Model;

class UserorderModel extends Model
{
	protected $DBGroup              = 'default';
	protected $table                = 'userOrders';
	protected $primaryKey           = 'Id';
	protected $useAutoIncrement     = true;
	protected $insertID             = 0;
	protected $returnType           = 'array';
	protected $useSoftDeletes       = false;
	// protected $protectFields        = true;
	protected $allowedFields        = ['Id', 'Order_Id', 'Item_Id', 'Qty', 'Price', 'Discount', 'Vat', 'Created_on'];

	protected $useTimestamps        = false;
	protected $dateFormat           = 'datetime';
	protected $createdField         = 'Created_On';
}
