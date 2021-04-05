
        {{-- HEADER --}}

        <div class="card shadow-sm mb-3 bg-white rounded">
            <div class="row">
                <div class="col-md-2">
                    <div class="card-header">Media Manager</div>
                </div>
                <div class="col-md-10">
                    <nav class="navbar">
                        <form class="form-inline">
                            <input class="form-control mr-sm-2 myInput border border-primary" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                        </form>
                    </nav>
                </div>
            </div>
        </div>

        {{-- ALl MEDIA --}}
        <div class="card mb-3">


            <div class="card-header">
                <div class="row">
                    <div class="col-md-3">
                        <a href="javascript:void()" onclick="forMediaModal('{{ route('media.create') }}', '@translate(Upload media)')" class="btn-sm btn-primary ml-2 text-white text-center">Upload Media <i class="fa fa-cloud-upload ml-2" aria-hidden="true"></i></a>
                    </div>
                    <div class="col-md-9">
                        <div class="d-flex justify-content-end">
                             <a href="#!" data-url="{{ route('media.filter', 'all') }}" data-value="all" onclick="filterMedia(this)" class="all_media p-3">All Media</a>
                        @if (Auth::user()->user_type == 'Admin')
                        <a href="#!" data-url="{{ route('media.filter', 'category') }}" data-value="category" onclick="filterMedia(this)" class="category_media p-3">Category</a>
                        <a href="#!" data-url="{{ route('media.filter', 'slider') }}" data-value="slider" onclick="filterMedia(this)" class="slider_media p-3">Slider</a>
                        <a href="#!" data-url="{{ route('media.filter', 'organization') }}" data-value="organization" onclick="filterMedia(this)" class="organizer_media p-3">Organization</a>
                        <a href="#!" data-url="{{ route('media.filter', 'package') }}" data-value="package" onclick="filterMedia(this)" class="package_media p-3">Package</a>
                        @endif
                        <a href="#!" data-url="{{ route('media.filter', 'source_code') }}" data-value="source_code" onclick="filterMedia(this)" class="source_code_media p-3">Source Code</a>
                        <a href="#!" data-url="{{ route('media.filter', 'thumbnail') }}" data-value="thumbnail" onclick="filterMedia(this)" class="thumbnail_media p-3">Thumbnail</a>
                        <a href="#!" data-url="{{ route('media.filter', 'file') }}" data-value="file" onclick="filterMedia(this)" class="file_media p-3">File</a>
                        </div>
                    </div>
                </div>
            </div>


            <!-- masonary -->
                <div class="container-fluid mt-3 mb-3">
                    <div class="row media_row">
                        @forelse ($medias as $media)
                            
                            <div class="col-md-3 col-sm-6 col-xl-3 mb-3 myTable">

                          
                                
                                <a href="javascript:void()" onclick="getImage(this)" data-image="{{ $media->image }}" class="media_select shadow-sm rounded">
                                    <div class="card m-2">
                                         @if ($media->alt == 'image')
                                        <img class="card-img" src="{{ filePath($media->image) }}" alt="{{ $media->alt }}">
                                        @endif
                                        @if ($media->alt == 'pdf')
                                        <img class="card-img w-50 m-auto" src="{{ filePath('pdf.png') }}" alt="{{ $media->alt }}">
                                        @endif
                                        @if ($media->alt == 'zip')
                                        <img class="card-img rounded w-50 m-auto" src="{{ filePath('zip.png') }}" alt="{{ $media->alt }}">
                                        @endif
                                        @if($media->alt == 'video')
                                            <video controls crossorigin playsinline id="player" class="w-100" src="{{ filePath($media->image)  }}"></video>
                                        @endif
                                        <span class="text-center text-dark">{{ $media->title }}</span>
                                    </div>
                                </a>

                                

                            </div>
                            
                        @empty

                            <div class="col-12 text-center">
                                <img src="{{ filePath('media-not-found.jpg') }}" class="img-fluid w-100" alt="#media not found">
                            </div>
                            
                        @endforelse
                    </div>
                </div>
            <!-- masonary:END -->
        </div>
        {{-- ALl MEDIA::END --}}

        <script>
        $(document).ready(function(){
      $(".myInput").on("keyup", function() {
	var value = $(this).val().toLowerCase();
	$(".myTable").filter(function() {
	  $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
	});
      });
    });
    </script>