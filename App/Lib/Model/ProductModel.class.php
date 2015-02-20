<?php
class ProductModel extends RelationModel{
	protected $pk = "id";
    protected $fields = array(
        'id', 
        'productName',
        'unitPrice',
        'categoryId',
        'imageUrl'
    );
    protected $_link = array(
        'categoryCode'=> array(
     		'mapping_type'=>BELONGS_TO,
      	'class_name'=>'Category',
      	'foreign_key'=>'categoryId',
      	'mapping_name'=>'category',
 		),
    );
}
?>