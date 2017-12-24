<!DOCTYPE html>
<html>

	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="{{ APP_NAME }} {{ APP_VERSION }} - System Ewidencji Zleceń">
		<meta name="author" content="michal.pecyna@gmail.com">
		<link rel="icon" type="image/png" href="{{$urlBuilder->to('/assets/img/favicon.png')}}"/>

		<title>{{APP_NAME}} - Login</title>

		{{view:'chunks.css'}}
	</head>

	<body class="flat-blue login-page">

		<div class="container">
			<div class="login-box">
				<div>
					<div class="login-form row">
						<div class="col-sm-12 text-center login-header">
							<i class="login-logo fa fa-cloud fa-5x"></i>
							<h4 class="login-title">{{APP_NAME}} {{APP_VERSION}}</h4>
						</div>
						<div class="col-sm-12">
							<div class="login-body">
								<div class="progress hidden" id="login-progress">
									<div class="progress-bar progress-bar-success progress-bar-striped active" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
										Loguję
									</div>
								</div>
								{{view:'chunks.flash'}}
								<h4 class="form-signin-heading text-center">Zaloguj się na swoje konto.</h4>
								<form method="post" action="/login" data-toggle="validator">
									<div class="control">
										<input type="text" class="form-control" name="email" placeholder="E-mail" required="required" autofocus="autofocus"/>

										<input type="password" class="form-control" name="password" placeholder="Hasło" required="required"/>
										<div class="checkbox">
											<label><input type="checkbox" name="remember" value="">Pamiętaj mnie</label>
										</div>
									</div>
									<div class="login-button text-center">
										<button type="submit" class="btn btn-success">Zaloguj</button>
									</div>
								</form>
							</div>

						</div>
					</div>
				</div>
			</div>
		</div>

		{{view:'chunks.js'}}

	</body>

</html>
