<html>
<head>
<title><?=$eid?> Attraction <?=$attrID?> </title>

</head>
<script	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style type="text/css">
</style>

<body>
<!-- Indicators -->
	<div class="container text-center">
	<h3> <?=$eid?> Attraction <?=$attrID?> </h3>
	<img src="<?php echo "https://www.cs.colostate.edu/~" . $eid . "/ct310/index.php/federation/attrImage/".$attrID; ?>" height="500" width="1000" >


	<script>
	$(document).ready(function(){
		//grabbing status from each user website now
		//$("body").append("HELLO");
		$.get("<?php echo "../../../../../../~" . $eid .  "/ct310/index.php/federation/attraction/" . $attrID; ?> ", function(json){
			if(typeof(json) === "string"){
				json = JSON.parse(json);
			}
			console.log(Object.keys(json));
			console.log(json["id"]);

			$("#mainContent").append(json["desc"]);
			$("h3").append(json["state"]);
				
		});

		$.get("../../../../../../~ct310/yr2018sp/master.json", function(master){
			console.log(master);
			if(typeof(master) === "string"){
				master = JSON.parse(json);
			}
			master.forEach(function(obj){
				if(obj["eid"] === "<?=$eid?>"){
					$("#mainContent").append("<br> <br>  <a href = /~lvreed/ct310/index.php/Federation/addItem/" + obj['nameShort']  + "> <input type=button  name=addItem value=\"+ item to cart\" id=addItem></a>");
					$("#mainContent").append("<br>");	
											
				}

			});

		});

	});


	</script>
<?php 
		$user = Session::get('username');
		if(!isset($user)){
			$user = $guest;
		}
?>
		
	

	</div>
