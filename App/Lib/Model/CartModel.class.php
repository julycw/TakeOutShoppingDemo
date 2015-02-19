<?php
class CartModel extends Model{
	protected $pk = "id";
    protected $fields = array(
        'id', 
        'userName',
        'productId',
        'quantity',
    );
}
?>