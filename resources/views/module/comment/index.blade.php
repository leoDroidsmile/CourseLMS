@extends('layouts.master')
@section('title','Comments')
@section('parentPageTitle', 'All Ticket')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Course Latest Comments List)</h2>
            </div>
            <div class="float-right">
                <div class="row">
                </div>
            </div>
        </div>

        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead>
                <tr>
                    <th>S/L</th>
                    <th>@translate(Course)</th>
                    <th>@translate(Comment/ Last replay)</th>
                    <th>@translate(Date)</th>
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>
                @forelse($comments as  $item)
                    <tr>
                        <td>{{ ($loop->index+1) + ($comments->currentPage() - 1)*$comments->perPage() }}</td>
                        <td class="text-left"><a target="_blank" href="{{ route('course.show',[$item->course->id,$item->course->slug])}}">{{$item->course->title ?? 'N/A'}}</a>
                        </td>
                        <td>
                            <a target="_blank" href="{{ route('comments.show', $item->id) }}">
                               {{$item->comment}}
                                @if($item->replayLast->count() > 0)
                                <span class="badge badge-dark">
                                  {{ $item->replayLast->first()->user_id == \Illuminate\Support\Facades\Auth::id() ? '@translate(Send)' : '@translate(Reply)'}}
                              </span>
                                @endif
                            </a>

                        </td>
                        <td>
                            {{date('d-M-y',strtotime($item->created_at))}}
                        </td>
                        <td>
                            <div class="kanban-menu">
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                         aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                        <a class="dropdown-item" href="{{ route('comments.show', $item->id) }}">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Messages)</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td><h3 class="text-center">No Data Found</h3></td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                @endforelse
                </tbody>
                <div class="float-left">
                    {{ $comments->links() }}
                </div>
            </table>
        </div>
    </div>

@endsection

