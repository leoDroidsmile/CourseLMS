@extends('rumbok.app')
@section('content')
  <!-- ================================
      START DASHBOARD AREA
  ================================= -->
  <section class="dashboard-area">
      @include('rumbok.dashboard.sidebar')
      <div class="dashboard-content-wrap">
             <div class="container-fluid">

                 <div class="row mt-5">
                     <div class="col-lg-12">
                         <div class="card-box-shared">
                             <div class="card-box-shared-title">
                                 <h3 class="widget-title">@translate(My Purchase History)</h3>
                             </div>
                             <div class="card-box-shared-body">
                                 <div class="statement-table purchase-table table-responsive mb-5">
                                     <table class="table">
                                         <thead>
                                         <tr>
                                             <th scope="col">@translate(S/L)</th>
                                             <th scope="col">@translate(Item)</th>
                                             <th scope="col">@translate(Amount)</th>
                                             <th scope="col">@translate(Date)</th>
                                             <th scope="col">@translate(Method)</th>
                                         </tr>
                                         </thead>
                                         <tbody>
                                           @foreach ($p_histories as $p_history)
                                             <tr>
                                                 <th scope="row">
                                                     <div class="statement-info">
                                                         <ul class="list-items">
                                                             <li>{{ $loop->index+1 }}</li>
                                                         </ul>
                                                     </div>
                                                 </th>
                                                 <td>
                                                     <div class="statement-info">
                                                         <ul class="list-items">
                                                             <li>
                                                                 <a href="{{route('course.single',$p_history->course->slug)}}" class="d-inline-block">
                                                                     <img src="{{filePath($p_history->course->image)}}" alt="">
                                                                 </a>
                                                                 <a href="{{route('course.single',$p_history->course->slug)}}" class="d-inline-block primary-color">
                                                                    {{ $p_history->course->title }}
                                                                 </a>
                                                             </li>
                                                         </ul>
                                                     </div>
                                                 </td>
                                                 <td>
                                                     <div class="statement-info">
                                                         <ul class="list-items">
                                                             <li>{{ formatPrice($p_history->history->amount) }}</li>
                                                         </ul>
                                                     </div>
                                                 </td>
                                                 <td>
                                                     <div class="statement-info">
                                                         <ul class="list-items">
                                                             <li>{{ $p_history->history->created_at->format('M d, Y') }}</li>
                                                         </ul>
                                                     </div>
                                                 </td>
                                                  <td>
                                                     <div class="statement-info">
                                                         <ul class="list-items">
                                                             <li><span class="badge bg-success text-white p-1">{{ $p_history->history->payment_method }}</span></li>
                                                         </ul>
                                                     </div>
                                                 </td>
                                             </tr>
                                           @endforeach

                                         </tbody>
                                     </table>
                                 </div>

                             </div>
                         </div>
                     </div><!-- end col-lg-12 -->
                 </div><!-- end row -->
                 @include('rumbok.dashboard.footer')

             </div><!-- end container-fluid -->
         </div><!-- end dashboard-content-wrap -->

  </section><!-- end dashboard-area -->
  <!-- ================================
      END DASHBOARD AREA
  ================================= -->
@endsection
