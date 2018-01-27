{% extends:'layout' %}

{%block:pageTitle%}Zlecenia{%endblock%}

{%block:content%}
<div class="row">
	<div class="col-sm-12">

		{{view:'chunks.filter'}}
		<div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s">
			<div class="panel-heading">
				<div class="col-lg-3 col-md-4 col-sm-6 col-xs-8 searchbox">
					<form class="form form-horizontal" role='search' method="get" data-toggle="validator" action="{{ url()->to('/orders') }}">
						<div class="input-group">
							<input type="Search" placeholder="Szukaj..." class="form-control" id="s" name="s" data-minlength="2" value="{{ request()->getQuery()->get('s') }}" required="required" />
							<div class="input-group-btn">
								<button class="btn btn-info">
									<span class="glyphicon glyphicon-search"></span>
								</button>
							</div>
						</div>
					</form>

				</div>
				<div class="pull-right">
					<a class="btn btn-default btn-xs" href="{{ url()->to('/order/create') }}">
						<p class="glyphicon glyphicon-new-window"></p>Nowy</a>
				</div>
				<div class="clearfix"></div>
			</div>
			<div class="panel-body">
				<div class="table-responsive">
					<table class="table table-striped table-condensed table-dynamic">
						<thead>
							<tr>
								<th>#</th>
								<th>Data</th>
								<th class="ellipsis" style="min-width: 150px;">Klient</th>
								<th class="hidden-md hidden-sm hidden-xs" style="min-width: 150px;">Produkt</th>
								<th class="hidden-md hidden-sm hidden-xs">Notatka</th>
								<th class="hidden-md hidden-sm hidden-xs">Flagi</th>
								<!-- -- -->
								<th class="hidden-lg">Zlecenie</th>
								<th>Status</th>
								<th class="text-right">Akcja</th>
							</tr>
						</thead>
						<tbody>
							{% foreach ($orders as $order)%}
							<tr style="background-color: {{ $order->status->color ?? null }}">
								<td data-label="#">{{ $order->id }}</td>
								<td data-label="Data" style="min-width:11ch;">
									<!-- <strong>Przyjęto:</strong><br/>{{ str_replace(' ', '<br/>', $order->date) }} -->
									<strong>Przyjęto:</strong><br/>{{ date("Y-m-d", strtotime($order->date)) }} {% if ($order->deadline) %}
									<br/>
									<strong>Termin:</strong>
									<br/>{{ $order->deadline }} {% endif %} {% if ($order->finishdate) %}
									<br/>
									<strong>Zakończono:</strong>
									<br/>{{ $order->finishdate }} {% endif %}
								</td>
								<td data-label="Klient" class="ellipsis">
									<a class="btn btn-xs btn-link pull-right" title="Zobacz klienta" href="{{ url()->to('/clients', ['id'=>$order->client->id ?? null ]) }}">
										<p class="fa fa-user"></p>
									</a>
									{{ $order->client->sname ?? null}} {{ $order->client->fname ?? null }}<br/>
									<strong>{{ $order->client->company ?? null }}</strong>
									<div class="hidden-xs">
										<small>e-mail:
											<a href='mailto:{{ $order->client->email ?? null }}'>{{ $order->client->email ?? null }}</a>
											<br/>tel:
											{{ $order->client->phone ?? null }}</small>
										<br/>www:
										<a href="{{ $order->client->website ?? null }}" target="_blank">{{ $order->client->website ?? null }}</a>
										</small>
										&nbsp;</div>
								</td>
								<td data-label="Zamówienie" class="hidden-md hidden-sm ellipsis">
									<a class="btn btn-xs btn-link pull-right" title="Zobacz produkt" href="{{ url()->to('/products', ['id'=>$order->product->id ?? null ]) }}">
										<i class="fa fa-cube"></i>
									</a>
									{{ $order->product->name ?? null }}
									<br/>{{ (float)$order->qty }} {{ $order->product->unit->name ?? null }}
									<br/>Cena: {{  $order->price ? (float)$order->price : null  }} &nbsp;
								</td>
								<td data-label="Notatka" class="hidden-md hidden-sm">
									 <a class="btn btn-link btn-xs pull-right noteModal" id="noteModal" data-order="{{ $order->id }}" data-toggle="tooltip" title="Zobacz notatkę">
										 <p class="fa fa-sticky-note"></p>
									 </a>
									<div class="clamp">
										<p>{{ $order->note }}</p>
										&nbsp;
									</div>
								</td>
								<td data-label="Flagi" class="text-center hidden-md hidden-sm">
									<a class="btn btn-link btn-xs pull-right addFlag" title="Dodaj flagę" data-order="{{ $order->id }}">
									<i class="fa fa-plus"></i>
								</a> {% foreach ($order->flags as $flag) %}
									<i class="label label-pill" style="background-color: {{ $flag->color }}; margin: 5px; font-size: 80%;">{{ $flag->name }}
									<a class="confirm" href="#" data-val1="{{ $order->id }}" data-val2="{{ $flag->id }}" data-link="/api/removeFlagModal">
										<i class="glyphicon glyphicon-remove" style="color: white;"></i>
									</a>
									</i>
									{% endforeach %} &nbsp;
								</td>
								<td class="hidden-lg hidden-xs">
									<a class="btn btn-link btn-xs pull-right noteModal" id="noteModal" data-order="{{ $order->id }}" data-toggle="tooltip" title="Zobacz notatkę">
										<p class="fa fa-sticky-note"></p>
									</a>
									<div class="clamp">
										{{ $order->product->name ?? null }} {{ (float)$order->qty }} {{ $order->product->unit->name ?? null }}
										<br/>Cena: {{ $order->price ? (float)$order->price : null }}
										<br/>{{ $order->note }}</div>
									&nbsp;
								</td>
								<td>
									<a class="btn btn-info btn-xs statusModal" id="statusModal" style="width: 100%" data-order="{{ $order->id }}" data-status="{{ $order->status->id ?? null }}" data-toggle="tooltip" title="Zmień status">{{ $order->status->name ?? '###' }}</a>
								</td>
								<td class="text-right" style="min-width:100px;">
									<a class="btn btn-default btn-xs" title="Hitoria zlecenia" href="{{url()->to("/order/$order->id/statuslog")}}"><span class="glyphicon glyphicon-th-list"></span></a>
									<a class="btn btn-success btn-xs" title="Drukuj podsumowanie" href="{{url()->to("/order/$order->id/summary")}}"><span class="glyphicon glyphicon-print"></span></a>
									<a class="btn btn-info btn-xs" title="Edytuj zlecenie" href="{{url()->to("/order/$order->id")}}"><span class="glyphicon glyphicon-edit"></span></a>
								</td>
							</tr>
							{% endforeach %}
						</tbody>
					</table>
				</div>
			</div>
			<div class="panel-footer">
				<div class="text-right">
					{{ raw:$orders->getPagination()->render('chunks.pagination') }}
				</div>
			</div>
		</div>
	</div>
</div>
{{view:'chunks.modal'}}
{%endblock%}
