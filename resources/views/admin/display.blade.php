<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>LIVE USER COUNT</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script type="text/javascript">
const myInterval = setInterval(myTimer, 5000);

function myTimer() {
	$.get("/admin/display/ajax", function(data, status){
	    // alert("Data: " + data + "\nStatus: " + status);
	    $("#count").html(data)
	  });
}
</script>
</head>
<body>

<div class="center">
	<div style="margin:0;">
		<h4>Total Users</h4>
		<h5 id="count">{{ $count }}</h5>
	</div>
</div>

<style type="text/css">
body {
	font-family: 'Roboto', sans-serif;
	background-color: #6246ea;
}

.center {
  display: flex;
  justify-content: center;
  align-items: center;
  text-align: center;
  min-height: 100vh;
  color: white;
}

h4 {
	margin:0;
	font-size: 32px;
	padding-bottom: 10px;
}

h5 {
	margin:0;
	font-size: 42px;
}
</style>

</body>
</html>