{% extends:'layout' %}

{%block:pageTitle%}Podsumowanie{%endblock%}

{%block:content%}
<div class="row">
    <div class="col-sm-12">
        <div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s">
            <div class="panel-heading">
                <div class="pull-right">
                    <a class="btn btn-default btn-xs" id="btn-print">
                        <p class="glyphicon glyphicon-print"></p> Drukuj</a>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="panel-body">
                <div class="container-fluid">
                    <div class="col-sm-12" id="summary">
                        <div class="row">
                            <div class="col-xs-6 small">{{APP_NAME}} - {{APP_VERSION}}</div>
                            <div class="col-xs-6 text-right small">{{date("Y-m-d H:i:s")}}</div>
                        </div>
                        <h2>Podsumowanie: Zlecenie #{{$order->id ?? null}}</h2>
                        <hr/>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-condensed table-responsive table-striped table-dynamic">
                                    <thead class="alert-danger">
                                        <tr>
                                            <th class="text-left">Data przyjęcia</th>
                                            <th class="text-center">Termin</th>
                                            <th class="text-right">Data zakończenia</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td data-label="Data przyjęcia" class="text-left">{{ $order->date ?? null }}&nbsp;</td>
                                            <td data-label="Termin" class="text-center">{{ $order->deadline ?? null }}&nbsp;</td>
                                            <td data-label="Data zakończenia" class="text-right">{{ $order->finishdate ?? null }}&nbsp;</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr/>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <table class="table table-condensed table-responsive table-striped table-dynamic_">
                                    <thead class="alert-success">
                                        <tr>
                                            <th class="bigandbold">Klient</th>
                                            <th class="text-right"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="bigandbold">Nazwa</td>
                                            <td class="text-right">{{ $order->client->sname ?? null }} {{ $order->client->fname ?? null }}

                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="bigandbold">Firma</td>
                                            <td class="text-right">
                                                {{ $order->client->company ?? null }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bigandbold">Tel.</td>
                                            <td class="text-right">{{ $order->client->phone ?? null }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bigandbold">E-mail</td>
                                            <td class="text-right">{{ $order->client->email ?? null }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bigandbold">WWW</td>
                                            <td class="text-right">{{ $order->client->website ?? null }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr />
                            </div>

                            <div class="col-sm-6">
                                <table class="table table-condensed table-responsive">
                                    <thead class="alert-info">
                                        <tr>
                                            <th class="bigandbold">Produkt</th>
                                            <th class="text-right"></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="bigandbold">Nazwa</td>
                                            <td class="text-right">{{ $order->product->name ?? null }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bigandbold">Ilość</td>
                                            <td class="text-right">{{ $order->qty ?? null }} {{ $order->product->unit->name ?? null }}</td>
                                        </tr>
                                        <tr>
                                            <td class="bigandbold">Cena</td>
                                            <td class="text-right">{{ $order->price ?? null }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr />
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <p class="bigandbold">Notatka: </p>
                                <pre>{{$order->note ?? null }}</pre>
                                <hr />
                            </div>
                            <div class="col-md-6">
                                <h5><span class="bigandbold">STATUS: </span>{{ $order->status->name ?? null }}</h5>
                                <table class="table table-striped table-condensed table-responsive table-dynamic">
                                    <thead class="alert-warning">
                                        <tr>
                                            <th>Data</th>
                                            <th>Status</th>
                                            <th>Komentaż</th>
                                            <th>Użytkownik</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            {%foreach ($order->statusLog as $log) %}
                                            <tr>
                                                <td data-label="Data">{{ $log->date }}</td>
                                                <td data-label="Status" class='ellipsis'>{{ $log->status }}</td>
                                                <td data-label="Komentaż" class='ellipsis'>{{ $log->comment }}</td>
                                                <td data-label="Użytkownik" class='ellipsis'>{{ $log->username }}</td>
                                            </tr>
                                            {%endforeach%}
                                    </tbody>
                                </table>
                                <hr />
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{%endblock%}
