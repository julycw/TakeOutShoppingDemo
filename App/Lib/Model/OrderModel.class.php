<?php
class OrderModel extends RelationModel{
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
    protected $_link = array(
       'orderDetails'=> array(  
            'mapping_type'=>HAS_MANY,
            'class_name'=>'OrderDetails',
            'foreign_key'=>'orderId',
            'mapping_name'=>'orderDetails',
            'mapping_order'=>'id',
        ),
    );
}
?>