<!doctype html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
			<title>Eagle Financial</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
		
		<style>
ul {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

li {
    float: left;
}

li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

li a:hover:not(.active) {
    background-color: #111;
}

.active {
    background-color: #4CAF50;
}
</style>
</head>
<body>
	<ul>
	<li><a href="{{ action('CustomerController@index') }}">Customers</a></li>
	<li><a href="{{ action('StockController@index') }}">Stocks</a></li>
	<li><a href="{{ action('InvestmentController@index') }}">Investments</a></li>
	<li style="float:right"><a>{{ Auth::user()->name }}</a></li>
    <li style="float:right"><a href="{{ url('/logout') }}">Logout</a></li>
    </ul>
    
</ul>
				
				<hr>
				<div class="container">
					@yield('content')
				</div>
			</body>
</html>
			