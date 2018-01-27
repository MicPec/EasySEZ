<!-- Navigation -->
<nav class="navbar navbar-default navbar-fixed-top navbar-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-expand-toggle">
                <i class="fa fa-bars icon"></i>
            </button>
            <ol class="breadcrumb navbar-breadcrumb">
                <li>{{APP_NAME}}</li>
                <li class="active">{{ block:pageTitle }}Dashboard{{ endblock }}</li>
            </ol>

            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                <i class="fa fa-th icon"></i>
            </button>
        </div>
        <ul class="nav navbar-nav navbar-right">
            <button type="button" class="navbar-right-expand-toggle pull-right visible-xs">
                <i class="fa fa-times icon"></i>
            </button>
            <li class="clock btn btn-toolbar btn-link"></li>
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-comments-o"></i></a>
                <ul class="dropdown-menu animated fadeInDown">
                    <li class="title">
                        Notification <span class="badge pull-right">0</span>
                    </li>
                    <li class="message">
                        No new notification
                    </li>
                </ul>
            </li>
            <li class="dropdown danger">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><i class="fa fa-star-half-o"></i> 4</a>
                <ul class="dropdown-menu danger  animated fadeInDown">
                    <li class="title">
                        Notification <span class="badge pull-right">4</span>
                    </li>
                    <li>
                        <ul class="list-group notifications">
                            <a href="#">
                                <li class="list-group-item">
                                    <span class="badge">1</span> <i class="fa fa-exclamation-circle icon"></i> new registration
                                </li>
                            </a>
                            <a href="#">
                                <li class="list-group-item">
                                    <span class="badge success">1</span> <i class="fa fa-check icon"></i> new orders
                                </li>
                            </a>
                            <a href="#">
                                <li class="list-group-item">
                                    <span class="badge danger">2</span> <i class="fa fa-comments icon"></i> customers messages
                                </li>
                            </a>
                            <a href="#">
                                <li class="list-group-item message">
                                    view all
                                </li>
                            </a>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="dropdown profile">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ user()->username }} <span class="caret"></span></a>
                <ul class="dropdown-menu animated fadeInDown">
                    <li class="profile-img">
                        <img src="/assets/img/user.png" class="profile-img">
                    </li>
                    <li>
                        <div class="profile-info">
                            <h4 class="username">{{ user()->username }}</h4>
                            <small>{{ user()->email }}</small>
                            <div class="btn-group-vertical margin-bottom-2x" role="group">
                                <a type="button" class="btn btn-default" href="/user/profile"><i class="fa fa-user"></i> Profil</a>
                                <a type="button" class="btn btn-default" href="/logout"><i class="fa fa-sign-out"></i> Wyloguj</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
</nav>

<!-- *******************************  SIDEBAR  ************************ -->

<div class="side-menu sidebar-inverse">
    <nav class="navbar navbar-default" role="navigation">
        <div class="side-menu-container">
            <div class="navbar-header">
                <a class="navbar-brand" href="{{ url()->base() }}">
                    <div class="icon fa fa-cloud"></div>
                    <div class="title">{{ APP_NAME }}</div>
                </a>
                <button type="button" class="navbar-expand-toggle pull-right visible-xs">
                    <i class="fa fa-times icon"></i>
                </button>
            </div>
            <ul class="nav navbar-nav">
              <li>
                  <a href="{{ url()->base() }}">
                      <span class="icon fa fa-tachometer"></span><span class="title">Dashboard</span>
                  </a>
              </li>
              <!-- calendar -->
                <li>
                    <a href="{{ url()->to('\calendar') }}">
                        <span class="icon fa fa-calendar"></span><span class="title">Kalendarz</span>
                    </a>
                </li>
                <!-- zlecenia -->
                <li class="panel panel-default dropdown">
                    <a data-toggle="collapse" href="#dropdown-table">
                        <span class="icon fa fa-inbox"></span><span class="title">Zlecenia</span>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-table" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li><a href="{{ url()->to('\orders') }}">Zarządzaj</a>
                                </li>
                                <li><a href="{{ url()->to('\order\create') }}">Dodaj nowe</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <!-- klienci -->
                <li class="panel panel-default dropdown">
                    <a data-toggle="collapse" href="#dropdown-table2">
                        <span class="icon fa fa-users"></span><span class="title">Klienci</span>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-table2" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li><a href="{{ url()->to('\clients') }}">Zarządzaj</a>
                                </li>
                                <li><a href="{{ url()->to('\client\create') }}">Nowy Klient</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <!-- produkty -->
                <li class="panel panel-default dropdown">
                    <a data-toggle="collapse" href="#dropdown-table3">
                        <span class="icon fa fa-cubes"></span><span class="title">Produkty</span>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-table3" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li><a href="{{ url()->to('\products') }}">Zarządzaj</a>
                                </li>
                                <li><a href="{{ url()->to('\product\create') }}">Nowy Produkt</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <!-- settings -->
                <li class="panel panel-default dropdown">
                    <a data-toggle="collapse" href="#dropdown-table4">
                        <span class="icon fa fa-cog"></span><span class="title">Opcje</span>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-table4" class="panel-collapse collapse">
                        <div class="panel-body">
                            <ul class="nav navbar-nav">
                                <li><a href="{{ url()->to('\units') }}"><i class="fa fa-list fa-fw"></i> Jednostki</a>
                                </li>
                                <li>
                                    <a href="{{ url()->to('\statuses') }}"><i class="fa fa-sort-amount-desc fa-fw"></i> Statusy</a>
                                </li>
                                <li>
                                    <a href="{{ url()->to('\flags') }}"><i class="fa fa-flag fa-fw"></i> Flagi</a>
                                </li>
                                <check if="{{@useradmin}}">
                                    <li>
                                        <a href="{{ url()->to('\users') }}"><i class="fa fa-user fa-fw"></i> Użytkownicy</a>
                                    </li>
                                </check>
                            </ul>
                        </div>
                    </div>
                </li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>
</div>
