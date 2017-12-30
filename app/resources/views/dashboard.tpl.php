{% extends:'layout' %}

{%block:pageTitle%}Dashboard{%endblock%}

{%block:content%}
<div class="row">
	<div class="col-sm-12">

		<div class="row no-margin">
			<div class="col-lg-3 col-sm-6 col-xs-12 wow bounceInRight" data-wow-duration=".5s" data-wow-delay=".0s">
				<div class="panel panel-blue">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-users fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">{{ $clientsCount }}</div>
								<div>Klientów</div>
							</div>
						</div>
					</div>
					<a href="/clients">
						<div class="panel-footer">
							<span class="pull-left">Przejdź</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-xs-12 wow bounceInRight" data-wow-duration=".5s" data-wow-delay=".2s">
				<div class="panel panel-green">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-inbox fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">{{ $ordersCount }}</div>
								<div>Zleceń</div>
							</div>
						</div>
					</div>
					<a href="/orders">
						<div class="panel-footer">
							<span class="pull-left">Przejdź</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-xs-12 wow bounceInRight" data-wow-duration=".5s" data-wow-delay=".4s">
				<div class="panel panel-yellow">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-cogs fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">{{ $inprogressCount }}</div>
								<div>W trakcie realizacji</div>
							</div>
						</div>
					</div>
					<a href="/orders?qf=inprogress">
						<div class="panel-footer">
							<span class="pull-left">Zobacz</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
			<div class="col-lg-3 col-sm-6 col-xs-12 wow bounceInRight" data-wow-duration=".5s" data-wow-delay=".6s">
				<div class="panel panel-red">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-3">
								<i class="fa fa-exclamation-circle fa-5x"></i>
							</div>
							<div class="col-xs-9 text-right">
								<div class="huge">{{ $newCount }}</div>
								<div>Nowe</div>
							</div>
						</div>
					</div>
					<a href="/orders?qf=new">
						<div class="panel-footer">
							<span class="pull-left">Zobacz</span>
							<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
							<div class="clearfix"></div>
						</div>
					</a>
				</div>
			</div>
		</div>

		<div class="row no-margin">
			<div class="col-md-5">
				<!-- ****************** CHART ************* -->
				<div class="panel panel-default wow bounceInRight" data-wow-duration=".5s">
					<div class="panel-heading">
						<i class="fa fa-bell fa-fw"></i> Panel informacyjny
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="list-group">
							<a href="/orders" class="list-group-item">
                                <i class="fa fa-inbox fa-fw"></i> Całkowita liczba zleceń
                                <span class="pull-right text-muted"><em class="label label-success label-pill">{{ $ordersCount }}</em></span>
                            </a>
							<a href="/orders?qf=new" class="list-group-item">
                                <i class="fa fa-exclamation-circle fa-fw"></i> Nowe
                                <span class="pull-right text-muted"><em class="label label-danger label-pill">{{ $newCount }}</em></span>
                            </a>
							<a href="/orders?qf=inprogress" class="list-group-item">
                                <i class="fa fa-cogs fa-fw"></i> W trakcie realizacji
                                <span class="pull-right text-muted"><em class="label label-warning label-pill">{{ $inprogressCount }}</em></span>
                            </a>
							<a href="/orders?user={{$gatekeeper->getUser()->id}}" class="list-group-item">
                                <i class="fa fa-inbox fa-fw"></i> Przyjęte przez Ciebie
                                <span class="pull-right text-muted"><em class="label label-primary label-pill">{{ $ordersByYou }}</em></span>
                            </a>
							<a href="/orders?qf=today" class="list-group-item">
                                <i class="fa fa-calendar-plus-o fa-fw"></i> Przyjęte dzisiaj
                                <span class="pull-right text-muted"><em class="label label-info label-pill">{{ $startedToday }}</em></span>
                            </a>
							<a href="/orders?qf=thisweek" class="list-group-item">
                                <i class="fa fa-calendar-plus-o fa-fw"></i> Przyjęte w tym tygodniu
                                <span class="pull-right text-muted"><em class="label label-info label-pill">{{ $startedThisWeek }}</em></span>
                            </a>
							<a href="/orders?qf=thismonth" class="list-group-item">
                                <i class="fa  fa-calendar-plus-o fa-fw"></i> Przyjęte w tym miesiącu
                                <span class="pull-right text-muted"><em class="label label-info label-pill">{{ $startedThisMonth }}</em></span>
                            </a>
							<a href="/orders?qf=endedtoday" class="list-group-item">
                                <i class="fa fa-calendar-check-o fa-fw"></i> Zakończone dzisiaj
                                <span class="pull-right text-muted"><em class="label label-default label-pill">{{ $endedToday }}</em></span>
                            </a>
							<a href="/orders?qf=endedthisweek" class="list-group-item">
                                <i class="fa fa-calendar-check-o fa-fw"></i> Zakończone w tym tygodniu
                                <span class="pull-right text-muted"><em class="label label-default label-pill">{{ $endedThisWeek }}</em></span>
                            </a>
							<a href="/orders?qf=endedthismonth" class="list-group-item">
                                <i class="fa fa-calendar-check-o fa-fw"></i> Zakończone w tym miesiącu
                                <span class="pull-right text-muted"><em class="label label-default label-pill">{{ $endedThisMonth }}</em></span>
                            </a>
						</div>

					</div>
				</div>
			</div>

			<!-- *** calendar *** -->
			<div class="row no-margin">
				<div class="col-md-7">
					{{ view:'chunks.calendar' }}</div>
			</div>

			{#

			<div class="col-md-7">
				<!-- ****************** DEADLINE ************* -->
				<check if="{{ $afterDeadline }}">
					<div class="panel panel-danger fresh-color wow bounceInUp" data-wow-duration=".5s" data-wow-delay="0.05s">
						<div class="panel-heading">
							<i class="fa fa-clock-o fa-fw"></i> Po terminie
						</div>
						<div class="panel-body">
							<table class="table table-condensed table-striped table-dynamic">
								<thead>
									<tr>
										<th>Termin</th>
										<th>Klient</th>
										<th>Produkt</th>
										<th class="text-right">Akcja</th>
									</tr>
								</thead>
								<tbody>
									<repeat group="{{ $afterDeadline }}" value="{{ $order }}">
										<tr style="background-color: {{$order.status_id.color}}">
											<td data-label="Termin">{{ $order.deadline }}</td>
											<td data-label="Klient">{{ $order.client_id.sname }} {{$order.client_id.fname}}
												</br/><strong>({{ $order.client_id.company }})</strong></td>
											<td data-label="Produkt"><strong>{{ $order.product_id.name }}</strong> ({{ $order.qty }} {{ $order.product_id.unit_id.name }})</td>
											<td data-label="" class="text-right">
												<a class="btn btn-info btn-sm" href="{{ $BASE }}/orders?id={{ $order.id }}"><span class="fa fa-eye"></span> </a>
											</td>
										</tr>
									</repeat>

								</tbody>
							</table>
						</div>
					</div>
				</check>

		</div>

		#}

		<div class="row no-margin">

			<!-- ****************** BEST CLIENTS ************* -->
			<div class="col-md-8">
				<div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s">
					<div class="panel-heading">
						<i class="fa fa-bar-chart-o fa-fw"></i> Najlepsi klienci
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="table-responsive">
							<table class="table table-condensed table-striped table-dynamic">
								<thead>
									<tr>
										<th>Klient</th>
										<th>Dane</th>
										<th class="text-right">Akcja</th>
									</tr>
								</thead>
								<tbody>
									{% foreach ($bestClients as $client) %}
									<tr>
										<td data-label="Klient">{{ $client->sname ?? null }} {{ $client->fname ?? null }}
											<br/><strong>{{ $client->company ?? null }}</strong></td>
										<td data-label="Dane"><a href="mailto:{{ $client->email ?? null }}">{{ $client->email ?? null }}</a>
											<br/> {{ $client->phone ?? null }}
											<br/><a href="/{{ $client->website ?? null }}" target="_blank">{{ $client->website ?? null }}</a>
										</td>

										<td data-label="" class="text-right">
											<a class="btn btn-info btn-sm" href="/orders?client={{ $client->id ?? null }}"><span class="glyphicon glyphicon-list"></span> Zlecenia <span class="badge">{{ $client->ordersCount ?? null }}</span></a>
											<a class="btn btn-success btn-sm" href="/clients?id={{ $client->id ?? null }}"><span class="glyphicon glyphicon-user"></span></a>
										</td>
									</tr>
									{% endforeach %}
								</tbody>
							</table>
						</div>
					</div>
				</div>
				<!-- ****************** BEST PRODUCTS ************* -->
				<div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s" data-wow-delay=".15s">
					<div class="panel-heading">
						<i class="fa fa-bar-chart-o fa-fw"></i> Najpopularniejsze produkty
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<table class="table table-condensed table-striped table-dynamic">
							<thead>
								<tr>
									<th>Produkt</th>
									<th class="text-right">Akcja</th>
								</tr>
							</thead>
							<tbody>
								{% foreach ($bestProducts as $product) %}
								<tr>
									<td data-label="Produkt"><strong>{{ $product->name ?? null }}</strong>
										<br/>({{ $product->unitprice ?? null }}zł/{{ $product->unit->name ?? null }})</td>
									<td data-label="" class="text-right">
										<a class="btn btn-info btn-sm" href="/orders?product={{ $product->id ?? null }}"><span class="glyphicon glyphicon-list"></span> Zlecenia <span class="badge">{{ $product->ordersCount ?? null }}</span></a>
										<a class="btn btn-primary btn-sm" href="/products?id={{ $product->id ?? null }}"><span class="fa fa-cube"></span></a>
									</td>
								</tr>
								{% endforeach %}

							</tbody>
						</table>
					</div>
				</div>
			</div>
			<!-- </div> -->
			<!-- *********************************** -->
			<div class="col-md-4">
				<div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s" data-wow-delay="0.1s">
					<div class="panel-heading">
						<i class="fa fa-pie-chart fa-fw"></i> Chart
					</div>
					<!-- /.panel-heading -->
					<div class="panel-body">
						<div class="progress">
							<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
								<span class="sr-only">40% Complete (success)</span>
							</div>
						</div>
						<div class="progress">
							<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%">
								<span class="sr-only">20% Complete</span>
							</div>
						</div>
						<div class="progress">
							<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%">
								<span class="sr-only">60% Complete (warning)</span>
							</div>
						</div>
						<div class="progress">
							<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%">
								<span class="sr-only">80% Complete (danger)</span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
{%endblock%}
