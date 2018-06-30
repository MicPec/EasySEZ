<div class="form-group">
    <button class="btn btn-xs btn-link" type="button" data-toggle="collapse" data-target="#collapse" aria-expanded="false" aria-controls="collapseExample">
        <span class="glyphicon glyphicon-filter"></span>Filtr</button>
        {%if (request()->getQuery() != null && request()->getQuery()->blacklisted(['page']) != null  )%}
        <a href="{{url()->to('/orders')}}">
            <div class="label label-danger label-pill">
                Reset <span class="fa fa-times"></span>
            </div>
        </a>
        {%endif%}&nbsp|
        <a class="btn btn-xs btn-link" href="/orders?qf=new">Nowe</a>
        <a class="btn btn-xs btn-link" href="/orders?qf=inprogress">W trakcie realizacji</a>
        <a class="btn btn-xs btn-link" href="/orders?user={{user()->id}}">Przyjęte przez Ciebie</a>
        <a class="btn btn-xs btn-link" href="/orders?qf=today">Przyjęte dzisiaj</a>
        <a class="btn btn-xs btn-link" href="/orders?qf=thisweek">Przyjęte w tym tygodniu</a>
        <a class="btn btn-xs btn-link" href="/orders?qf=thismonth">Przyjęte w tym miesiącu</a>
    <div class="collapse" id="collapse">
        <div class="well">

            <form class="form-horizontal" name="filter_orders" action="{{url()->to('/orders')}}" data-toggle="validator">

                <div class="form-group col-md-6">
                    <label class="control-label col-md-4" for="client">Klient</label>
                    <div class="col-md-8">
                        <select class="ajaxselect form-control" data-ajax--url="/api/getClients" data-dropdown-parent="" type="text" name="client" id="client">
                            <option></option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="control-label col-md-4" for="status">Status</label>
                    <div class="col-md-8">
                        <select class="ajaxselect form-control" data--minimumResultsForSearch="10" data-dropdown-parent="" data-ajax--url="/api/getStatuses" type="text" name="status" id="status">
                            <option></option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="control-label col-md-4" for="product">Produkt</label>
                    <div class="col-md-8">
                        <select class="ajaxselect form-control" data-ajax--url="/api/getProducts" data-dropdown-parent="" type="text" name="product" id="product">
                            <option></option>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="control-label col-md-4" for="flag">Flaga</label>
                    <div class="col-md-8">
                        <select class="ajaxselect form-control" data-ajax--url="/api/getFlags" data-dropdown-parent="" type="text" name="flag" id="flag">
                            <option></option>

                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label class="control-label col-md-4" for="user">Użytkownik</label>
                    <div class="col-md-8">
                        <select class="ajaxselect form-control" data-ajax--url="/api/getUsers" data-dropdown-parent="" type="text" name="user" id="user">
                            <option></option>
                        </select>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="form-group col-md-6">
                        <label class="col-md-4 control-label" for="input-daterange">Data przyjęcia</label>
                        <div class="input-daterange input-group col-md-8" id="datepicker" data-date-format="yyyy-mm-dd">
                            <input type="text" class="input form-control col-md-2" name="datefrom" pattern="(19|20)\d\d-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])" />
                            <span class="input-group-addon">do</span>
                            <input type="text" class="input form-control" name="dateto" pattern="(19|20)\d\d-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])" />
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="col-md-4 control-label" for="input-daterange">Termin</label>
                        <div class="input-daterange input-group col-md-8" id="datepicker" data-date-format="yyyy-mm-dd">
                            <input type="text" class="input form-control col-md-2" name="deadlinefrom" pattern="(19|20)\d\d-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])" />
                            <span class="input-group-addon">do</span>
                            <input type="text" class="input form-control" name="deadlineto" pattern="(19|20)\d\d-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])" />
                        </div>
                    </div>

                    <div class="form-group col-md-6">
                        <label class="col-md-4 control-label" for="datepicker">Data zakończenia</label>
                        <div class="input-daterange input-group col-md-8" id="datepicker" data-date-format="yyyy-mm-dd">
                            <input type="text" class="input form-control col-md-2" name="fdatefrom" pattern="(19|20)\d\d-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])" />
                            <span class="input-group-addon">do</span>
                            <input type="text" class="input form-control" name="fdateto" pattern="(19|20)\d\d-(0[1-9]|1[0-2])-(0[1-9]|[12][0-9]|3[01])" />
                        </div>
                    </div>
                </div>

                <div class="col-md-2 pull-right">
                    <button id="submit" type="submit" value="submit" class="btn btn-danger pull-right">Filtruj</button>
                </div>
                <div class="clearfix">

                </div>
            </form>
        </div>
        <!--  well -->

    </div>
    <!--  collapse -->

</div>
