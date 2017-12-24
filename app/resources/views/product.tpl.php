{% extends:'layout' %}

{%block:pageTitle%}Edycja Produktu{%endblock%}

{%block:content%}
<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s">
            <div class="panel-heading">
                {%if(isset($product)) %}
                    Edytuj
                {%else%}
                    Dodaj
                {%endif%} produkt
            </div>

            <div class="panel-body">

                <form class="form-horizontal" role="form" method="post" action="{{isset($product)?$urlBuilder->to("/product/$product->id"):$urlBuilder->to('/product/create')}}" data-toggle="validator">
                    <input type="hidden" name="REQUEST_METHOD_OVERRIDE" value="PUT">
                    <input type="hidden" name="csrf_token" value="{{$session->generateOneTimeToken()}}">
                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="name" class="control-label">Nazwa</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" maxlength="128" class="form-control" id="name" name="name" placeholder="Nazwa" value='{{isset($product)?$product->name:null}}' required>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="unit" class="control-label">Jednostka</label>
                        </div>
                        <div class="col-sm-10">
                            <select class="ajaxselect form-control" data-ajax--url="/api/getUnits" data-dropdown-parent="" data-placeholder="Wybierz jednostkę" id="unit_id" name="unit_id" required>
                                {% if(isset($product)) %}
                                    <option value='{{$product->unit->id ?? null}}'>{{$product->unit->name ?? null}}</option>
                                {% else %}
                                    <option></option>
                                {% endif %}
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-2">
                            <label for="unitprice" class="control-label">Cena jednostkowa</label>
                        </div>
                        <div class="col-sm-10">
                            <input type="text" pattern="([0-9]*[.])?[0-9]+" autocomplete="off" class="form-control" id="unitprice" name="unitprice" placeholder="Wprowadź cenę" value='{{ $product->unitprice ?? null }}' data-error="Wprowadź prawidłową wartość!">
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
