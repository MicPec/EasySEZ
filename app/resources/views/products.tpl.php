{% extends:'layout' %}

{%block:pageTitle%}Produkty{%endblock%}

{%block:content%}
<div class="row">
    <div class="col-sm-12">

        <div class="panel panel-primary fresh-color wow bounceInUp" data-wow-duration=".5s">
            <div class="panel-heading">

                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-8 searchbox">
                    <form class="form form-horizontal" role='search' method="get" data-toggle="validator" action=""{{ url()->to('/products') }}">
                        <div class="input-group">
                            <input type="Search" placeholder="Szukaj..." class="form-control" id="s" name="s" data-minlength="2" value="{{ request()->getQuery()->get('s') }}" required/>
                            <div class="input-group-btn">
                                <button class="btn btn-info">
                                    <span class="glyphicon glyphicon-search"></span>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="pull-right">
                    <a class="btn btn-default btn-xs" href="{{ url()->to('/product/create') }}">
                        <p class="glyphicon glyphicon-new-window"></p> Nowy</a>
                </div>
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">
                <table class="table table-striped table-condensed table-responsive table-dynamic">
                    <thead>
                        <tr>
                            <th>Nazwa</th>
                            <th>Jednostka</th>
                            <th>Cena jedn.</th>
                            <th class="text-right">Akcja</th>
                        </tr>
                    </thead>
                    <tbody>
                        {% foreach ($products as $product) %}
                            <tr>
                                <td data-label="Nazwa">{{ $product->name }}</td>
                                <td data-label="Jednostka">{{ $product->unit->name ?? null }}</td>
                                <td data-label="Cena jedn.">{{ $product->unitprice ? (float)$product->unitprice : null}}</td>
                                <td data-label="" class="text-right">
                                    <a class="btn btn-success btn-xs" href="/orders?product={{ $product->id }}"><span class="glyphicon glyphicon-list"></span> Zlecenia <span class="badge">{{ $product->ordersCount }}</span></a>
                                    <a class="btn btn-info btn-xs" href="{{ url()->to("/product/$product->id") }}" data-toggle="tooltip" title="Edytuj"><span class="glyphicon glyphicon-edit"></span></a>
                                    <a class="confirm btn btn-danger btn-xs" href="#" data-val1="{{ $product->id }}" data-link="/api/productDeleteModal" data-toggle="tooltip" title="Usuń"><span class="fa fa-times"></span></a>
                                </td>
                            </tr>
                        {% endforeach %}

                    </tbody>
                </table>

            </div>
            <div class="panel-footer">
                <div class="text-right">
                    {{ raw:$products->getPagination()->render('chunks.pagination') }}
                </div>
            </div>
        </div>
    </div>
</div>

{{ view:'chunks.modal' }}
{%endblock%}
