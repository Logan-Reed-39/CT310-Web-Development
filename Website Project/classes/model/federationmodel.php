<?php

namespace Model;

class FederationModel extends \Orm\Model
{

	public function __construct($id = null)
	{
	}
	
	public static function getAttractions(){
        $result = \DB::select(array('attractionID', 'id'), array('attractionName', 'name'), 'state')->from('attractions')->as_assoc()->execute();
		return $result;
	}

	public static function getAttr($id){
        $result = \DB::select(array('attractionID', 'id'), array('attractionName', 'name'), array('description', ' desc'), 'state')->from('attractions')->where('attractionID', $id)->as_assoc()->execute();
		return $result[0];
	}

	public static function getImg($id){
        $result = \DB::select('picture')->from('attractions')->where('attractionID', $id)->as_assoc()->execute();
		return $result;
	}
	public static function addItem($name){
		$query = \DB::insert('p3Cart');
		$query->set(array(
			'name' => $name,
		)) -> execute();
	}
	
	public static function getp3cart(){
		$result = \DB::select('*')->from('p3Cart')->as_assoc()->execute();
		return $result;
	}

	public static function deleteItem($name){
		$query = \DB::delete('p3Cart');
		$query->where('name',$name) -> execute();

	}
	public static function deletep3cart(){
		$query = \DB::delete('p3Cart');
		$query-> execute();

	}

}
