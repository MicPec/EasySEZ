{% extends:'layout' %}

{%block:pageTitle%}Edycja Użytkownika{%endblock%}

{%block:content%}
<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s">
			<div class="panel-heading">
				{%if (isset($user)) %} Edytuj {%else%} Dodaj {%endif%} użytkownika
			</div>

			<div class="panel-body">

				<form class="form-horizontal" role="form" method="post" action="{{ isset($user)?$urlBuilder->to("/user/$user->id"):$urlBuilder->to('/user/create') }}" data-toggle="validator">
					<input type="hidden" name="REQUEST_METHOD_OVERRIDE" value="PUT">
					<input type="hidden" name="csrf_token" value="{{$session->generateOneTimeToken()}}">

					<div class="form-group">
						<div class="col-sm-2">
							<label for="username" class="control-label">Nazwa Użytkownika</label>
						</div>
						<div class="col-sm-10">
							<input type="text" maxlength="128" data-error="Pole wymagane!" class="form-control" id="username" name="username" placeholder="Nazwa Użytkownika" value='{{isset($user)?$user->username:null}}' required="required">
							<div class="help-block with-errors"></div>
						</div>
					</div>

					<div class="form-group">
						<div class="col-sm-2">
							<label for="email" class="control-label">E-mail</label>
						</div>
						<div class="col-sm-10">
							<input type="text" maxlength="255" class="form-control" id="email" name="email" placeholder="E-mail" value='{{isset($user)?$user->email:null}}' required="required">
						</div>
					</div>

					{%if ($gatekeeper->getUser()->isMemberOf('admin'))%}
					<div class="form-group">
						<div class="col-sm-2">
							<label for="group" class="control-label">Grupa</label>
						</div>
						<div class="col-sm-10">
							<select class="ajaxselect form-control" data-ajax--url="/api/getUserGroups" data-dropdown-parent="" data-placeholder="Wybierz grupę" id="group_id" name="group_id" required="required">
									{% if (isset($user)) %}
										<option value='{{$user->groups()->column('id')}}'="id')}}'">{{$user->groups()->column('name')}}</option>
									{% else %}
										<option></option>
									{% endif %}
								</select>
						</div>
					</div>
					{%endif%}

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
