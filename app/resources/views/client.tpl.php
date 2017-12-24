{% extends:'layout' %}

{%block:pageTitle%}Edycja Klienta{%endblock%}

{%block:content%}
<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s">
            <div class="panel-heading">
                {%if (isset($client)) %}
                    Edytuj
                {%else%}
                    Dodaj
                {%endif%} klienta
            </div>

            <div class="panel-body">

                <form class="form-horizontal" role="form" method="post" action="{{isset($client)?$urlBuilder->to("/client/$client->id"):$urlBuilder->to('/client/create')}}" data-toggle="validator">
                    <input type="hidden" name="REQUEST_METHOD_OVERRIDE" value="PUT">
                    <input type="hidden" name="csrf_token" value="{{$session->generateOneTimeToken()}}">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="fname" class="control-label">Imię</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" maxlength="128" class="form-control" id="fname" name="fname" placeholder="Imię" value='{{isset($client)?$client->fname:null}}'>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="sname" class="control-label">Nazwisko</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" maxlength="128" data-error="Pole wymagane!" class="form-control" id="sname" name="sname" placeholder="Nazwisko" value='{{isset($client)?$client->sname:null}}' required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="company" class="control-label">Firma</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" maxlength="255" class="form-control" id="company" name="company" placeholder="Firma" value='{{isset($client)?$client->company:null}}'>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="phone" class="control-label">Telefon</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" maxlength="128" data-error="Pole wymagane!" class="form-control" id="phone" name="phone" placeholder="nr tel." value='{{isset($client)?$client->phone:null}}' required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="email" class="control-label">E-mail</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="email" maxlength="255" data-error="Wprowadź prawidłowy e-mail!" class="form-control" id="email" name="email" placeholder="E-mail" value='{{isset($client)?$client->email:null}}' required>
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="website" class="control-label">Strona www</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" maxlength="255" pattern="https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)" class="form-control" id="website" name="website" data-error="Wprowadź prawidłowy adres! (np.: http://strona.pl)" placeholder="Adres www" value='{{isset($client)?$client->website:null}}'>
                        <div class="help-block with-errors"></div></div>
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
