<?php
class OrderModel extends Model{
	protected $pk = "id";
    protected $fields = array(
        'id', 
        'orderNumber',
        'userName',
        'address',
        'phone',
        'price',
        'status',
        'createOn'
    );
}
?>