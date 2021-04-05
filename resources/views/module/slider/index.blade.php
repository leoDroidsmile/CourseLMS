@extends('layouts.master')
@section('title','Slider')
@section('parentPageTitle', 'All Sliders')
@section('content')
    <div class="card m-2">
        <div class="card-header">
            <div class="float-left">
                <h2 class="card-title">@translate(Slider List)</h2>
            </div>
            <div class="float-right">
                <div class="row">
                    <div class="col">
                        <a href="#!" onclick="forModal('{{ route("sliders.create") }}', '@translate(Slider Create)')"
                           class="btn btn-primary">
                            <i class="la la-plus"></i>
                            @translate(Add New Slider)
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="card-body">
            <table class="table table-striped- table-bordered table-hover">
                <thead class=" text-center">
                <tr>
                    <th>S/L</th>
                    <th>@translate(Image)</th>
                    <th>@translate(Title)</th>
                    <th>@translate(Publish)</th>
                    <th>@translate(Action)</th>
                </tr>
                </thead>
                <tbody>
                @forelse($sliders as  $item)
                    <tr>
                        <td class=" text-center">{{ ($loop->index+1) }}</td>
                        <td><img src="{{filePath($item->image)}}" class="img-fluid avatar-lg rounded-sm" ></td>
                        <td>
                            @translate(Title) : {{$item->title ?? 'N/A'}}<br>
                            @translate(Sub Title) : {{$item->sub_title ?? 'N/A'}}<br>
                            @translate(Link) : {{$item->link ?? 'N/A'}}<br>
                        </td>
                        <td class="text-center">
                            <div class="switchery-list">
                                <input type="checkbox" data-urls="{{route('sliders.published')}}" data-ids="{{$item->id}}"
                                       class="js-switch-success slider-published"
                                       id="category-switch" {{$item->is_published == true ? 'checked' : null}} />
                            </div>
                        </td>
                        <td>
                            <div class="kanban-menu">
                                <div class="dropdown">
                                    <button class="btn btn-link p-0 m-0 border-0 l-h-20 font-16" type="button"
                                            id="KanbanBoardButton1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false"><i class="feather icon-more-vertical-"></i></button>
                                    <div class="dropdown-menu dropdown-menu-right action-btn"
                                         aria-labelledby="KanbanBoardButton1" x-placement="bottom-end">
                                        <a class="dropdown-item" href="#!"
                                           onclick="forModal('{{ route('sliders.edit', $item->id) }}', '@translate(Slider Edit)')">
                                            <i class="feather icon-edit-2 mr-2"></i>@translate(Edit)</a>
                                        <a class="dropdown-item"
                                           onclick="confirm_modal('{{ route('sliders.destroy', $item->id) }}')"
                                           href="#!">
                                            <i class="feather icon-trash mr-2"></i>@translate(Delete)</a>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr></tr>
                    <tr></tr>
                    <tr>
                        <td><h3 class="text-center">@translate(No Data Found)</h3></td>
                    </tr>
                    <tr></tr>
                    <tr></tr>
                @endforelse
            </table>
        </div>
    </div>

@endsection
