<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<meta http-equiv="X-UA-Compatible" content="ie=edge" />
		<link
			rel="stylesheet"
			href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css"
		/>
		<link rel="stylesheet" href="{{asset('css/reset.css')}}" />
		<link rel="stylesheet" href="{{asset('404.css')}}" />
		<title>404</title>
	</head>
	<body>
		<div
			class="not_found container text-center d-flex justify-content-center align-items-center"
		>
			<div>
				<img src="/images/broken_pencil.png" alt="Broken Pencil" />
				<h1>404 Error</h1>
				<p>
					We can't find the page <br />
					you're looking for
				</p>
				<a href="/" class="not_found_btn">Go Back</a>
			</div>
		</div>
	</body>
</html>