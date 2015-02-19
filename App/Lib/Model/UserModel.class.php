<?php
class UserModel extends RelationModel{
	protected $pk = "id";
    protected $fields = array(
        'id', 
        'userName',
        'password',
        'nickName',
        'role',
    );
}
?>