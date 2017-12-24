{% extends:'layout' %}

{%block:pageTitle%}Edycja zlecenia{%endblock%}

{%block:content%}
<div class="row">
	<div class="col-sm-12">

		<div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s">
			<div class="panel-heading">
				{% if(isset($order)) %}
         Edytuj zlecenie #{{isset($order)?$order->id:null}}
         {% else %} Dodaj zlecenie {% endif %}
			</div>

			<div class="panel-body">

				<form class="form-horizontal" role="form" method="post" action="{{ isset($order) ? $urlBuilder->to("/order/$order->id") : $urlBuilder->to('/order/create') }}" data-toggle="validator">
					<input type="hidden" name="REQUEST_METHOD_OVERRIDE" value="PUT">
					<input type="hidden" name="csrf_token" value="{{$session->generateOneTimeToken()}}">

					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<div class="col-sm-2">
								<label for="client" class="control-label">Klient</label>
							</div>
							<div class="col-sm-10">
								<select class="ajaxselect form-control" data-ajax--url="/api/getClients" data-dropdown-parent="" id="client" name="client_id" placeholder="Wybierz klienta" required>
                                    {% if(isset($order)) %}
                                    <option value='{{ $order->client->id ?? null }}'>{{ $order->client->sname ?? null }} {{ $order->client->fname ?? null }} ({{ $order->client->company ?? null }})</option>
                                    {% else %}
                                    <option></option>
                                    {% endif %}
                                </select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-2">
								<label for="product" class="control-label">Produkt</label>
							</div>
							<div class="col-sm-10">
								<select class="ajaxselect form-control" data-ajax--url="/api/getProducts" data-dropdown-parent="" id="product" name="product_id" required>
                                    {% if(isset($order)) %}
                                    <option value='{{ $order->product->id ?? null }}' data-uprice="{{ $order->product->unitprice ?? null }}">{{ $order->product->name ?? null }} ({{$order->product->unit->name ?? null }})</option>
                                    {% else %}
                                    <option></option>
                                    {% endif %}
                                </select>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-2">
								<label for="qty" class="control-label">Ilość</label>
							</div>
							<div class="col-sm-10">
								<input type="text" pattern="([0-9]*[.])?[0-9]+" autocomplete="off" class="form-control" id="qty" name="qty" placeholder="Wprowadź ilość" value="{{ $order->qty ?? null}}" data-error="Wprowadź prawidłową wartość!">
								<div class="help-block with-errors"></div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-2">
								<label for="price" class="control-label">Cena</label>
							</div>
							<div class="col-sm-10">
								<input type="text" pattern="([0-9]*[.])?[0-9]+" autocomplete="off" class="form-control" id="price" name="price" placeholder="Wprowadź cenę" value='{{ $order->price ?? "" }}' data-error="Wprowadź prawidłową wartość!"> {#
								<p id="uprice">Sugerowana cena: {{round($order->product->unitprice*$order->qty,2)}}</p>#}
								<div class="help-block with-errors"></div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-sm-2">
								<label for="deadline" class="control-label">Termin</label>
							</div>
							<div class="col-sm-10">
								<input type="text" pattern="(19|20)\d\d-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])" data-date-format="yyyy-mm-dd" autocomplete="off" class="form-control datepicker" id="deadline" name="deadline" value='{{ $order->deadline ?? null }}' data-error="Wprowadź prawidłową datę!">
								<div class="help-block with-errors"></div>
							</div>
						</div>
					</div>

					<!-- <div class="row"> -->
					<div class="col-md-6 col-sm-12">
						<div class="form-group">
							<div class="col-sm-2">
								<label for="note" class="control-label">Notatka</label>
							</div>
							<div class="col-sm-12">
								<textarea type="text" class="form-control" id="note" name="note" rows="8" placeholder="Opis zlecenia">{{ $order->note ?? null }}</textarea>
							</div>
						</div>
					</div>
					<!-- </div> -->

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
