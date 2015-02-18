<?php
class UserModel extends Model{
    protected $fields = array(
    	'_pk' => 'id', '_autoinc' => true,
        'id', 
        'userName',
        'password',
        'nickName',
        'roleId',
    );
}
?>