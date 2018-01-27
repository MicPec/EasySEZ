<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="{{ APP_NAME }} {{ APP_VERSION }} - System Ewidencji Zleceń">
		<meta name="author" content="michal.pecyna@gmail.com">
		<link rel="icon" type="image/png" href="{{url()->to('/assets/img/favicon.png')}}"/>
		{{view:'chunks.css'}}
		<title>{{ APP_NAME }}</title>
	</head>
	<body class="flat-blue">
		<div class="app-container">
			<div class="row content-container">
				<div class="loader">
					<span class="fa fa-spinner fa-spin fa-5x"></span>
				</div>
				{{view:'chunks.nav'}}

				<div class="container-fluid">
					<div class="side-body">
						{{view:'chunks.flash'}}
						{{block:content}}{{endblock}}
					</div>
				</div>

				<footer class="app-footer">
					<div class="wrapper">
						<span class="pull-right">{{ APP_NAME }}
							{{ APP_VERSION }}
							<a href="#">
								<i class="fa fa-long-arrow-up"></i>
							</a>
						</span>
						© 2016 -  {{ date('Y') }} <a href="mailto:michal.pecyna@gmail.com">Michał Pecyna</a>
					</div>
				</footer>
			</div>
		</div>
		<span id="top-link-block" class="hidden">
			<button type="button" class="btn btn-danger" aria-label="Left Align" onclick="$('html,body').animate({scrollTop:0},'slow');return false;">
				<i class="glyphicon glyphicon-chevron-up"></i>
			</button>
		</span>
		{{view:'chunks.js'}}
	</body>
</html>
