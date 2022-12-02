<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title></title>
<link rel="preconnect" href="https://fonts.googleapis.com"><link rel="preconnect" href="https://fonts.gstatic.com" crossorigin><link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style type="text/css">
@page { margin: 0in; }
body {
	margin:0;
	font-family: 'Open Sans', sans-serif;
}

div {
	overflow-x:auto;
}

h4 {
	font-size: 20px;
}

.dates {
	color: #595959;
	font-weight: bold;
	font-size: 14px;
}

.company {
	font-size: 14px;
}

.header {
	height: 60px;
	display: block;
	background-color: #333;
}

.header h2 {
	display: block;
	margin:0;
	text-align: center;
	padding-top: 12px;
	color: #fff;
	font-size: 36px;
}

.details {
	height: 60px;
	background-color: #333;
	text-align: center;
}

.details span {
	color: white;
	font-weight: 500;
	padding: 0 14px;
	font-size: 14px;
}

.left-col {
	width: 45%;
	float: left;
}

.right-col {
	width: 55%;
	float: right;
}

.skills {
	max-height: 300px;
	padding:8px;
}

.skills h4 {
	margin:0;
	height: 20px;
}

.skills ul {
	margin: 0;
	padding: 0;
	list-style-type: circle;
}

.skills ul li {
	display: block;
	height: 24px;
	margin:0;
}

.tickets {
	max-height: 200px;
	padding: 8px;
}

.tickets h4 {
	height: 20px;
	margin: 0;
}

.tickets span {
	height: 20px;
	display: block;
}

.education {
	max-height: 300px;
	padding: 8px;
}

.education h4 {
	margin:0;
	height: 20px;
}

.education div {
	max-height: 150px;
}

.education div strong {
/*	height: 24px;*/
}

.education div span {
/*	height: 24px;*/
}

.references {
	padding: 8px;
	height: 100px;
}

.references div {
	height: 50px;
}

.references h4 {
	margin: 0;
	height: 20px;
}

.references div strong {
	height: 24px;
}

.references div span {
	
}

.summary {
	max-height: 400px;
	padding: 8px;
}

.summary h4 {
	margin:0;
	height: 20px;
}

.summary p {
	margin: 0;
}

.career-history {
/*	height: 400px;*/
	padding: 8px;
}

.career-history h4 {
	margin:0;
	height: 20px;
}

.career-history div {
	max-height: 250px;
}
</style>
</head>
<body style="display: block;">

<div class="header">
	<h2>{{ $data['name'] }}</h2>
</div>

<div class="details">
  		<span>{{ $data['email'] }}</span>
  		<span>{{ $data['number'] }}</span>
  		<span>{{ $data['suburb'] }}, {{ $data['state'] }}, {{ $data['postcode'] }}</span>
  	</div>

<div class="left-col">
	<div class="skills">
		<h4>Key Skills</h4>
		<hr>
		<ul>
			@foreach($data['skills'] as $s)
				<li class="company">{{ $s }}</li>
			@endforeach
		</ul>
	</div>

	<div class="education">
		<h4>Education</h4>
		<hr>
		@foreach($data['edu'] as $e)
		<div>
			<strong>{{ $e['name'] }}</strong><br>
			<span class="dates">Finished {{ $e['finish'] }}</span><br>
			<span class="company">{{ $e['institution'] }}</span>
		</div>
		<hr>
		@endforeach
	</div>

	<div class="tickets">
		<h4>Qualifications/Tickets</h4>
		<hr>
		@foreach($data['certs'] as $c)
			<span class="company">{{ $c }}</span>
		@endforeach
	</div>

	<div class="references">
		<h4>References</h4>
		<hr>
		@foreach($data['refs'] as $r)
		<div>
			<strong>{{$r['name']}}</strong><br>
			<span class="company">{{$r['position']}}</span><br>
			<span class="company">{{$r['company']}}</span><br>
			<span class="company">{{ $r['contact'] }}</span>
		</div>
		@endforeach
	</div>
</div>

<div class="right-col">
	<div class="summary">
		<h4>Summary</h4>
		<hr>
		<p>{{ $data['summary'] }}</p>
	</div>

	<div class="career-history">
		<h4>Career History</h4>
		<hr>
		
			@foreach($data['jobs'] as $j)
			<div>
						<strong>{{ $j['title'] }} - </strong>
						<span class="company">{{ $j['company'] }}</span><br>
						<span class="dates">{{ $j['start'] }} - {{ $j['finish'] }}</span>
						<p>{{ $j['summary'] }}</p>
			</div>
			<hr>
			@endforeach
		
	</div>
</div>

</body>
</html>												