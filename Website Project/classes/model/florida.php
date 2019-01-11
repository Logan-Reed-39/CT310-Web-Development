<?php

namespace Model;

class Florida extends \Orm\Model
{

	public function __construct($id = null)
	{
	}
	
	public static function getAttraction(){
        $result = \DB::select('*')->from('attractions')->as_assoc()->execute();
		return $result;
	}

	public static function getAttractionName($attractionID){
		$result = \DB::select('attractionName')->from('attractions')->where('attractionID', $attractionID)->execute();
		return $result;
	}
	
	public static function getAttractionDesc(){
		$result = \DB::select('description')->from('attractions')->as_assoc()->execute();
		return $result;
	}
	
	public static function getAttractionPic(){
		$result = \DB::select('picture')->from('attractions')->as_assoc()->execute();
		return $result;
	}
	
	public static function getAttractionID(){
		$result = \DB::select('attractionID')->from('attractions')->as_assoc()->execute();
		return $result;
	}

	public static function getComments($attractionID){
		$result = \DB::select('*')->from('comments')->where('attractionID', $attractionID)->as_assoc()->execute();
		return $result;
	}

	public static function inputComments($comment, $attractionID){
		$query = \DB::insert('comments');
		$query->set(array(
			'comment' => $comment,
			'attractionID' => $attractionID,
		)) -> execute();
	}

	public static function deleteComment($commentID){
		$query = \DB::delete('comments');
		$query->where('commentID',$commentID) -> execute();

	}

	public static function updateComment($commentID, $updatedComment){
		$query = \DB::update('comments');
		$query->set(array(
			'comment' => $updatedComment,
			
		));
		$query->where('commentID',$commentID) -> execute();

	}

	public static function getUsers(){
		$users = \DB::select('*')->from('users')->as_assoc()->execute();
		return $users;
	}

	public static function addItem($attractionID, $username, $attractionName){
		$query = \DB::insert('cart');
		$query->set(array(
			'attractionID' => $attractionID,
			'username' => $username,
			'attractionName' => $attractionName,
		)) -> execute();
	}

	public static function deleteItem($itemID){
		$query = \DB::delete('cart');
		$query->where('itemID',$itemID) -> execute();

	}


	public static function getCart($username){
		$result = \DB::select('*')->from('cart')->where("username", $username)->as_assoc()->execute();
		return $result;
	}

	public static function getItems($username){
		$result = \DB::select('attractionName','itemID')->from('cart')->where("username", $username)->as_assoc()->execute();
		return $result;

	}
	
	public static function deleteCart($username){
		$query = \DB::delete('cart');
		$query->where('username',$username) -> execute();

	}

	public static function addAttraction($attractionName, $attractionDesc, $picture, $state){
		$query = \DB::insert('attractions');
		$query->set(array(
			'attractionName' => $attractionName,
			'description' => $attractionDesc,
			'picture' => $picture,
			'state' => $state
			)) -> execute();	
	}

	public static function getToken($email){
		$result = \DB::select('token')->from('users')->where("email", $email)->as_assoc()->execute();
		return $result;
	}

	public static function resetPW($email, $newPW){
		$query = \DB::update('users');
		$query->set(array(
			'password' => $newPW,
			
		));
		$query->where('email', $email) -> execute();

	}
}

?>
