
        {{-- HEADER --}}

        <div class="card mb-3">
            <div class="card-header">Media Library</div>
            <div class="card-body text-secondary">
                <form class="form-inline">
                <input type="text" class="form-control mb-2 mr-sm-2" id="inlineFormInputName2" placeholder="Search here">
                <button type="submit" class="btn btn-primary mb-2">Search</button>
                </form>
            </div>
        </div>

        {{-- ALl MEDIA --}}
        <div class="card border-secondary mb-3">

            <!-- masonary -->
                <div class="container-fluid mt-3 mb-3">
                    <div class="row">

                        @forelse ($medias as $media)
                            
                            <div class="col-3">
                                <div class="card bg-dark text-white m-2">
                                    <img class="card-img" src="{{ filePath($media->image) }}" alt="Card image">
                                </div>
                            </div>

                        @empty

                            <div class="col-12 text-center">
                                <img src="{{ filePath('media-not-found.jpg') }}" alt="#media not found" class="img-fluid w-100">
                            </div>
                            
                        @endforelse

                        
                    </div>
                </div>
            <!-- masonary:END -->
            
            <div class="card-footer text-muted">
                <a href="" class="btn btn-primary">Select</a>
            </div>

        </div>


        {{-- ALl MEDIA::END --}}