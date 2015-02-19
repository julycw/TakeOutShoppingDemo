<?php
class OrderDetailsModel extends Model{
	protected $pk = "id";
    protected $fields = array(
        'id', 
        'orderId',
        'orderNumber',
        'productId',
        'unitPrice',
        'quantity'
    );
}
?>