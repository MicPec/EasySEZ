{% extends:'layout' %}

{%block:pageTitle%}Statuslog{%endblock%}

{%block:content%}
<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s">
            <div class="panel-heading">
                Historia zlecenia #{{ $statuslog[0]->order->id}}
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-condensed table-responsive table-dynamic">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Status</th>
                            <th>Komentaż</th>
                            <th>Użytkownik</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% foreach ($statuslog as $log) %}
                        <tr>
                            <td data-label="Data">{{ $log->date }}</td>
                            <td data-label="Status" class='ellipsis'>{{ $log->status }}</td>
                            <td data-label="Komentaż" class='ellipsis'>{{ $log->comment }}</td>
                            <td data-label="Użytkownik" class='ellipsis'>{{ $log->username }}</td>
                        </tr>
                        {% endforeach %}
                    </tbody>
                </table>

            </div>
            <div class="panel-footer">
                <div class="text-right">
                    {#{ raw:$statuslog->getPagination()->render('chunks.pagination') }#}
                </div>
            </div>
        </div>
    </div>
</div>

{%endblock%}
