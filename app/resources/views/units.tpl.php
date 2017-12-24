{% extends:'layout' %}

{%block:pageTitle%}Jednostki{%endblock%}

{%block:content%}
<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s">
            <div class="panel-heading">
                <div class="pull-right">
                    <a class="btn btn-default btn-xs" href="{{$urlBuilder->to('/unit/create')}}">
                        <p class="glyphicon glyphicon-new-window"></p> Nowa</a>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-condensed table-responsive table-dynamic">
                        <thead>
                            <tr>
                                <th>Jednostka</th>
                                <th class="text-right">Akcja</th>
                            </tr>
                        </thead>
                        <tbody>
                            {% foreach ($units as $unit) %}
                                <tr>
                                    <td data-label="Jednostka">{{ $unit->name }}</td>
                                    <td data-label="" class="text-right"><a class="btn btn-info btn-xs" href="{{ $urlBuilder->to("/unit/$unit->id") }}"><span class="glyphicon glyphicon-edit"></span></a>
                                      <a class="confirm btn btn-danger btn-xs" href="#" data-val1="{{ $unit->id }}" data-link="/api/unitDeleteModal" data-toggle="tooltip" title="Usuń"><span class="fa fa-times"></span></a>
                                    </td>
                                </tr>
                            {%endforeach%}

                        </tbody>
                    </table>

                </div>
                <div class="panel-footer">
                    <div class="text-right">
                        {{ raw:$units->getPagination()->render('chunks.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ view:'chunks.modal' }}
    {%endblock%}
