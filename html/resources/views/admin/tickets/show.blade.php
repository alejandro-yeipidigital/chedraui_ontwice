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
                <validation-rules-component></validation-rules-component>
                
                <div class="col-md-8">
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
                                    <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Proveedor</label>
                                    <div class="col-12 col-sm-8 col-lg-6">
                                        <select class="form-control" id="store_id" name="store_id" required>
                                            <option value="" selected disabled>SELECCIONA UNA OPCIÓN</option>
                                            @foreach ($stores as $store)
                                            <option value="{{ $store->id }}" {{ ($store->id == $ticket->store) ? 'selected' : '' }}>{{ $store->store }}</option>
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
                            <div class="col-lg-8">
                                <div class="card card-flat be-loading text-center">
                                    <img src="{{ asset( 'storage/' . $ticket->ticket) }}" style="width: 100%">
                                </div>
                            </div>
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

<script>
    //Funcion que inhabilita todas las opciones al seleccionar inválido el ticket
        function allDisabled() {
            var valido = document.getElementById("valido")
            var total = document.getElementById("total")
            var store = document.getElementById("store_id")
            var payment = document.getElementById("payment")
            var product = document.getElementById("main_product")
            var other_products = document.getElementById("other_products")
            var reason = document.getElementById("reason")
            
            //Condición de validez negativa

            if (valido.value == 3) 
            {
                //cambios
                
                store.selectedIndex = "1"
                payment.selectedIndex = "3"
                product.value = "-"
                other_products.value = "-"
                //inhabilitar campos
                store.disabled = true
                //total.disabled =true
                payment.disabled = true
                product.disabled = true
                other_products.disabled = true
                reason.disabled = false
                if (total.value == 0) {
                    total.value = 0
                }else{
                    console.log("funciona 2")
                }

            } else{
                //cambio en razon de rechazo = '-'
                reason.value = "-"
                //habilitar campos
                store.disabled = false
                //total.disabled =false
                payment.disabled = false
                product.disabled = false
                other_products.disabled = false
                reason.disabled = true

            }
            
        }

        //Ejecutar en el evento onclick la función inhabilitar y lq función enviar
        function bloquearyenviar()
        {
            bloquear();
            enviar();  
        }

        //función inhablitar botón
        function bloquear() {
        document.getElementById("guardar").disabled=true;
        
        }  
        //función enviar  
        function enviar() {
        document.getElementById("formulario").submit();
        } 
        
</script>    
@endsection