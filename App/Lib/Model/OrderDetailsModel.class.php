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
    protected $_link = array(
        'Product'=>array(
	        'mapping_type'  => HAS_ONE,
	     	'class_name'    => 'Product',
	     	'foreign_key'   => 'productId'
     	),
 	);
}
?>