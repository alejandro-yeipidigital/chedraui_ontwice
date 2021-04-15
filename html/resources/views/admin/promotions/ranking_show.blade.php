@extends('admin.layouts.layout')

@section('content')
<div class="be-content">
    <div class="page-head">
        <h2 class="page-head-title">Ranking</h2>
        <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
                <li class="breadcrumb-item"><a href="{{ url('/') }}">Inicio</a></li>
                <li class="breadcrumb-item active">Promociones</li>
                <li class="breadcrumb-item active">Ranking</li>
            </ol>
        </nav>
    </div>

    <div class="main-content container-fluid">
		<div class="container">
		    <div class="row justify-content-center">
				<div class="col-lg-12">
			     	<div class="card card-table">
			    		<div class="card-header" align="center">{{ $temporality->name }}
			          		<div class="tools dropdown">
			            	<div class="dropdown-menu" role="menu"><a class="dropdown-item" href="#">Action</a><a class="dropdown-item" href="#">Another action</a><a class="dropdown-item" href="#">Something else here</a>
			              		<div class="dropdown-divider"></div><a class="dropdown-item" href="#">Separated link</a>
			           	 	</div>
			          	</div>
			        </div>
			        	<div class="card-body">
					        <table class="table table-striped table-borderless">
					        	<thead>
					             	<tr>
                                         <th>Posición</th>
					                	<th style="width:50%;">Nombre</th>
					                	<th style="width:10%;">Puntos</th>
					              	</tr>
					            </thead>
					            <tbody class="no-border-x">
					            	@foreach ($ranking as $key => $rank)
					            		<tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>
                                                <a href="{{ secure_url('admin/usuarios/' . $rank->user_id) }}">
                                                    {{ $rank->Nombre . ' ' . $rank->Apellido_Paterno . ' ' . $rank->Apellido_Materno}}
                                                </a>
                                            </td>
					            		   	<td>{{ $rank->Puntos }}</td>
                                         </tr>
                                    @endforeach
			            		</tbody>
			          		</table>
			        	</div>
			      	</div>
			    </div>
			</div>
		</div>
	</div>
</div>	
@endsection