{% extends:'layout' %}

{%block:pageTitle%}Statusy{%endblock%}

{%block:content%}
<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s">
            <div class="panel-heading">
                <div class="pull-right">
                    <a class="btn btn-default btn-xs" href="{{$urlBuilder->to('/status/create')}}">
                        <p class="glyphicon glyphicon-new-window"></p> Nowy</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-condensed table-responsive table-dynamic">
                    <thead>
                        <tr>
                            <!-- <th>id</th> -->
                            <th>Nazwa</th>
                            <th>Kolor</th>
                            <th>Stan</th>
                            <th class="text-right">Akcja</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% foreach ($statuses as $status) %}
                            <tr>
                                <td data-label="Nazwa">{{ $status->name }}</td>
                                <td data-label="Kolor" style="background-color: {{ $status->color }}">{{ $status->color }}</td>
                                <td data-label="Stan" class="text-center">{{ $status->state->name ?? null }}</td>
                                <td data-label="" class="text-right"><a class="btn btn-info btn-xs" href="{{$urlBuilder->to("/status/$status->id")}}" data-toggle="tooltip" title="Edytuj"><span class="glyphicon glyphicon-edit"></span></a>
                                  <a class="confirm btn btn-danger btn-xs" href="#" data-val1="{{ $status->id }}" data-link="/api/statusDeleteModal" data-toggle="tooltip" title="Usuń"><span class="fa fa-times"></span></a>
                                </td>
                            </tr>
{% endforeach %}
                    </tbody>
                </table>

            </div>
            <div class="panel-footer">
                <div class="text-right">
                    {{ raw:$statuses->getPagination()->render('chunks.pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>
{{ view:'chunks.modal' }}
{%endblock%}
