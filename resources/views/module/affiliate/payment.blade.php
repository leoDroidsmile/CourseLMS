@extends('layouts.master')
@section('title','Payment History')
@section('parentPageTitle', 'All Student')
@section('content')
    <div class="card ">
        <div class="card-header bg-white">
            <div class="float-left">
                <h2 class="card-title">@translate(Affiliate Payment History )</h2>
            </div>
        </div>

        <div class="card-body bg-white table-responsive">
            <table class="table table-bordered table-hover text-center">
                <thead>
                <tr>
                    <th>S/L</th>
                    <th>@translate(Requested User)</th>
                    <th>@translate(Amount)</th>
                    <th>@translate(Description)</th>
                    <th>@translate(Requested On)</th>
                    <th>@translate(Info)</th>
                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                        <th>@translate(Process)</th>
                    @endif
                    <th>@translate(Status/Action)</th>
                </tr>
                </thead>
                <tbody>
                @forelse($request as  $item)
                    <tr>
                        <td>{{ ($loop->index+1) + ($request->currentPage() - 1)*$request->perPage() }}</td>
                        <td><a href="{{route('students.show',$item->user->id)}}"
                               target="_blank">{{$item->user->name}}</a></td>
                        <td>{{formatPrice($item->amount)}} </td>

                        <td>
                            {{$item->description}}
                        </td>
                        <td>
                            {{date('d-M-y',strtotime($item->created_at)) ?? 'N/A'}}
                        </td>
                        <td>
                            {{$item->status}}<br>
                            {{date('d-M-y',strtotime($item->status_change_date)) ?? 'N/A'}}
                        </td>
                        @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                            <td>
                                @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Admin" && $item->status != "Confirm")
                                    <a href="#!"
                                       onclick="forModal('{{route('student.account.details',[$item->student_account_id,$item->user_id,$item->process,$item->id])}}','@translate(Withdrawal Method)')"
                                       class="btn btn-warning">{{$item->process ?? 'N/A'}}
                                        @translate(Payment)
                                    </a>
                                @else
                                    <a href="#!"
                                       onclick="forModal('{{route('student.account.details',[$item->student_account_id,$item->user_id,$item->process,$item->id])}}','@translate(Withdrawal Method)')"
                                       class="btn btn-success">@translate(Paid on)
                                        {{$item->process ?? 'N/A'}}
                                    </a>
                                @endif


                            </td>
                        @endif
                        @if($item->status != 'Confirm'  && \Illuminate\Support\Facades\Auth::user()->user_type == "Instructor")
                            <td>
                                <div class="kanban-menu">
                                    <div class="dropdown">
                                        <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                                id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                                aria-expanded="false"><i class="feather icon-more-vertical-"></i>
                                        </button>

                                        <div class="dropdown-menu dropdown-menu-right action-btn"
                                             aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                            <a class="dropdown-item"
                                               onclick="confirm_modal('{{ route('payments.destroy', $item->id) }}')"
                                               href="#!">
                                                <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>

                                        </div>
                                    </div>
                                </div>
                            </td>
                        @elseif($item->status != 'Confirm'  && \Illuminate\Support\Facades\Auth::user()->user_type == "Admin")
                            <td title="confirm payment">
                                <a class="btn btn-secondary btn-sm" href="{{route('affiliate.payment.request.cancel',$item->id)}}">
                                    @translate(Request Cancel)
                                </a>
                            </td>
                        @else
                            <td title="payment done"><p class="text-success"><i
                                        class="fa fa-1x fas fa-check-square"></i></p></td>
                        @endif
                    </tr>
                @empty
                    <tr>
                        <td colspan="8"><h3 class="text-centers">@translate(No Data Found)</h3></td>
                    </tr>
                @endforelse
                </tbody>
                <div class="float-left">
                    {{ $request->links() }}
                </div>
            </table>
        </div>
    </div>

@endsection

