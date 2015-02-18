<?php
class UserModel extends Model{
	protected $pk = "id";
    protected $fields = array(
        'id', 
        'userName',
        'password',
        'nickName',
        'roleId',
    );
}
?>