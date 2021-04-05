@extends('layouts.master')
@section('title','Media Manager')
@section('parentPageTitle', 'Media Manager')


@section('css-link')@stop

@section('page-style')

@stop

@section('content')
 
<div class="row">
@for ($i = 0; $i < 8; $i++)
    <div class="col-md-3">
        <div class="card loader_card rounded overflow-hidden mb-3"> 
            <div class="card__image loading rounded"></div> 
            <div class="card__title loading"></div> 
            <div class="card__description loading"></div> 
        </div>
    </div>
    @endfor
</div>

<div id="media_section"></div>

@endsection


@section('js-link')

@endsection

@section('page-script')

 <script>
        $(document).ready(function(){
            $('.loader_card').removeClass('d-none');
            $.post('{{ route('media.main') }}', {_token:'{{ csrf_token() }}'},  function(data){
                $('#media_section').html(data);
                $('.loader_card').addClass('d-none');
            });
        });
    </script>

@endsection
