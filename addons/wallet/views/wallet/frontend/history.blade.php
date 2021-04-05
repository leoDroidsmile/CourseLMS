@extends('frontend.app')
@section('content')
  <!-- ================================
      START DASHBOARD AREA
  ================================= -->
  <section class="dashboard-area">

      @include('frontend.dashboard.sidebar')
      <div class="dashboard-content-wrap">
             <div class="container-fluid">

                 <div class="row mt-5">
                     <div class="col-lg-12">
                         <div class="card-box-shared">
                             <div class="card-box-shared-title">
                                 <h3 class="widget-title">@translate(Redeemed Points History)</h3>
                             </div>
                             <div class="card-box-shared-body">
                                 <div class="statement-table purchase-table table-responsive mb-5">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col">@translate(S/L)</th>
                                             <th scope="col">@translate(Message)</th>
                                             <th scope="col">@translate(Points)</th>
                                             <th scope="col">@translate(Redeemed at)</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                           @forelse ($histories as $history)
                                             <tr>
                                                 <th scope="row">
                                                     <div class="statement-info">
                                                         <ul class="list-items">
                                                             <li>{{ $loop->iteration }}</li>
                                                         </ul>
                                                     </div>
                                                 </th>
                                                 <td>
                                                     <div class="statement-info">
                                                         <ul class="list-items">
                                                             <li>
                                                                {{ $history->message }}
                                                             </li>
                                                         </ul>
                                                     </div>
                                                 </td>
                                                 
                                                 <td>
                                                     <div class="statement-info">
                                                         <ul class="list-items">
                                                             <li>{{ $history->amount }}</li>
                                                         </ul>
                                                     </div>
                                                 </td>
                                                 
                                                 <td>
                                                     <div class="statement-info">
                                                         <ul class="list-items">
                                                             <li>{{ $history->created_at }}</li>
                                                         </ul>
                                                     </div>
                                                 </td>
                                                 
                                             </tr>

                                            @empty

                                            <tr>
                                                <td colspan="4">
                                                    @translate(No Purchase History)
                                                </td>
                                            </tr>

                                           @endforelse

                                         </tbody>
                                     </table>

                                     {{ $histories->links() }}

                                 </div>

                             </div>
                         </div>
                     </div><!-- end col-lg-12 -->
                 </div><!-- end row -->

             </div><!-- end container-fluid -->
         </div><!-- end dashboard-content-wrap -->

  </section><!-- end dashboard-area -->
  <!-- ================================
      END DASHBOARD AREA
  ================================= -->
@endsection
