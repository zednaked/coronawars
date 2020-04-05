		<style>
			.dropdown button span.fa-stack{
				font-size:6pt;
			}
		</style>
		@foreach ($users as $user)
			<tr>
				<td>
					<div class="btn-group">
					<div class="dropdown" style="display:inline-block">
					  <button class="btn btn-default dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
					  	<span class="fa-stack" aria-hidden="true"><i class="fa fa-stack-1x"></i><i class="fa fa-lg fa-users"></i></span>
						@if($user->isAdmin())
					  	<span class="fa-stack" aria-hidden="true"><i class="fa {{ !$user->isAdmin() ? 'fa-thumbs-down text-danger' : 'fa-thumbs-up'}} fa-stack-1x"></i><i class="fa fa-stack-2x fa-circle-o {{ !$user->isAdmin() ? 'text-danger' : ''}} "></i></span>
						@endif
						@if($user->hasRole('deliverer'))<span class="fa-stack " aria-hidden="true"><i class="fa fa-stack-1x">D</i><i class="fa fa-circle-o fa-stack-2x"></i></span>
						@endif
						<span class="caret"></span>
					  </button>
					  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
					  	@if($user->isAdmin())
					  	@if( $user->id != 1 )
						<li><a href="{{ route(($user->isAdmin() ? 'remove-role' : 'assign-role'),['userid'=>$user->id,'rolename'=>'superadministrator']) }}">
							<span class="fa-stack " aria-hidden="true"><i class="fa {{ $user->isAdmin() ? 'fa-thumbs-down text-danger' : 'fa-thumbs-up'}} fa-stack-1x"></i><i class="fa fa-stack-2x fa-circle-o {{ $user->isAdmin() ? 'text-danger' : ''}} "></i></span>
							&nbsp;{{ !$user->isAdmin() ? __('Make admin') : __('Unmake admin')}}</a></li>
						@endif
						@endif
						<li><a href="{{ route( ($user->hasRole('deliverer') ? 'remove-role':'assign-role'),['userid'=>$user->id,'rolename'=>'deliverer']) }}">
							<span class="fa-stack " aria-hidden="true"><i class="fa fa-stack-1x">D</i><i class="fa fa-circle-o fa-stack-2x"></i></span>
							&nbsp;{{ !$user->hasRole('deliverer') ? __('Make deliverer') : __('Unmake deliverer')}}</a></li>
					  </ul>
					</div>
					</div>
			    </td>
				<td>{{$user->name}}</td>
				<td class="visible-sm visible-md visible-lg">{{$user->email}}</td>
				<td class="visible-md visible-lg">{{$user->created_at}}</td>
			</tr>
		@endforeach