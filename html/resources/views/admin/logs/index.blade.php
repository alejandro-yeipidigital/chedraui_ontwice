@extends('admin.layouts.layout')

@section('content')
<div class="be-content">
        <div class="main-content container-fluid">
			<div class="container">
			    <div class="row justify-content-center">
					<div class="col-lg-12">
				     	<div class="card card-table">
				    		<div class="card-header" align="center">Logs
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
						             		<th></th>
						                	<th>Log</th>
						                	<th>Created At</th>
						                	<th>Updated At</th>
						                	<th>Status</th>
						                	<th>Action</th>
						              	</tr>
						            </thead>
						            <tbody class="no-border-x">
						            	@foreach ($logs as $log)
						            		<tr>
												<td>
													@if ($log->status_id == 1)
														<div style="border-radius: 50px; background-color: #34A853; width: 30px; height: 30px;" align="center">
															<span class="mdi mdi-badge-check" style="color: white; margin-top: 8px;"></span>
														</div>
													@elseif($log->status_id == 2)
														<div style="border-radius: 50px; background-color: #FCBB07; width: 30px; height: 30px;" align="center">
															<span class="mdi mdi-alert-polygon" style="color: white; margin-top: 8px;"></span>
														</div>
													@else
														<div style="border-radius: 50px; background-color: red; width: 30px; height: 30px;" align="center">
															<span class="mdi mdi-block-alt" style="color: white; margin-top: 8px; font-weight: bold;"></span>
														</div>
													@endif
												</td>

						            		   	<td>{{ $log->message }}</td>
						            		   	<td>{{ $log->created_at }}</td>
						            		   	<td>{{ $log->updated_at}}</td>
						            		   	<td>
						            		   		@if ($log->verified == 1)
						            		   			<div style="border-radius: 50px; background-color: #34A853; width: 30px; height: 30px;" align="center">
						            		   				<span class="mdi mdi-check-circle" style="color: white; margin-top: 8px;"></span>
						            		   			</div>
													@else
														<div style="border-radius: 50px; background-color: #ff9933; width: 30px; height: 30px;" align="center">
															<span class="mdi mdi-alert-circle" style="color: white; margin-top: 8px;"></span>
														</div>
						            		   		@endif
						            		   	</td>
						            		   	@if ( $log->verified == 0 )
						            		   		<td>
						            		   			<form action="{{ route('admin.verify_incidence') }}" method="POST">
						            		   				{{ csrf_field() }}
						            		   				<input type="hidden" name="log_id" value="{{ $log->id }}">
						            		   				<button type="submit" class="btn btn-primary">Verify</button>
						            		   			</form>
						            		   		</td>
						            		   	@endif
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
@section('scripts')
	
@endsection