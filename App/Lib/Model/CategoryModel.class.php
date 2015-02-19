<?php
class CategoryModel extends RelationModel{
	protected $pk = "id";
    protected $fields = array(
        'id', 
        'categoryCode',
        'categoryName',
    );
}
?>