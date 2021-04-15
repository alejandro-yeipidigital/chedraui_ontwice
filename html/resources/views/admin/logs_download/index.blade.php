@extends('admin.layouts.layout')

@section('content')
<div class="be-content">
    <div class="main-content container-fluid">
		<div class="container">
		    <div class="row justify-content-center">
				<div class="col-lg-12">
			     	<div class="card card-table">
			    		<div class="card-header" align="center">Descargar Logs
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
					                	<th style="width:50%;">Log</th>
					                	<th style="width:10%;">Descargar</th>
					              	</tr>
					            </thead>
					            <tbody class="no-border-x">
					            	@foreach ($logs as $log)
					            		<tr>
					            		   	<td>{{ $log }}</td>
					            		   	<td>
					            		   		<a href="{{ asset('logs/' . $log) }}" download>
					            		   			<button class="btn btn-success" >Descargar</button>
					            		   		</a>
					            		   	</td>
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