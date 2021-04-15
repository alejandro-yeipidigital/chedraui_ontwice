@extends('admin.layouts.layout')
<style>
    /* Style the tab */
.tab {
  overflow: hidden;
  border: 1px solid #ccc;
  background-color: #f1f1f1;
}

/* Style the buttons that are used to open the tab content */
.tab button {
  background-color: inherit;
  float: left;
  border: none;
  outline: none;
  cursor: pointer;
  padding: 14px 16px;
  transition: 0.3s;
}

/* Change background color of buttons on hover */
.tab button:hover {
  background-color: #ddd;
}

/* Create an active/current tablink class */
.tab button.active {
  background-color: #ccc;
}

/* Style the tab content */
.tabcontent {
  display: none;
  padding: 6px 12px;
  border: 1px solid #ccc;
  border-top: none;
}
</style>
@section('content')  

<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Reportes</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Reportes</li>
            </ol>
        </nav>
    </div>
    <div class="main-content container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card card-header ">
                        <!-- Nav tabs -->
                        <!-- Tab links -->
                        <div class="tab">
                            @foreach ($temporalidades as $temporalidad)
                                <button class="tablinks"  onclick="temporada(event, '{{$temporalidad->temporality}}')" )>{{$temporalidad->temporality}}</button>
                            @endforeach
                        </div>
                        <!-- Tab content -->
                        @foreach ($temporalidades as $temporalidad)
                            <div id="{{$temporalidad->temporality}}" class="tabcontent">
                                <div class="row">
                                    <div class="col-12">
                                        <div class="card card-table">
                                            <div class="card-body">
                                                <table class=" table table-striped table-hover table-responsive" id="table1">
                                                    <thead>
                                                        <tr>
                                                        <th>ID</th>                                                        
                                                        <th>Nombre</th>
                                                        <th>Telefono</th>
                                                        <th>Correo</th>
                                                        <th>Estatus</th>
                                                        <th>Folio</th>
                                                        <th>Producto</th>
                                                        <th>Tienda</th>
                                                        <th>Método de pago</th>
                                                        <th>Monto Total</th>
                                                        <th>Razón</th>
                                                        <th>Otros productos</th>
                                                        <th>Fecha</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>                                                                            
                                                        @foreach ($participaciones_fases as $item)
                                                            @foreach ($item as $item2 => $valor) 
                                                                @foreach ($valor as $key => $participacion) 
                                                                    @if ($participacion['temporality'] == $temporalidad->temporality )
                                                                    <tr>
                                                                    <td>{{ $participacion['id'] }}</td>
                                                                    <td>{{ $participacion['name'] .' '. $participacion['middle_name'] .' '. $participacion['last_name'] }}</td>
                                                                    <td>{{ $participacion['telephone'] }}</td>
                                                                    <td>{{ $participacion['email'] }}</td>
                                                                    <td>
                                                                        @if($participacion['validation'] == 1)
                                                                            <span class="text-warning">Pendiente</span> <i class="mdi mdi-alert-triangle text-warning" style="font-size: 18px;"></i>
                                                                            @elseif($participacion['validation'] == 2)
                                                                            <span class="text-success">Valido</span> <i class="mdi mdi-check-circle text-success" style="font-size: 18px;"></i>
                                                                        @else
                                                                            <span class="text-danger">Rechazado</span> <i class="mdi mdi-close-circle text-danger" style="font-size: 18px;"></i>
                                                                        @endif
                                                                    </td>
                                                                    <td>{{ $participacion['folio'] }}</td>
                                                                    <td>{{ $participacion['product'] }}</td>
                                                                    <td>{{ $participacion['store']}}</td>
                                                                    <td>{{ $participacion['pay'] }}</td>
                                                                    <td>{{ $participacion['total']}}</td>
                                                                    <td>{{ $participacion['reason']}}</td>
                                                                    <td>{{ $participacion['other_products'] }}</td>                                                                    
                                                                    <td>{{ $participacion['date'] }}</td>
                                                                    </tr> 
                                                                    @endif
                                                                @endforeach 
                                                            @endforeach 
                                                        @endforeach        
                                                    </tbody> 
                                                </table>
                                            </div> 
                                        </div>       
                                    </div>
                                </div>
                            </div>    
                        @endforeach 
                    </div>         
                </div>                  
            </div>
        </div>
    </div>
</div>

<script>
    function temporada(evt, fase) {

    // Declare all variables
    var i, tabcontent, tablinks;

    // Get all elements with class="tabcontent" and hide them
    tabcontent = document.getElementsByClassName("tabcontent");
    for (i = 0; i < tabcontent.length; i++) {
        tabcontent[i].style.display = "none";
    }

    // Get all elements with class="tablinks" and remove the class "active"
    tablinks = document.getElementsByClassName("tablinks");
    for (i = 0; i < tablinks.length; i++) {
        tablinks[i].className = tablinks[i].className.replace(" active", "");
    }

    // Show the current tab, and add an "active" class to the button that opened the tab
    document.getElementById(fase).style.display = "block";
    evt.currentTarget.className += " active";

    
    }
</script>

@endsection  