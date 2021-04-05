{{-- POPUP ADDONS --}}
    <!-- Button trigger modal -->

            <div class="news">
                <figure class="article">
                    <a href="javascript:void()">
                        <img src="{{ filePath($preview_addon->image) }}" class="img-fluid w-100 rounded" alt="{{ $preview_addon->name }}">
                    </a>
                </figure>

                @if ($preview_addon->name == 'paytm')
                    
                <div class="card-body bg-light">
                    <h5>
                        Paytm payment gateway addon for CourseLMS. Customer can checkout through Paytm. Install this addon for Paytm service. <br> Click on buy now and get this addon from codecanyon.
                    </h5>

                    <ul class="list-group list-group-flush">
                        <li class="list-group-item"><i class="fa fa-check-square-o" aria-hidden="true"></i> One click installation</li>
                        <li class="list-group-item"><i class="fa fa-check-square-o" aria-hidden="true"></i> Paytm credentials support</li>
                        <li class="list-group-item"><i class="fa fa-check-square-o" aria-hidden="true"></i> Enable/Disable at anytime.</li>
                        <li class="list-group-item"><i class="fa fa-check-square-o" aria-hidden="true"></i> Paytm payment gateway support.</li>
                    </ul>

                </div>
                @endif


                


                <a href="{{ route('addon.status', $preview_addon->name) }}" class="btn btn-{{ env('PAYTM_ACTIVE') == 'NO' ? 'success' : 'danger' }} w-100">{{ env('PAYTM_ACTIVE') == 'NO' ? 'Activate' : 'Deactivate' }}</a>


            </div>

    {{-- POPUP ADDONS::END --}}