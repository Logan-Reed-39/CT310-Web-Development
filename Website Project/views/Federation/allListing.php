
<!DOCTYPE html>
<head>
	<title>All Listing Page</title>

</head>
<script	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style type="text/css">
</style>

<body>
<!-- Indicators -->
	<div class="container text-center">
		<h3> All Listing </h3>
<script>


	
	$(document).ready(function(){
			//grabbing json from master list
			$.get("../../../../~ct310/yr2018sp/master.json", function(json){
				json.forEach(function(obj){
					
					//grabbing status from each user website now
					$.get("../../../../~"+obj["eid"] + "/ct310/index.php/federation/status", function(jsonEID){
							if(typeof(jsonEID) === "string"){
								jsonEID = JSON.parse(jsonEID);
								console.log(jsonEID);
							}
						if(jsonEID['status'] === "open"){
							$.get("../../../../~" + obj["eid"] + "/ct310/index.php/federation/listing", function(jsonListing){
								console.log("typeof," + typeof(jsonListing));
								if(typeof(jsonListing) === "string"){
									jsonListing = JSON.parse(jsonListing);
									console.log(jsonListing);
								}
								jsonListing.forEach(function(objList){
									$("#mainContent").append("<div>EID: " + obj["eid"] + "<a href = attrEID/" + obj['eid'] + '/' + objList["id"] + "> attractionName " + objList["name"] + 
									"</a> state: " + objList["state"] + "</div>" );
								});
							});
						}
					});
				});
			});
	});

</script>
	</div>
</body>
	
</html>
