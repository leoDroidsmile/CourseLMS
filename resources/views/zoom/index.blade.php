@extends('layouts.master')
@section('title','Instructor Account Setup')
@section('parentPageTitle', 'All')

@section('css-link')

@stop

@section('page-style')

@stop
@section('content')
    
<div class="box text-black">
  	<div class="box-header with-border">
  		<div class="box-title h2">
  			All Meetings ({{ App\Meeting::count() }})
  		</div>

  		<a title="Create a new meeting" href="{{ route('meeting.create') }}" class="pull-right btn btn-md btn-info">
  			<i class="fa fa-plus"></i> Create a new live class
  		</a>
  	</div>

  	<div class="box-body">
		
		<div class="panel panel-default">
			 <div class="panel-heading h3">Your Zoom Profile</div>
			<div class="card-body rounded shadow py-5 mt-5 bg-white">
			  	<div class="container-fluid">
					<div class="row">
                        <div class="col-lg-3 text-center">
                            <img src="{{ isset($profile['pic_url']) ? $profile['pic_url'] : ''}}" class="img-fluid mb-3 rounded shadow" alt="your_profile_picture">
                        </div>
						
						<div class="col-lg-9">
                                        <h4>{{ $profile['first_name'] }} {{ $profile['last_name'] }}</h4>
							<div class="table-responsive">
								<table class="table table-borderless mb-0">
									<tbody>
										<tr>
											<th scope="row" class="p-1">Status :</th>
											<td class="p-1">{{ $profile['status'] }}</td>
										</tr>
										<tr>
											<th scope="row" class="p-1">Zoom ID :</th>
											<td class="p-1">{{ $profile['id'] }}</td>
										</tr>
										<tr>
											<th scope="row" class="p-1">Langauge :</th>
											<td class="p-1">{{ $profile['language'] }}</td>
										</tr>
									</tbody>
								</table>
							</div>
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
	  				Meeting ID
	  			</th>
	  			<th>
	  				Meeting URL
	  			</th>
	  			<th>
	  				Action
	  			</th>
  			</thead>

  			<tbody class="text-black">
  				@foreach($meetings as $key => $meeting)
					<tr class="text-black background-white">
						<td>
							{{ $key+1 }}
						</td>

						<td>
							<p><b>Meeting ID:</b> {{ $meeting['id'] }}</p>
							<p><b>Meeting Topic:</b> {{ $meeting['topic'] }}</p>
							<p><b>Agenda:</b> {{ isset($meeting['agenda']) ? \Illuminate\Support\Str::limit($meeting['agenda'], 10, $end = '...') : "" }}</p>
							<p><b>Duration:</b> {{ isset($meeting['duration']) ? $meeting['duration'] : "" }} min</p>
							<p><b>Start Time:</b>{{ isset($meeting['start_time']) ? date('d-m-Y | h:i:s A',strtotime($meeting['start_time'])) : "" }} </p>
							<p><b>Meeting Type:</b> @if($meeting['type'] == '2') Scheduled Meeting @elseif($meeting['type'] == '3') Recurring Meeting with no fixed time @else Recurring Meeting with fixed time @endif</p>

							
						</td>

						<td>
							<a title="Join Meeting" target="_blank" href="{{ $meeting['join_url'] }}">
								{{ $meeting['join_url'] }}
							</a>
						</td>

						<td>

							@php
								$curl = curl_init();
								$token = Auth::user()->jwt_token;
								$meetingID = $meeting['id'];
									curl_setopt_array($curl, array(
									  CURLOPT_URL => "https://api.zoom.us/v2/meetings/$meetingID",
									  CURLOPT_RETURNTRANSFER => true,
									  CURLOPT_ENCODING => "",
									  CURLOPT_MAXREDIRS => 10,
									  CURLOPT_TIMEOUT => 30,
									  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
									  CURLOPT_CUSTOMREQUEST => "GET",
									  CURLOPT_HTTPHEADER => array(
									    "authorization: Bearer $token"
									  ),
									));

									$url = curl_exec($curl);
									$err = curl_error($curl);
									$url = json_decode($url,true);
									curl_close($curl);
								@endphp

							<a title="Edit Meeting" href="{{ route('zoom.edit',$meeting['id']) }}" class="btn btn-sm btn-success">
								<i class="fa fa-edit" aria-hidden="true"></i>
							</a>

							<a title="Delete Meeting" data-toggle="modal" data-target="#delete{{ $meeting['id'] }}" class="btn btn-sm btn-danger">
								<i class="fa fa-trash-o text-white"></i>
							</a>
							
							<a title="View Meeting" href="{{ route('zoom.show',$meeting['id']) }}" class="btn btn-sm btn-default">
								<i class="fa fa-eye" aria-hidden="true"></i>
							</a>
							
							
							<a title="Start Meeting" href="{{ isset($url['start_url']) ? $url['start_url'] : "" }}" class="btn btn-sm btn-info">
								<i class="fa fa-external-link" aria-hidden="true"></i>
							</a>

							



						</td>

						 <div id="delete{{ $meeting['id'] }}" class="delete-modal modal fade" role="dialog">
			                    <div class="modal-dialog modal-sm">
			                      <!-- Modal content-->
			                      <div class="modal-content">
			                        <div class="modal-header">
			                          <button type="button" class="close" data-dismiss="modal">&times;</button>
			                          <div class="delete-icon"></div>
			                        </div>
			                        <div class="modal-body text-center">
			                          <h4 class="modal-heading">Are You Sure ?</h4>
			                          <p>Do you really want to delete this meeting? This process cannot be undone.</p>
			                        </div>
			                        <div class="modal-footer">
			                       <form method="post" action="{{ route('zoom.delete',$meeting['id']) }}" class="pull-right">
			                                         {{csrf_field()}}
			                                         {{method_field("DELETE")}}
			                                          
			                                  
			                                          
			                        
			                            <button type="reset" class="btn btn-gray translate-y-3" data-dismiss="modal">No</button>
			                            <button type="submit" class="btn btn-danger">Yes</button>
			                          </form>
			                        </div>
			                      </div>
			                    </div>
			                  </div>
					</tr>
  				@endforeach
  			</tbody>
  		</table>

  		<div class="text-center">
  			{!! $meetings->links() !!}
  		</div>

  	</div>
  </div>

@endsection



@section('js-link')

@stop

@section('page-script')
@stop





