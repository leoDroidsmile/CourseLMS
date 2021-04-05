@extends('layouts.master')
@section('title','Instructor Account Setup')
@section('parentPageTitle', 'All')

@section('css-link')

@stop

@section('page-style')

@stop
@section('content')
    
<div class="box text-black">
    

<div class="box-body">
		
	@if (Auth::user()->user_type === 'Admin')
		<div class="panel panel-default">
			 <div class="panel-heading h3">Post Reply</div>
			<div class="card-body rounded shadow py-5 mt-5 bg-white">
			  	    <div class="container-fluid">

                        @include('forum.panel.report', [$posts_count, $post_compare, $replies_count, $replies_compare, $views_count, $views_compare])
						
					</div>
				</div>
			</div>
		</div>
	@endif
		
  		<table class="table table-bordered table-striped table-hover mt-3 shadow rounded">
  			<thead class="thead-dark">
  				<th>
  				#
	  			</th>
	  			<th>
	  				Reply
	  			</th>
	  			<th>
	  				Author
	  			</th>
	  			<th>
	  				Replied At
	  			</th>
	  			<th>
	  				Action
	  			</th>
  			</thead>

  			<tbody class="text-black">
  				@forelse($replies as $key => $reply)
					<tr class="text-black background-white">
						<td>{{ $key+1 }}</td>
						<td class="w-75">{!! $reply->reply !!}</td>
                        <td>{{ $reply->user->name }}</td>
                        <td>{{ $reply->created_at->diffForHumans() }}</td>
                        <td>
                            <a href="javascript:void(0)"
                            onclick="confirm_modal('{{ route('forum.reply.delete',$reply->id) }}', '@translate(Delete)')"
                            class="btn btn-danger">
                            <i class="fa fa-trash" aria-hidden="true"></i>
                        </a>
                        </td>
					</tr>
  				@empty
					<tr>
						<td colspan="5">
							<img src="{{ asset('forum-not-found.png') }}" class="img-fluid w-100" alt="No Post Found">
						</td>
					</tr>
  				@endforelse
  			</tbody>
  		</table>

  		<div class="text-center">
  			{!! $replies->links() !!}
  		</div>

  	</div>
  </div>

@endsection



@section('js-link')

@stop

@section('page-script')
@stop





