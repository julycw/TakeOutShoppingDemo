<?php
class CategoryModel extends Model{
	protected $pk = "id";
    protected $fields = array(
        'id', 
        'categoryCode',
        'categoryName',
    );
}
?>