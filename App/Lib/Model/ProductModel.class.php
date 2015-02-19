<?php
class ProductModel extends Model{
	protected $pk = "id";
    protected $fields = array(
        'id', 
        'productName',
        'unitPrice',
        'categoryCode',
        'imageUrl'
    );
}
?>