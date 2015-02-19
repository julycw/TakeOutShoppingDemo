<?php
class CartModel extends RelationModel{
	protected $pk = "id";
    protected $fields = array(
        'id', 
        'userName',
        'productId',
        'quantity',
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