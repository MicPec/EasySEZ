{% extends:'layout' %}

{% block:pageTitle %}Użytkownicy{% endblock %}

{% block:content %}
<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s">
			<div class="panel-heading">

				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-8 searchbox">
					<form class="form form-horizontal" role='search' method="get" data-toggle="validator" action="{{ url()->to('/users') }}">
						<div class="input-group">
							<input type="Search" placeholder="Szukaj..." class="form-control" id="s" name="s" data-minlength="2" value="{{ request()->getQuery()->get('s') }}" required/>
							<div class="input-group-btn">
								<button class="btn btn-info">
                  <span class="glyphicon glyphicon-search"></span>
                </button>
							</div>
						</div>
					</form>
				</div>

				<div class="pull-right">
					<a class="btn btn-default btn-xs" href="{{ url()->to('/user/create') }}">
						<p class="glyphicon glyphicon-new-window"></p> Nowy</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-condensed table-striped table-dynamic">
						<thead>
							<tr>
								<th>Nazwa</th>
								<th>Email</th>
								<th>IP</th>
								<th>Aktywowany</th>
								<th>Zbanowany</th>
								<th>Rola</th>
								<th class="text-right">Akcja</th>
							</tr>
						</thead>
						<tbody>
							{% foreach ($users as $user) %}
							<tr>
								<td data-label="Nazwa">{{ $user->username }}</td>
								<td data-label="Email">{{ $user->email }}</td>
								<td data-label="IP">{{ $user->ip }}</td>
								<td data-label="Aktywowany">
									<div class="form-check"><input class="form-check-input" type="checkbox" disabled {{ $user->isActivated()?'checked':null}}></div>
								</td>
								<td data-label="Zbanowany">
									<div class="form-check"><input class="form-check-input" type="checkbox" disabled {{ $user->isBanned()?'checked':null}}></div>
								</td>
								<td data-label="Rola">{{ $user->groups()->column('name') }}</td>

								<td data-label="" class="text-right">
									{% if ($user->isBanned()) %}
										<a class="confirm btn btn-info btn-xs" href="#" data-val1="{{ $user->id }}" data-link="/api/unbanUserModal" data-toggle="tooltip" title="Zdejmij bana"><span class="fa fa-user"></span></a>
									{% else %}
										<a class="confirm btn btn-info btn-xs" href="#" data-val1="{{ $user->id }}" data-link="/api/banUserModal" data-toggle="tooltip" title="Banuj"><span class="fa fa-user-times"></span></a>
									{% endif %}
									<a class="btn btn-warning btn-xs" href="{{ url()->to('/user/'.$user->id.'/changepassword') }}" data-toggle="tooltip" title="Zmień hasło"><span class="fa fa-key"></span></a>
									<a class="btn btn-danger btn-xs" href="{{ url()->to('/user/'.$user->id) }}" data-toggle="tooltip" title="Edytuj"><span class="glyphicon glyphicon-edit"></span></a>
								</td>

							</tr>
							{% endforeach %}

						</tbody>
					</table>
				</div>
			</div>
			<div class="panel-footer">
				<div class="text-right">
					{{ raw:$users->getPagination()->render('chunks.pagination') }}
				</div>
			</div>
		</div>
	</div>
</div>
{{ view:'chunks.modal' }}
{% endblock %}
