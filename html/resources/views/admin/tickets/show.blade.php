@extends('admin.layouts.layout')
<style>
    .coincidencia {
        font-weight: bold;
        text-align: center;
        border-style: solid;
        border-width: 0px 0px 2px 0px;
        border-bottom-color: #4185F4;
    }
</style>
@section('content')
    <div class="be-content">
        <div class="page-head">
            <h2 class="page-head-title">Tickets</h2>
            <nav aria-label="breadcrumb" role="navigation">
                <ol class="breadcrumb page-head-nav">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                    <li class="breadcrumb-item active">Tickets</li>
                    <li class="breadcrumb-item active">{{ $ticket->ticket_id }}</li>
                </ol>
            </nav>
        </div>

        <div class="main-content container-fluid">
            @isset($ticket->user->observations)
                <div class="justify-content-md-center">
                    <div class="col-md-10 offset-1">
                        <div class="card card-border-color card-border-color-danger">
                            <div class="card-header card-header-divider" align="center">
                                <strong>Observaciones del Usuario</strong>
                            </div>
                            <div class="card-body">
                                {{ $ticket->user->observations }}
                            </div>
                        </div>
                    </div>
                </div>
            @endisset

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <div class="row justify-content-md-center">
                <div class="col-5">
                    <div class="col-12">
                        <div class="card card-border-color card-border-color-primary">
                            <div class="card-header card-header-divider" align="center">
                                Una promo grande como el Sol en Chedraui
                                <br>
                                <strong>Reglas para Validar Tickets </strong>
                            </div>
                            <div class="card-body">
                                <!--AQUI PEGAR REGLAS DE CADA PROMO -->
                                <p><strong>CUARTO: <u>Mec&aacute;nica de la Promoci&oacute;n y Productos Adheridos</u></strong></p>
                                <a href="{{ url('/productos') }}">
                                    <button class="btn btn-primary">Ver Productos</button>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="card card-flat be-loading text-center">
                        <img src="{{ asset( 'storage/' . $ticket->ticket) }}" style="width: 100%">
                    </div>
                </div>
                
                <div class="col-7">
                    <div class="card">
                        <div class="card-header card-header-divider">
                            Revisión Ticket
                            <span class="card-subtitle" style="color: red;"> {{ ($ticket->validation != 1) ? 'Este ticket ya ha sido validado' : '' }} </span>
                        </div>
                        <div class="card-body">
                            <form id="formulario" method="POST"
                                  action="{{ route('admin.tickets.update', $ticket->id) }}"
                                  data-parsley-validate="" novalidate="">
                                {{ csrf_field() }}

                                <input type="hidden" name="participation_id" value="{{ $ticket->id }}">

                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Usuario</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <a href="{{ route('admin.users.show', $ticket->user_id) }}">
                                            <img src="{{ asset( $ticket->user->avatar ? $ticket->user->avatar : 'assets_admin/img/avatar7.png' ) }}" alt="" style="width: 80px;">
                                            <br>
                                            {{ $ticket->user->name . ' ' . $ticket->user->middle_name . ' ' . $ticket->user->last_name}}
                                        </a>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Fecha Registro</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input class="form-control" value="{{ $ticket->created_at }}" type="text" disabled>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Puntos</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input class="form-control" value="{{ $ticket->total_points }}" type="text" disabled>
                                    </div>
                                </div>
                               
                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Monto Total</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input class="form-control" value="{{ old('total', $ticket->total_ticket) }}" type="number" step="0.01" id="total" name="total" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Folio</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input class="form-control" value="{{ old('folio', $ticket->ticket_code) }}" type="text" name="folio" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Válido</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                       @if($ticket->validation == 1)
                                            <select class="form-control" id="valido" name="valido" onchange="allDisabled()"  required>
                                                <option value="" selected disabled>SELECCIONA UNA OPCIÓN</option>
                                                <option value="2">SI</option>
                                                <option value="3">NO</option>
                                            </select>
                                        @else
                                            <input class="form-control" value="{{ $ticket->validation == '2' ? 'SI' : 'NO' }}" type="text" disabled>
                                            <input type="hidden" name="valido" value="">
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputTienda">Tienda</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input type="text" name="store" class="form-control form-control-sm inputTiendas" id="inputTienda" value="{{ old('store', $ticket->store) }}">
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Región</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <select class="form-control" id="region" name="region" required {{ ($ticket->region) ? 'disabled' : '' }}>
                                            <option value="" selected disabled>SELECCIONA UNA OPCIÓN</option>
                                            @foreach ($estados as $estado)
                                                <option value="{{ $estado->estado }}" {{ ( $ticket->region == $estado->estado) ? 'selected' : '' }}>{{ $estado->estado }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Forma de Pago</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <select class="form-control" id="payment" name="payment" required>
                                            <option value="" selected disabled>SELECCIONA UNA OPCIÓN</option>
                                            <option value="Efectivo" {{ ( $ticket->pay == "Efectivo") ? 'selected' : '' }}>Efectivo</option>
                                            <option value="Tarjeta" {{ ( $ticket->pay == "Tarjeta") ? 'selected' : '' }}>Tarjeta</option>
                                            <option value="-">No Aplica</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Producto Principal</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input class="form-control" value="{{ old('main_product', $ticket->main_product) }}" type="text" id="main_product" name="main_product" required>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Otros Productos</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <textarea class="form-control" name="other_products" id="other_products" cols="30" rows="10">{{ old('other_products', $ticket->other_products) }}</textarea>
                                    </div> 
                                </div>

                                <div class="form-group row">
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Razón de Rechazo</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <input class="form-control" value="{{ old('reason', $ticket->reason) }}" type="text" id="reason" name="reason" required>
                                    </div>
                                </div>

                                <div class="row pt-0 pt-sm-5">
                                    <div class="col-sm-6 pb-2 pb-sm-4 pb-lg-0 pr-0"></div>
                                    <div class="col-sm-6 pl-0">
                                        <p class="text-right">
                                            <button class="btn btn-space btn-primary btn-lg" id="guardar" type="submit" {{ ($ticket->validation != 1) ?  'disabled' : ''}} onclick="bloquearyenviar()">Guardar</button>
                                        </p>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            {{-- </div> --}}
            {{-- <div class="row"> --}}
                {{-- <div class="col-lg-8">
                    <div class="card card-flat be-loading text-center">
                        <img src="{{ asset( 'storage/tickets/' . $ticket->ticket) }}" style="width: 100%">
                    </div>
                </div> --}}
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<!-- Archivos necesarios para autocomplete-->    
<link rel="stylesheet" href="{{ asset('assets_admin/js/autocomplete/jquery-ui.css')  }}" type="text/css"/>
<script src="{{ asset('assets_admin/js/autocomplete/jquery-ui.js') }}"></script>
<script>
    $(function(){ 
        // AUTOCOMPLETE TIENDAS
        var tiendasList = [
            'NO APLICA',
            'CHEDRAHUI'
        ];

        $( ".inputTiendas" ).autocomplete({
                source: tiendasList
        });
        $( ".inputTiendas" ).autocomplete( "option", "appendTo", ".eventInsForm" );

        // AUTOCOMPLETE Productos
        var productos = [
            '7501011115613	Papas Sabritas Salada 340Gr (3196363)',
            '7501011115606	Papas Sabritas Salada 240Gr (3196360)',
            '7501011115231	Botana Doritos Nacho 370Gr (3189128)',
            '7501011173521	Botana Tostitos Nacho 400Gr (3110028)',
            '7501011115675	Papas Sabritas Ruffles Queso 400Gr (3196374)',
            '7500478005741	Cacahuates Karate Japoneses 154Gr (3523136)',
            '7501011114579	Botana Cheetos Torciditos 370Gr (3170573)',
            '7501011167735	Botana Doritos Nacho 245Gr (3041819)',
            '7501011133884	Papas Sabritas Salada 170Gr (3196344)',
            '7501011133921	Papas Sabritas Adobadas 170Gr (3196352)',
            '7500478007981	Papas Sabritas Ruffles Queso 200Gr (3090776)',
            '7501011155008	Botana Paketaxo Quexo 215Gr (3347510)',
            '7500478006090	Botana Sabritas Fritos Sal Y Limón 265Gr (3522899)',
            '7501011131002	Chicharron De Cerdo Sabritas 115Gr (3041266)',
            '7501011154902	Botana Paketaxo Mezcladito 280Gr (3041351)',
            '7501011114517	Botana Sabritas Rancheritos 145Gr (3170570)',
            '7501011194472	Aderezo Sabridip Queso 240Gr (3090858)',
            '7500478002559	Botana Sabritas Churrumais Limon 185Gr (3041811)',
            '7501011135512	Botana Tostitos Salsa Verde 240Gr (3257201)',
            '7501011167728	Botana Cheetos Torciditos 255Gr (3105043)',
            '7501011115668	Papas Sabritas Ruffles Queso 290Gr (3196372)',
            '7501011115590	Papas Sabritas Crema Y Especias 170Gr (3196357)',
            '7501011194465	Aderezo Sabridip Queso Jalapeño 255Ml (3043857)',
            '7501011133938	Papas Sabritas Limón 170Gr (3196354)',
            '7501011167681	Papas Sabritas Ruffles Sal 120Gr (3196368)',
            '7501011154865	Botana Paketaxo Botanero 270Gr (3224608)',
            '7501011131064	Botana Sabritas Doritos Nacho 146Gr (3090767)',
            '7501011159266	Papas Sabritas Rec Cruj Flamin´Hot 170Gr (3349980)',
            '7501011131118	Botana Sabritas Fritos Chile 170Gr (3090772)',
            '7501011194458	Aderezo Sabridip Cebolla 240Gr ',
            '7501011124776	Cacahuates Mafer Enchilados 180Gr (3104443)',
            '7501011153455	Botana Cheetos Quesabritas 170Gr (3041828)',
            '7501011167674	Papas Sabritas Ruffles Queso 120Gr (3196366)',
            '7501011151062	Botana Sabritas Fritos Chorizo 170Gr (3332921)',
            '7501011149434	Chicharron Sabritas Sabritones 260Gr (3347506)',
            '7501011130937	Botana Sabritas Cheetos Flamin Hot 145Gr (3090778)',
            '7501011143258	Papas Sabritas Rec Cruj Jalapeño 170Gr (3230173)',
            '7501011167438	Papas Sabritas Sal 62Gr (3170562)',
            '7501011143241	Papas Sabritas Rec Cruj Sal 170Gr (3230174)',
            '7501011167667	Papas Sabritas Adobadas 105Gr (3104995)',
            '7501011132139	Cacahuates Mafer Japoneses 180Gr (3104444)',
            '7500478007998	Papas Sabritas Ruffles Original 200G (3090777)',
            '7501011151086	Chicharron Sabritas Sabritones 160Gr (3041832)',
            '7501011167605	Botana Sabritas Cheetos Torciditos 90Gr (3205028)',
            '7501011126930	Cacahuates Mafer Tostado 180Gr (3104449)',
            '7501011155022	Botana Paketaxo Flamin´ Hot 228Gr (3338493)',
            '7501011130975	Botana Sabritas Cheetos Torciditos 145Gr (3090779)',
            '7501011130968	Botana Cheetos Poffs 270Gr (3105042)',
            '7501011126244	Cacahuates Mafer Sal Y Limón 180Gr (3104445)',
            '7501011167469	Papas Sabritas Ruffles Queso 67Gr (3170568)',
            '7501011167612	Botana Sabritas Doritos Nachos 84Gr (3170566)',
            '7500478022212	Cacahuates Kacang Sal Limón 185 G (3669819)',
            '7501011131040	Botana Sabritas Crujitos Queso 120Gr (3041830)',
            '7500478010134	Cacahuates Mafer Mexcalisimo 160Gr (3575480)',
            '7501011130944	Botana Sabritas Cheetos Poff 110Gr (3104993)',
            '7500478002184	Cacahuates Mafer 15% Más Tostado 207Gr (3484643)',
            '7500478014231	Cacahuates Karate Enchilados 120Gr (3614439)',
            '7501011135024	Botana Paketaxo Mezcladito 170Gr (3041838)',
            '7501011143265	Papas Sabritas Rec Cruj Chiles 170Gr (3230175)',
            '7500478012114	Botana Doritos ADN Flamin Hot 245Gr (3581729)',
            '7500478020782	Cacahuates Karate Japonés 90 g (3672780)',
            '7501011131125	Botana Sabritas Fritos Sal 170Gr (3090773)',
            '7501011167711	Botana Cheetos Poffs 170Gr (3206079)',
            '7501011131026	Chicharron De Cerdo Sabritas 70Gr (3041905)',
            '7501011143432	Cacahuates Mafer Japoneses 100Gr (3233758)',
            '7501011143418	Cacahuates Mafer Sazonado 100Gr (3233757)',
            '7501011167759	Botana Rancheritos Familiar 240Gr (3254251)',
            '7501011131057	Botana Sabritas Doritos Diablo 146Gr (3041817)',
            '7500478018970	Cacahuates Mafer Tostado Sazonado 146Gr (3658383)',
            '7500478022229	Cacahuates Kacang Enchilado 185 G (3669818)',
            '7501011176898	Platanitos Sunbites Dulces 28Gr (3462829)',
            '7500478004904	Cacahuates Mafer Sazonado 65Gr (3332961)',
            '7501011167650	Papas Sabritas Sal 105Gr (3104997)',
            '7500478022199	Cacahuates Kacang Flamin Hot 185 G (3669815)',
            '7500478022236	Cacahuates Kacang Japonés 185 G (3669817)',
            '7500478005031	Botana Sabritas Churrumais Flamas 185Gr (3503444)',
            '7500478019014	Cacahuates Mafer Japonés Limón 146Gr (3658384)',
            '7501011125292	Cacahuates Mafer Surtido Especial 180Gr (3104448)',
            '7500478004911	Cacahuates Mafer Japoneses 65Gr (3332963)',
            '7501011130920	Botana Sabritas Cheetos Bolita 110Gr (3104994)',
            '7500478015993	Cacahuates Mafer Esquites 160Gr (3624882)',
            '7501011124608	Cacahuates Mafer Salados 180Gr (3104446)',
            '7500478021048	Cacahuates Karate Japonés 40 g (3663744)',
            '7500478002207	Cacahuates Mafer 15% Más Surtido 207Gr (3484641)',
            '7500478019007	Cacahuates Mafer Surtido Salado 146Gr (3658385)',
            '7500478005673	Cacahuates Karate Japonés 1 Kg (3681041)',
            '7501011143425	Cacahuates Mafer Surtido 95Gr (3233790)',
            '7500478023578	Papas Sabritas Receta Crujiente Sal 145 (3671442)',
            '7500478022663	Cacahuates Mafer Mexcalisimo 146 g (3667735)',
            '7500478003839	Mix Mafer Protein 90Gr (3480295)',
            '7500478020461	Papas Sabritas Rec Cruj Flamin Hot 145Gr (3671443)',
            '7500478024056	Cacahuates Mafer Tostado Sin sal 65 g (3681040)',
            '7501011143524	Cacahuates Mafer Surtido Especial 65Gr (3332964)',
            '7500478018512	Botana Doritos Dinamita 65Gr (3637536)',
            '7500478001057	Cacahuates Kacang Flamin Hot 100Gr (3462828)',
            '7501011154155	Cacahuates Kacang Japoneses 100Gr (3090345)',
            '7500478022205	Cacahuates Kacang Habanero 185 G (3669816)',
            '7500478020164	Cacahuates Kacang Incógnita 185 G (3670030)',
            '7500478003815	Mix Mafer Protein Arandanos 35Gr (3480181)',
            '7501011177222	Platanitos Sunbites Chile Y Limón 28Gr (3462830)',
            '7500478011261	Churritos Don Nopal Amaranto 250Gr (3590025)',
            '7501011151543	Cacahuates Kacang Enchilados 100Gr (3090344)',
            '7501011125599	Cacahuates Mafer Surtido Enchilado 180Gr (3104447)',
            '7500478020799	Cacahuates Karate Salsa Negra 81 g (3678622)',
            '7500478002191	Cacahuates Mafer +15% Japones Limó 207Gr (3484638)',
            '7501011174191	Botana Sunbites Chiles Rojos 47Gr (3415545)',
            '7501011135581	Botana Tostitos Flamin´ Hot 240Gr (3257203)',
            '7500478022656	Cacahuates Mafer Esquite 146 g (3667734)',
            '7500478019625	Cacahuates Kacang Incógnita 100Gr (3656285)',
            '7500478003860	Mix Mafer Energy 90Gr (3480297)',
            '7501011114623	Botana Paketaxo Queso 65Gr (3322294)',
            '7500478018642	Botana Doritos Dinamita Comparte 160Gr (3656283)',
            '7501011151468	Cacahuates Kacang Salados 100Gr (3090346)',
            '7500478003884	Mix Mafer Antioxidant 90Gr (3480299)',
            '7500478023790	Cacahuates Mafer Chile Morita 146 g (3678619)',
            '7500478019748	Cacahuates Karate Salsa Negra Picante (3664283)',
            '7500478012121	Botana Doritos ADN Pizzerola 245Gr (3581764)',
            '7501011143449	Cacahuates Mafer Enchilados 100Gr (3233759)',
            '7500478003846	Mix Mafer Energy Manzana 35Gr (3480186)',
            '7501011167445	Papas Sabritas Adobadas 62Gr (3254256)',
            '7500478023585	Papas Sabritas Receta Crujiente (3671440)',
            '7500478024025	Cacahuates Mafer Tostado Sin sal 146 g (3681039)',
            '7500478021529	Churritos Don Nopal Amaranto 60 g (3662234)',
            '7501011111011	Papas Sabritas Sabrisemana Surtido 331Gr (3245434)',
            '7500478012138	Botana Doritos ADN Incognita 245Gr (3581763)',
            '7500478023424	Papas Sabritas Rec Cruji Jalapeño 145Gr (3671441)',
            '7501011167629	Botana Sabritas Rancheritos 84Gr (3254252)',
            '7500478013142	Cacahuates Kacang Habanero 100Gr (3656284)',
            '7500478019755	Cacahuates Kacang Incógnita 74 g (3662207)',
            '7500478009459	Cacahuates Kacang Enchilado 74 g (3662208)',
            '7500478003877	Mix Mafer Antioxidant Fresa 35Gr (3480187)',
            '7500478015528	Palomitas Sunbites Cheddar 37 Gr (3627842)',
            '7500478016587	Botana Churrumais Limon 64 gr (3668037)',
            '7500478015511	Palomitas Sunbites Sal 37 Gr (3627844)',
            '7500478009442	Cacahuates Kacang Flamin Hot 78 g (3662209)',
            '7501011121973	Papas Stax Original 163Gr (3115928)',
            '7500478019816	Cacahuates Mafer Bonus Pack Enchilado (3678620)',
            '7501011123502	Totopos Tostitos 905Gr (3136349)',
            '7500478017973	Botana Cheetos Poffs Flamin Hot 50Gr (3632543)',
            '7500478018697	Botana Crujitos Flamin Hot 70Gr (3657614)',
            '7501011121980	Papas Stax Cheddar 155.9Gr (3118332)',
            '7500478005079	Botana Churrumais Flamas 75Gr (3656288)',
            '7500478021734	Botana Doritos 3D 180 g (3671209)',
            '7500478010790	Churritos Don Nopal Amaranto 90Gr (3590026)',
            '7500478014385	Papas Ruffles Ultra Blazin Cheese 67Gr (3656286)',
            '7501011121997	Papas Stax Crema 155.9Gr (3118333)',
            '7500478021536	Churritos Don Frijol Natural 60 g (3662235)',
            '7500478020881	Botana Churrumais Flamin Hot 68 gr (3668038)',
            '7501011128989	Doritos Sabritas Incognita Recarg 155 Gr ',
            '7501011130869	Botana Tostitos Salsa Verde 180Gr ',
            '7500478010691	Botana Tostitos Salsa Verde 86 gr ',
            '7500478021987	Botana Cheetos Colmillos 51 g (3675457)'
        ];

        $( "#main_product" ).autocomplete({
                source: productos
        });
        $( "#main_product" ).autocomplete( "option", "appendTo", ".eventInsForm" );
    });

    //Funcion que inhabilita todas las opciones al seleccionar invÁlido el ticket
    function allDisabled () {
        var valido          = document.getElementById("valido")
        var total           = document.getElementById("total")
        var store           = document.getElementById("inputTienda")
        var payment         = document.getElementById("payment")
        var product         = document.getElementById("main_product")
        var other_products  = document.getElementById("other_products")
        var reason          = document.getElementById("reason")
        
        // Si ticket NO es válido
        if (valido.value == 3) {
            //cambios          
            payment.selectedIndex   = "3"
            product.value           = "-"
            other_products.value    = "-"

            //inhabilitar campos
            // payment.disabled        = true
            // product.disabled        = true
            // other_products.disabled = true
            
            // Activar campo razón de rechazo
            reason.disabled         = false

            // Si la tienda aÃºn no tiene valor entonces seleccionar "NO APLICA"
            if (!store.value) {
                store.value = "NO APLICA"
            }

        } else { // Si el ticket es válido
            //cambio en razon de rechazo = '-'
            reason.value = "-"

            //habilitar campos
            payment.disabled        = false
            product.disabled        = false
            other_products.disabled = false
            reason.disabled         = true
        }   
    }

    // Ejecutar en el evento onclick la función inhabilitar y lq función enviar
    function bloquearyenviar ()
    {
        bloquear();
        enviar();  
    }

    // Función inhablitar botón
    function bloquear () 
    {
        document.getElementById("guardar").disabled = true;
    
    }  

    // Función enviar  
    function enviar () 
    {
        document.getElementById("formulario").submit();
    }    
</script>    
@endsection