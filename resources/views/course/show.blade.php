@extends('layouts.master')
@section('title','Course')
@section('parentPageTitle', 'Update Course')

@section('css-link')
    @include('layouts.include.form.form_css')
    @include('layouts.include.table.table_css')
@stop

@section('page-style')

@stop

@section('content')
    <!-- BEGIN:content -->


    <div class="card m-2">
        <div class="card-header">
            <div class="row">
                <div class="col-md-7"><h3 class="card-title">{{$course->title}}</h3></div>
                @if(\Illuminate\Support\Facades\Auth::user()->user_type != "Admin")
                    <div class="col-md-5">
                        <a href="#!"
                           onclick="forModal('{{ route("classes.create",$course_id) }}', '@translate(Add Class)')"
                           class="btn btn-primary mb-2">
                            <i class="la la-plus"></i>
                            @translate(Add New Class)
                        </a>

                        <a href="#!"
                           onclick="forModal('{{ route("classes.contents.create",$course_id) }}', '@translate(Add Class Content)')"
                           class="btn btn-primary mb-2">
                            <i class="la la-plus"></i>
                            @translate(Add Class Content)
                        </a>
                    </div>
                @else
                    <div class="col-md-4"></div>
                @endif
            </div>
        </div>

        <div class="card-body">
            @foreach ($course->classesAll as $item)
                <div class="col-xl-12">
                    <div class="card bg-light text-seconday on-hover-action mb-5" id="section-6">
                        <div class="card-body">
                            <h5 class="card-title">
                        <span class="font-weight-light">
                            @translate(Class) {{ $loop->index+ 1 }}</span> :
                                {{ $item->title }}

                                @if(\Illuminate\Support\Facades\Auth::user()->user_type != "Admin")
                                    <span class="p-3">
                                <a href="#!"
                                   onclick="forModal('{{ route("classes.edit",$item->id) }}', '@translate(Add Class)')">
                                    <i class="feather icon-edit-1"></i>
                                </a>

                                <a onclick="confirm_modal('{{ route('classes.destroy',$item->id) }}')" href="#!">
                                    <i class="feather icon-trash"></i>
                                </a>
                            </span>

                                @endif

                            </h5>
                            <div class="clearfix"></div>
                            <div class="col-md-12 table-responsive">

                                <table id="table" class="table table-bordered table-striped">
                                    <tbody class="tablecontents">
                                    @foreach ($item->contentsAll as $content)
                                        <tr class="row bg-white grab mb-2" data-id="{{ $content->id }}">
                                            <td class="w-100">
                                                <i class="fa fa-arrows grab-icon"></i>
                                                {{ $content->title }}

                                                <a href="#!"
                                                   onclick="forModal('{{ route("classes.contents.show",$content->id) }}', '{{$content->title}}')">
                                            <span class="nest-span-eye">
                                                <i class="feather icon-eye"></i>
                                            </span>
                                                </a>
                                                @if(\Illuminate\Support\Facades\Auth::user()->user_type =="Instructor")
                                                    <a onclick="confirm_modal('{{ route('classes.contents.destroy',$content->id) }}')"
                                                       href="#!">
                                            <span class="nest-span-trash">
                                                <i class="feather icon-trash"></i>
                                            </span>
                                                    </a>

                                                    <div class="d-flex pl-5">
                                                        <div class="switchery-list mx-2">
                                                            <input type="checkbox"
                                                                   data-url="{{route('class.content.published')}}"
                                                                   data-id="{{$content->id}}"
                                                                   class="js-switch-primary"
                                                                   id="category-switch" {{$content->is_published == true ? 'checked' : null}} />
                                                            <span>@translate(Published)</span>
                                                        </div>

                                                        <div class="switchery-list mx-2">
                                                            <input type="checkbox"
                                                                   data-url="{{route('class.content.preview')}}"
                                                                   data-id="{{$content->id}}"
                                                                   class="js-switch-warning"
                                                                   id="category-switch" {{$content->is_preview == true ? 'checked' : null}} />
                                                            <span>@translate(Preview)</span>
                                                        </div>
                                                    </div>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div> <!-- end card-body-->
                    </div> <!-- end card-->
                </div>
            @endforeach
        </div>
    </div>
    <!-- END:content -->
@endsection

@section('js-link')
    @include('layouts.include.form.form_js')
    @include('layouts.include.table.table_js')
@stop

@section('page-script')
    <script type="text/javascript" src="{{ asset('assets/js/custom/class.js') }}"></script>
    <script type="text/javascript">
        "use strict"
        $(document).ready(function () {
            $(".tablecontents").sortable({
                items: "tr",
                cursor: 'move',
                opacity: 0.6,
                update: function () {
                    @if(\Illuminate\Support\Facades\Auth::user()->user_type == "Instructor")
                    sendOrderToServer();
                    @endif
                }
            });

            function sendOrderToServer() {
                var order = [];
                var token = $('meta[name="csrf-token"]').attr('content');
                $('tr.row').each(function (index, element) {
                    order.push({
                        id: $(this).attr('data-id'),
                        position: index + 1
                    });
                });

                $.ajax({
                    method: "GET",
                    url: "{{ route('content.short') }}",
                    data: {
                        order: order
                    },
                    success: function (response) {
                        //response goes here
                        $('#my_lms_soft').append(response);
                    }
                });
            }
        })

    </script>
@stop
