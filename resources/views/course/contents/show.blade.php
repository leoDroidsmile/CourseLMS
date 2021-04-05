

<div class="card">

    <div class="text-center">
        @if (isset($each_contents->video_url))
            @if ($each_contents->provider === "Youtube")

                <iframe width="100%" height="315"
                        src="https://www.youtube.com/embed/{{ Str::after($each_contents->video_url,'https://youtu.be/') }}"
                        frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                        allowfullscreen></iframe>
            @elseif(($each_contents->provider === "Vimeo"))
                <iframe
                    src="https://player.vimeo.com/video/{{ Str::after($each_contents->video_url,'https://vimeo.com/') }}"
                    width="640" height="360" frameborder="0" allow="autoplay; fullscreen" allowfullscreen></iframe>

            @elseif(($each_contents->provider === "Live"))
                <a href="{{ filePath($each_contents->video_url) }}" target="_blank" title="Live Class URL">
                    <img src="{{ filePath('live.jpg') }}" class="w-100" alt="#Liveclass">
                </a>

            @elseif(($each_contents->provider === "File"))
                <video controls crossorigin playsinline id="player" class="w-100" src="{{ filePath($each_contents->video_url)  }}"></video>

            @else
                <video controls crossorigin playsinline id="player" class="w-100" src="{{ filePath($each_contents->video_url)  }}"></video>

            @endif

        @endif
        @if (isset($each_contents->file))
            <img class="card-img-top img-fluid file-type" src="{{ asset('img/file.png') }}" alt="Pic">
        @endif
    </div>

    <div class="card-body">
        <h5 class="card-title font-18">@translate(Content Type): {{ $each_contents->content_type }} </h5>

        <h5 class="card-title font-18">@translate(Video Duration):{{duration($each_contents->duration)}}</h5>

        @if (isset($each_contents->video_url))
            <h5 class="card-title font-18">@translate(Provider): {{ $each_contents->provider }}</h5>
        @endif

        <h5 class="card-title font-18">@translate(Description):
          {!! $each_contents->description !!}
        </h5>

        @if (isset($each_contents->source_code))
            <h5 class="card-title font-18">@translate(Source Code): <a
                    href="{{ route('classes.contents.code',$each_contents->id) }}" class="btn-sm btn-primary"> <i
                        class="feather icon-download"></i> </a></h5>
        @else
            <h5 class="card-title font-18">@translate(Source Code): @translate(No source code available)</h5>
        @endif

    </div>
</div>
