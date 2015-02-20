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
        'product'=>array(
	        'mapping_type'  => BELONGS_TO,
	     	'class_name'    => 'Product',
	     	'foreign_key'   => 'productId'
     	),
 	);
}
?>