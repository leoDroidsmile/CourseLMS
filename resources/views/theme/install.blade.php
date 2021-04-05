@extends('layouts.master')
@section('title','Addons Manager')
@section('parentPageTitle', 'Addons Manager')
@section('content')

    <div class="row mt-5">
        @for ($i = 0; $i < 6; $i++)
            <div class="col-md-4">
                <div class="card loader_card rounded overflow-hidden mb-3">
                    <div class="card__image loading rounded w-517"></div>
                    <div class="card__title loading"></div>
                    <div class="card__description loading"></div>
                </div>
            </div>
        @endfor
    </div>

    <div id="install_page"></div>

@endsection


@section('page-script')


<script>
        $(document).ready(function(){
            $('.loader_card').removeClass('d-none');
            $.get('{{ route('theme.get.install.page') }}', {_token:'{{ csrf_token() }}'},  function(data){
                $('#install_page').html(data);
                $('.loader_card').addClass('d-none');
            });
        });
</script>


@endsection
