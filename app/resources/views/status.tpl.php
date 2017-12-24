{% extends:'layout' %}

{%block:pageTitle%}Edycja Statusu{%endblock%}

{%block:content%}
<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s">
            <div class="panel-heading">
                {%if(isset($status)) %}
                    Edytuj
                {%else%}
                    Dodaj
                {%endif%} status
            </div>

            <div class="panel-body">

                <form class="form-horizontal" role="form" method="post" action="{{isset($status)?$urlBuilder->to("/status/$status->id"):$urlBuilder->to('/status/create')}}" data-toggle="validator">
                    <input type="hidden" name="REQUEST_METHOD_OVERRIDE" value="PUT">
                    <input type="hidden" name="csrf_token" value="{{$session->generateOneTimeToken()}}">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="name" class="control-label">Nazwa</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" maxlength="64" data-error="Pole wymagane!" class="form-control" id="name" name="name" placeholder="Nazwa" value='{{isset($status)?$status->name:null}}' required/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="color" class="control-label">Kolor</label>
                        </div>
                        <div class="col-sm-10">
                            <div id='color' class="input-group colorpicker-component">
                                <input type="text" maxlength="32" data-error="Pole wymagane!" class="form-control" name="color" placeholder="Kolor" value='{{isset($status)?$status->color:null}}' />
                                <span class="input-group-addon"><i></i></span>
                            </div>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="color" class="control-label">Stan</label>
                        </div>
                        <div class="col-sm-10">
                            <select class="ajaxselect form-control" data--minimumResultsForSearch="10" data-dropdown-parent="" data-ajax--url="/api/getStates" data-placeholder="Wybierz status" type="text" name="state_id" id="state_id">
                                {% if(isset($status) && $status->state) %}
                                <option value='{{$status->state->id}}'>{{$status->state->name}}</option>
                                {% else %}
                                <option></option>
                                {% endif %}
                            </select>
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
