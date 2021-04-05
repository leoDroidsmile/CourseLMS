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
		
		<div class="panel panel-default">
			 <div class="panel-heading h3">Forum Manager</div>
			<div class="card-body rounded shadow py-5 mt-5 bg-white">
			  	<div class="container-fluid">

					@include('forum.panel.report', [$posts_count, $post_compare, $replies_count, $replies_compare, $views_count, $views_compare])
                     
					</div>
					</div>
				</div>
			</div>
		</div>

  		<table class="table table-bordered table-striped table-hover mt-3 shadow rounded">
  			<thead class="thead-dark">
  				<th>
  				#
	  			</th>
	  			<th>
	  				Topic
	  			</th>
	  			<th>
	  				Category
	  			</th>
	  			<th>
	  				Replies
	  			</th>
	  			<th>
	  				Posted At
	  			</th>
  			</thead>

  			<tbody class="text-black">
  				@forelse($forums as $key => $forum)
					<tr class="text-black background-white">
						<td>{{ $key+1 }}</td>
						<td>{{ $forum->title }}</td>
                        <td><span class="badge badge-primary"> {{ $forum->categoryName->name }} </span></td>
                        <td>{{ App\PostReply::where('post_id', $forum->id)->count() }}</td>
                        <td>{{ $forum->created_at->diffForHumans() }}</td>
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
  			{!! $forums->links() !!}
  		</div>

  	</div>
  </div>

@endsection



@section('js-link')

@stop

@section('page-script')
@stop





