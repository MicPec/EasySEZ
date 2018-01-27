{% extends:'layout' %}

{%block:pageTitle%}Zmiana hasła{%endblock%}

{%block:content%}
<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-danger fresh-color wow bounceInUp" data-wow-duration=".5s">
			<div class="panel-heading">
				Zmień hasło użytkownika {{ $user->username||null }}
			</div>

			<div class="panel-body">

				<form class="form-horizontal" role="form" method="post" action="{{ url()->to("/user/$user->id/changepassword") }}" data-toggle="validator">
					<input type="hidden" name="REQUEST_METHOD_OVERRIDE" value="PUT">
					<input type="hidden" name="csrf_token" value="{{ one_time_token() }}">

					{%if (!$user->getPassword()=='' && !user()->isMemberOf('admin') ) %}
					<div class="form-group">
						<div class="col-sm-2">
							<label for="oldpass" class="control-label">Stare hasło</label>
						</div>
						<div class="col-sm-10">
							<input type="password" maxlength="128" data-error="Pole wymagane!" class="form-control" id="oldpass" name="oldpass" placeholder="Podaj stare hasło" value='' required>
							<div class="help-block with-errors"></div>
						</div>
					</div>
					{%endif%}

					<div class="form-group">
						<div class="col-sm-2">
							<label for="oldpass" class="control-label">Nowe hasło</label>
						</div>

						<div class="col-sm-10">
							<input type="password" minlength="5" data-error="Minimalnie 6 znaków" class="form-control" id="newpass" name="newpass" placeholder="Podaj hasło" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-offset-2 col-sm-10">
							<input type="password" class="form-control" id="confirmpass" name="confirmpass" data-match="#newpass" data-error="Pole wymagane" data-match-error="Hasło musi być identyczne" placeholder="Potwierdź" required>
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-10 col-sm-offset-2 text-right">
							<button type="submit" class="btn btn-primary">Zapisz</button>
						</div>
					</div>
				</form>

			</div>
		</div>
	</div>
</div>
{%endblock%}
