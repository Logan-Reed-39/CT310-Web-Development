<html>
<head>
	<title>All Status</title>

</head>
<script	src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<style>
.closed{
	color:red;
}
.open{
	color:green;
}
.undefined{
	color:#D7D700;
}


</style>

<body>
<!-- Indicators -->
	<div class="container text-center">
		<h3> All Status </h3>
		<script>
			
	$(document).ready(function(){
			//grabbing json from master list
			$.get("../../../../~ct310/yr2018sp/master.json", function(json){
				console.log(json);
				json.forEach(function(obj){
				
					//grabbing status from each user website now
					$.get("../../../../~"+obj["eid"] + "/ct310/index.php/federation/status", function(jsonEID){
						if(typeof(jsonEID) === "string")
						{
							jsonEID = JSON.parse(jsonEID);
						}
						$('body').append("nameShort: " +  obj["nameShort"] + " nameLong: " + obj["nameLong"] + " eid: " + obj["eid"] + " status: " + "<span class =" +  jsonEID["status"] + ">" + jsonEID["status"] + '</span><br>');
					})
					.fail(function() {
						$('body').append("nameShort: " +  obj["nameShort"] + " nameLong: " + obj["nameLong"] + " eid: " + obj["eid"] + " status: " + "<span class =\"undefined\">" + "No Response" + '</span><br>');
					});
				});
				
			});
		});
		
		</script>
	</div>

</body>


</html>
<style>
.closed{
	color:red;
}
</style>
