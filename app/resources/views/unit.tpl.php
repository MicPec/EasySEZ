{% extends:'layout' %}

{%block:pageTitle%}Edycja Jednostki{%endblock%}

{%block:content%}
<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s">
            <div class="panel-heading">
                {%if(isset($unit)) %}
                    Edytuj
                {%else%}
                    Dodaj
                {%endif%} jednostkę
            </div>

            <div class="panel-body">

                <form class="form-horizontal" role="form" method="post" action="{{isset($unit)?url()->to("/unit/$unit->id"):url()->to('/unit/create')}}" data-toggle="validator">
                    <input type="hidden" name="REQUEST_METHOD_OVERRIDE" value="PUT">
                    <input type="hidden" name="csrf_token" value="{{one_time_token()}}">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="name" class="control-label">Nazwa</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" maxlength="128" class="form-control" id="name" name="name" placeholder="Nazwa" value='{{isset($unit)?$unit->name:null}}' required>
                        </div>
                    </div>

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
