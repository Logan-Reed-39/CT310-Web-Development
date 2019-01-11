<?php

namespace Model;

class Users {
	public static function get_users()
	{

	}

	public static function get_users_where($column, $condition)
	{
		$adminQuery = \DB::select('*')->from('users')->where($column, $condition)->execute();
		return $adminQuery;
	}

	public static function update_user($columnToUpdate, $newInfo, $columnToLookFor, $condition)
	{
		\DB::update('users')->value($columnToUpdate, $newInfo)->where($columnToLookFor, $condition)->execute();
	}
}
