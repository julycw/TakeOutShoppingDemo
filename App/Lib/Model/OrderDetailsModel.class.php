<?php
class OrderDetailsModel extends RelationModel{
	protected $pk = "id";
    protected $fields = array(
        'id', 
        'orderId',
        'orderNumber',
        'productId',
        'productName',
        'unitPrice',
        'quantity'
    );
}
?>