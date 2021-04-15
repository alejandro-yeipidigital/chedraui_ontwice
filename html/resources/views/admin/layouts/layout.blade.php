<!DOCTYPE html>
<html lang="es_MX">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>CMS | Chile | Summer</title>

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/lib/perfect-scrollbar/css/perfect-scrollbar.css')  }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/lib/material-design-icons/css/material-design-iconic-font.min.css')  }}"/>

        <link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/lib/jquery.codemirror/lib/codemirror.css')  }}"/>
        <link rel="stylesheet" type="text/css" href="{{ asset('assets_admin/lib/jquery.codemirror/theme/monokai.css')  }}"/>

        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ asset('assets_admin/css/app.css')  }}" type="text/css"/>
        <link rel="stylesheet" href="{{ asset('assets_admin/css/custom.css')  }}" type="text/css"/>
        <link rel="stylesheet" href="{{ asset('assets_admin/css/conversation.css')  }}" type="text/css"/>
    </head>

    <!-- Authentication Links -->
@guest('admin')
    <body class="be-splash-screen">
        @yield('content')
@else
    <body>
        <div class="be-wrapper be-fixed-sidebar">
            <nav class="navbar navbar-expand fixed-top be-top-header">
                <div class="container-fluid">
                    <div class="be-navbar-header"><a class="navbar-brand" href="{{ url('/admin') }}"></a></div>
                    <div class="be-right-navbar">
                        <ul class="nav navbar-nav float-right be-user-nav">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false">
                                    <img src="{{ asset('assets_admin/img/avatar7.png') }}" alt="Avatar"><span class="user-name">{{ Auth::guard('admin')->user()->name }}</span>
                                </a>
                                <div class="dropdown-menu" role="menu">
                                <div class="user-info">
                                <div class="user-name">{{ Auth::guard('admin')->user()->name }}</div>
                                <div class="user-position online">Disponible</div>
                                </div>
                                    <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                        <span class="icon mdi mdi-power"></span>Cerrar Sesión
                                    </a>

                                    <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </li>
                        </ul>
                        <div class="page-title"><span>CMS | Saladitas Cuaresma</span></div>
                        <ul class="nav navbar-nav float-right be-icons-nav"></ul>
                    </div>
                </div>
            </nav>
            <div class="be-left-sidebar">
                <div class="left-sidebar-wrapper"><a class="left-sidebar-toggle" href="#">Menú</a>
                    <div class="left-sidebar-spacer">
                        <div class="left-sidebar-scroll">
                            <div class="left-sidebar-content">
                                <ul class="sidebar-elements">
                                    <li class="divider">Menú</li>
                                    @if (\Auth::user()->role_id == 4 ) <!--Condición para administrador role=4-->
                                    {{-- Muestra solo inicio, reportes y cerrar sesión --}}
                                    <li class="{{ request()->path() == 'admin' ? 'active' : '' }}">
                                        <a href="{{ url('/admin/home')  }}">
                                            <i class="icon mdi mdi-home"></i>
                                            <span>Inicio</span>
                                        </a>
                                    </li>
                                    
                                    <li class="{{ request()->path() == 'admin' ? 'active' : '' }}">
                                        <a href="{{ url('/admin/reportes')  }}">
                                            <i class="icon mdi mdi-folder"></i>
                                            <span>Reportes</span>
                                        </a>
                                    </li> 
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                            <span class="icon mdi mdi-power"></span>Cerrar Sesión
                                        </a>
                                    
                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li> 
                        
                                    @else 
                                    {{-- Muestra todo el menú --}}
                                    <li class="{{ request()->path() == 'admin' ? 'active' : '' }}">
                                        <a href="{{ url('/admin/home')  }}">
                                            <i class="icon mdi mdi-home"></i>
                                            <span>Inicio</span>
                                        </a>
                                    </li>
                                    
                                    <li class="{{ request()->path() == 'admin' ? 'active' : '' }}">
                                        <a href="{{ url('/admin/reportes')  }}">
                                            <i class="icon mdi mdi-folder"></i>
                                            <span>Reportes</span>
                                        </a>
                                    </li>        
                        
                                    @can('accessQueries', \App\Models\Admin::class)
                                        <li class="{{ request()->segment(2) == 'querys' ? 'active' : '' }}">
                                            <a href="{{ url('admin/querys') }}">
                                                <i class="icon mdi mdi-search-in-page"></i>
                                                <span>Consultas</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('accessLogs', \App\Models\Admin::class)
                                        <li class="{{ request()->segment(2) == 'logs-download' ? 'active' : '' }}">
                                            <a href="{{ url('admin/logs-download') }}">
                                                <i class="icon mdi mdi-bug"></i>
                                                <span>Descargar Logs</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('accessPromotions', \App\Models\Admin::class)
                                        <li class="{{ request()->segment(2) == 'promociones' ? 'active' : '' }}">
                                            <a href="{{ url('admin/promociones') }}">
                                                <i class="icon mdi mdi-globe"></i>
                                                <span>Promociones</span>
                                            </a>
                                        </li>
                                    @endcan
                                    <li class="{{ (request()->segment(2) == 'tickets' && (request()->segment(3) == null) ) && !request()->is('admin/tickets/pendientes') ? 'active' : '' }}">
                                        <a href="{{ url('admin/tickets') }}">
                                            <i class="icon mdi mdi-view-list-alt"></i>
                                            <span>Tickets</span>
                                        </a>
                                    </li> 
                                    <li class="{{ (request()->segment(2) == 'tickets' && (request()->segment(3) == 'pendientes' )) ? 'active' : '' }}">
                                        <a href="{{ url('admin/tickets/pendientes') }}">
                                            <i class="icon mdi mdi-alert-polygon"></i>
                                            <span>Tickets Pendientes</span>
                                        </a>
                                    </li> 
                                    <li class="{{ request()->segment(2) == 'usuarios' ? 'active' : '' }}">
                                        <a href="{{ url('admin/usuarios') }}">
                                            <i class="icon mdi mdi-accounts"></i>
                                            <span>Usuarios</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.logout') }}"
                                        onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                            <span class="icon mdi mdi-power"></span>Cerrar Sesión
                                        </a>
                                    
                                        <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>

                                    @endif

                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="app">
                <div style="display: none;" class="url">{{ secure_url('') }}</div>
                @yield('content')
            </div>

        </div>
@endguest

        <script src="{{ asset('assets_admin/js/adminVue.js') }}" defer></script>
        <script src="{{ asset('assets_admin/lib/jquery/jquery.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/lib/perfect-scrollbar/js/perfect-scrollbar.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/lib/bootstrap/dist/js/bootstrap.bundle.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/js/app.js') }}" type="text/javascript"></script>
        {{-- <script src="{{ asset('assets_admin/lib/sweetalert2/sweetalert2.all.min.js') }}" type="text/javascript"></script> --}}
        <script src="{{ asset('assets_admin/lib/jquery.niftymodals/js/jquery.niftymodals.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/lib/parsley/parsley.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/lib/parsley/i18n/es.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/lib/datatables/datatables.net/js/jquery.dataTables.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/lib/datatables/datatables.net-bs4/js/dataTables.bootstrap4.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/lib/datatables/datatables.net-buttons/js/dataTables.buttons.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/lib/datatables/datatables.net-buttons/js/buttons.flash.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/lib/datatables/jszip/jszip.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/lib/datatables/pdfmake/pdfmake.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/lib/datatables/pdfmake/vfs_fonts.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/lib/datatables/datatables.net-buttons/js/buttons.colVis.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/lib/datatables/datatables.net-buttons/js/buttons.print.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/lib/datatables/datatables.net-buttons/js/buttons.html5.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/lib/datatables/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js') }}" type="text/javascript"></script>
        <script src="{{ asset('assets_admin/js/app-tables-datatables.js') }}" type="text/javascript"></script>


        <script type="text/javascript">
            $.fn.niftyModal('setDefaults',{
                overlaySelector: '.modal-overlay',
                contentSelector: '.modal-content',
                closeSelector: '.modal-close',
                classAddAfterOpen: 'modal-show'
            });

            $(document).ready(function(){

                //-initialize the javascript
                App.init();
                $('form').parsley();
                App.dataTables();

                $( ".formDelete" ).submit(function( event ) {
                    event.preventDefault();
                });
            });

        </script>

        @yield("scripts")

    </body>
</html>
