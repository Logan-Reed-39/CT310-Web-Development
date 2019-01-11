<?php

namespace Model;

class Attractions {
	public static function get_attrs()
	{
		$attrQuery = \DB::select('*')->from('attrs')->execute();
		return $attrQuery;
	}

	public static function get_attrs_where($column, $condition)
	{
		$attrQuery = \DB::select('*')->from('attrs')->where($column, $condition)->execute();
		return $attrQuery;
	}

	public static function save_attr($name, $descrip, $img_file)
	{
		\DB::insert('attrs')->set(array(
			'name' => $name,
			'descrip' => $descrip,
			'img_file' => $img_file,
		))->execute();
	}
}
