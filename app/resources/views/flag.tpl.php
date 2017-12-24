{% extends:'layout' %}

{%block:pageTitle%}Edycja flagi{%endblock%}

{%block:content%}
<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s">
            <div class="panel-heading">
                {%if(isset($flag)) %}
                    Edytuj
                {%else%}
                    Dodaj
                {%endif%} flagę
            </div>

            <div class="panel-body">

                <form class="form-horizontal" role="form" method="post" action="{{isset($flag)?$urlBuilder->to("/flag/$flag->id"):$urlBuilder->to('/flag/create')}}" data-toggle="validator">
                    <input type="hidden" name="REQUEST_METHOD_OVERRIDE" value="PUT">
                    <input type="hidden" name="csrf_token" value="{{$session->generateOneTimeToken()}}">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="name" class="control-label">Nazwa</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" maxlength="32" data-error="Pole wymagane!" class="form-control" id="name" name="name" placeholder="Nazwa" value='{{isset($flag)?$flag->name:null}}' required/>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="color" class="control-label">Kolor</label>
                        </div>
                        <div class="col-sm-10">
                            <div id='color' class="input-group colorpicker-component">
                                <input type="text" maxlength="32" data-error="Pole wymagane!" class="form-control" name="color" placeholder="Kolor" value='{{isset($flag)?$flag->color:null}}' required />
                                <span class="input-group-addon"><i></i></span></div>
                            <div class="help-block with-errors"></div>
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
