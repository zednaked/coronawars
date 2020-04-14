@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
			<div class="panel panel-default">
				  <!-- Default panel contents -->
				  <div class="panel-body">
					<div class="table-responsive" style="overflow:visible">
						<table class="table table-hover">
							<thead>
								<tr>
									<th style="text-align:center;">{{__('Authorization')}}</th>
									<th>{{__('Name')}}</th>
									<th class="visible-sm visible-md visible-lg">{{__('Email')}}</th>
									<th class="visible-md visible-lg">{{__('Created at')}}</th>
								</tr>
							</thead>
							<tbody>
							@include('auth.admin-users-iterator',['users' => $users])
							</tbody>
						</table>
					</div>
					<div style="text-align:center">
				        {{ $users->links() }}	
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection