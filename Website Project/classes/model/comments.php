<?php

namespace Model;

class Comments {
	public static function get_comments()
	{
		// array of comments
		$commentQuery = \DB::select('*')->from('comments')->execute();
		return $commentQuery;
	}

	public static function get_comments_where($column, $condition)
	{
		$commentQuery = \DB::select('*')->from('comments')->where($column, $condition)->execute();
		return $commentQuery;
	}

	public static function save_comment($attr_name, $username, $comment, $attr_id) {
		if ($comment != '') {
			$insertQuery = \DB::insert('comments');
			
			$insertQuery->set(array(
				'attr_id' => $attr_id,
				'attr' => $attr_name,
				'username' => $username,
				'comment' => $comment,
			));

			$insertQuery->execute();
		}
	}

	public static function delete_comment($comment_id) {
		\DB::delete('comments')->where('id', $comment_id)->execute();
	}

	public static function update_comment($columnToChange, $newComment, $columnToLookFor, $condition)
	{
		\DB::update('comments')->value($columnToChange, $newComment)->where($columnToLookFor, $condition)->execute();
	}
}
