{% extends:'layout' %}

{%block:pageTitle%}Klienci{%endblock%}

{%block:content%}
<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s">
            <div class="panel-heading">

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-8 searchbox">
                    <form class="form form-horizontal" role='search' method="get" data-toggle="validator" action="{{$urlBuilder->to('/clients')}}">
                        <div class="input-group">
                            <input type="Search" placeholder="Szukaj..." class="form-control" id="s" name="s" data-minlength="2" value="{{$request->get('s')}}" required/>
                            <div class="input-group-btn">
                                <button class="btn btn-info">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="pull-right">
                    <a class="btn btn-default btn-xs" href="/client/create">
                        <p class="glyphicon glyphicon-new-window"></p> Nowy</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-condensed table-striped table-dynamic">
                        <thead>
                            <tr>
                                <th class="hidden-lg hidden-xs">Klient</th>
                                <th class="hidden-lg hidden-xs">Dane</th>
                                <!-- ** -->
                                <th class="hidden-md hidden-sm">Klient</th>
                                <th class="hidden-md hidden-sm">Firma</th>
                                <th class="hidden-md hidden-sm">Telefon</th>
                                <th class="hidden-md hidden-sm">E-mail</th>
                                <th class="hidden-md hidden-sm">Strona www</th>
                                <th class="text-right">Akcja</th>
                            </tr>
                        </thead>
                        <tbody>
                            {% foreach ($clients as $client)%}
                                <tr>
                                    <td class="hidden-lg hidden-xs">{{ $client->sname }} {{ $client->fname }}
                                        <br/> ({{ $client->company }})

                                    </td>
                                    <td class="hidden-lg hidden-xs"><strong>tel.: </strong>{{ $client->phone }}<br/>
                                        <strong>e-mail: </strong>{{ $client->email }}<br/>
                                        <strong>www: </strong>{{ $client->website }}
                                        </br/>
                                    </td>
                                    <!-- ** -->
                                    <td class="hidden-md hidden-sm ellipsis" data-label="Klient">{{ $client->sname ?? null }} {{ $client->fname ?? null }} &nbsp;</td>
                                    <td class="hidden-md hidden-sm ellipsis" data-label="Firma">{{ $client->company ?? null }} &nbsp;</td>
                                    <td class="hidden-md hidden-sm ellipsis" data-label="Telefon">{{ $client->phone ?? null }} &nbsp;</td>
                                    <td class="hidden-md hidden-sm ellipsis" data-label="E-mail"><a href="mailto:{{ $client->email ?? null }}">{{ $client->email ?? null }} &nbsp;</a></td>
                                    <td class="hidden-md hidden-sm ellipsis" data-label="Strona www"><a href="{{ $client->website ?? null }}" target="_blank">{{ $client->website ?? null }} &nbsp;</a></td>
                                    <td data-label="" class="text-right">
                                        <a class="btn btn-success btn-xs" href="{{ $urlBuilder->to('/orders', ['client'=>$client->id ?? null]) }}"><span class="glyphicon glyphicon-list"></span> Zlecenia <span class="badge">{{$client->ordersCount}}</span></a>
                                        <a class="btn btn-info btn-xs" href="{{ $urlBuilder->to('/client/'.$client->id ?? null) }}"><span class="glyphicon glyphicon-edit" alt="Edytuj" data-toggle="tooltip" title="Edytuj"></span></a>
                                        <a class="confirm btn btn-danger btn-xs" href="#" data-val1="{{ $client->id ?? null }}" data-link="/api/clientDeleteModal" data-toggle="tooltip" title="Usuń"><span class="fa fa-times"></span></a>
                                    </td>
                                </tr>
                            {% endforeach %}

                        </tbody>
                    </table>
                </div>
            </div>
            <div class="panel-footer">
                <div class="text-right">
                    {{ raw:$clients->getPagination()->render('chunks.pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>

{{ view:'chunks.modal' }}
{%endblock%}
