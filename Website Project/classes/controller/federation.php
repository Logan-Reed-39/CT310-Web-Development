<?php

use Model\florida;
use Model\FederationModel;

class Controller_Federation extends Controller
{
	
	public function action_status(){
		$object = new stdClass();

		$object->status = "open";
	
		$Response = Response::forge(json_encode($object));

		$Response->set_header('Content-Type', 'application/json');

		return $Response; 
		
	}

	public function action_listing(){
		
	//	$object = new stdClass();

	//	$fed = new FederationModel();

		$attractions = FederationModel::getAttractions();

		$attractionsJson = Format::forge($attractions)->to_json();

		$Response = Response::forge($attractionsJson);

		$Response->set_header('Content-Type', 'application/json');

		return $Response;

	}


	public function action_allstatus(){

		$layout = View::forge('Florida/layout');
 				
		$content = View::forge('Federation/allstatus');
	
  		$Florida = new florida();
        
	  	$attractions = Florida::getAttraction();
        
      	$layout->set_safe("attractions", $attractions);
	
      	$layout->content = Response::forge($content);
		
		return $layout;
	
	}
	
	public function action_attraction($id){

		$attraction = FederationModel::getAttr($id);

		$attractionsJson = Format::forge($attraction)->to_json();

		$Response = Response::forge($attractionsJson);

		$Response->set_header('Content-Type', 'application/json');

		return $Response;


		
	
	}
	
	public function action_attrimage($id){

		$attrPath = FederationModel::getImg($id);

		$imgPath = $attrPath[0]['picture'];

		$imgName = explode("/", $imgPath);

		//since the get file wants a file name, instead of path, we have to split the path and get the 3rd varriable
		$Response = Response::forge(file_get_contents(Asset::get_file($imgName[2], 'img')));

		$Response->set_header('Content-Type','image/jpeg');

		return $Response;
	}

	public function action_allListing(){
	
		$layout = View::forge('Florida/layout');
 				
		$content = View::forge('Federation/allListing');
	
  		$Florida = new florida();
        
	  	$attractions = Florida::getAttraction();
        
      	$layout->set_safe("attractions", $attractions);
	
      	$layout->content = Response::forge($content);
		
		return $layout;
	

	}
	public function action_attrEID($eid, $attrID){
	
		$layout = View::forge('Florida/layout');
 				
		$content = View::forge('Federation/attrEID');
	

		$content->set_safe("eid", $eid);

		$content->set_safe("attrID",$attrID);

		$Florida = new florida();
       
        $attractions = Florida::getAttraction();
		
		$attractionName = Florida::getAttractionName($attrID);
		
		$content->set_safe('attractionID', $attrID);
	
		$layout->set_safe("attractions", $attractions);
		
		$content->set_safe("attractions", $attractions);
		
		$layout->set_safe("guest","guest");
		
		$content->set_safe("guest", "guest");	
		
	
      	$layout->content = Response::forge($content);
		
		return $layout;
	

	}
	public function action_addItem($name){
        
		FederationModel::addItem($name);
		//Florida::addItemP3($attractionID, $username, $shortName);
	   	Response::redirect('Federation/p3cart/'.$name);
	}
	
	public function action_p3cart($name){
        
        $layout = View::forge('Florida/layout');
        
        $content = View::forge('Federation/p3cart');
        
        $Florida = new florida();
        
        $attractions = Florida::getAttraction();
        
		$p3cart = federationModel::getp3cart();
		
		$content->set_safe("p3cart", $p3cart);
		
		$content->set_safe("attractions", $attractions);
		
		$layout->set_safe("attractions", $attractions);
		
		$layout->content = Response::forge($content);
		
		return $layout;
	
	}


	public function action_deleteItem($name){
		federationModel::deleteItem($name);
	   	Response::redirect('Federation/p3cart/'.$name);
	}
	public function post_p3cart($username)
	{
		$name = filter_var(Input::post('name'), FILTER_SANITIZE_STRING);
		$email = filter_var(Input::post('email'),FILTER_SANITIZE_EMAIL);
		$cart = federationModel::getp3cart();
		$custMsg = "Hello " . $name . "! Thank you for ordering the following brochures: \n";
		$adminMsg = $name . " has ordered: \n";
		$orders = "";
		$endMsg = "Please come again!";
		$logan = "lvreed@rams.colostate.edu";
	//	$lettia = "lwilson1@rams.colostate.edu";
		foreach($cart as $item){
			$orders .= $item['name'] . "\n";
		}
		
		mail($email, "Florida Brochures [Ordered]", $custMsg . $orders . $endMsg );
		mail($logan, "Florida Brochures [Ordered]", $adminMsg . $orders );
	// 	mail($lettia, "Florida Brochures [Ordered]", $custMsg . $orders );
		federationModel::deletep3cart();
		Response::redirect('Federation/p3cart/'.$username);
	}
	
	

}
