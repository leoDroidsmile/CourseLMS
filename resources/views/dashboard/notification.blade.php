@extends('layouts.master')
@section('title','Notification')
@section('parentPageTitle', 'sample')

@section('css-link')

@stop

@section('page-style')

@stop

@section('content')
  <!-- BEGIN:content -->
  <div class="card m-b-30">
      <div class="card-body">

        <div class="row">
          <div class="col-md-6">
            <h4>@translate(Notifications)</h4>
          </div>
          <div class="col-md-6 text-right">
            <a href="{{ route('mark_all_read', Auth::user()->id) }}" class="">@translate(Mark as all read)</a>
          </div>

        </div>

          <div class="card m-b-30">
            @forelse ($notifications  as $notification)
              <div class="row no-gutters">
                <div class="col-md-12 rounded border border-light {{ $notification->is_read === 0 ? 'bg-ecf0f1' : '' }}">
                  <div class="card-body">
              @foreach ($notification->data as $item)

                      <h5 class="card-title font-18">
                        {{ $item }}
                       </h5>

              @endforeach

              <p class="card-text"><small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                <a href="{{ route('mark_as_read',Auth::user()->id) }}" class="stit-mark-as-read">@translate(Mark as read)</a>
              </p>

            </div>
          </div>
        </div>

            @empty

              <div class="card-body">
                <h5 class="card-title font-18 text-center">@translate(No new notifications yet)</h5>
              </div>

            @endforelse

            </div>


      </div>
  </div>
  <!-- END:content -->
@endsection

@section('js-link')

@stop

@section('page-script')

@stop
