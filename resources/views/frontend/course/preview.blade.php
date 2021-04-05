@if (isset($content->video_url))
    @if ($content->provider === "Youtube")

        <iframe width="100%" height="315"
                src="https://www.youtube.com/embed/{{ Str::after($content->video_url,'https://youtu.be/') }}"
                frameborder="0"
                allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>

    @elseif($content->provider === "Vimeo")
        <iframe
            src="https://player.vimeo.com/video/{{ Str::after($content->video_url,'https://vimeo.com/') }}"
            width="640" height="360" frameborder="0" allow="autoplay; fullscreen"
            allowfullscreen></iframe>
    @elseif($content->provider === "HTML5")
        <video controls crossorigin playsinline id="player" class="w-100" src="{{$content->video_url}}">
            <source src="{{$content->video_url}}"
                    type="video/mp4" size="640"/>
        </video>
    @else
        <video controls crossorigin playsinline id="player" class="w-100" src="{{filePath($content->video_url)}}">
            <source src="{{filePath($content->video_url)}}"
                    type="video/mp4" size="640"/>
        </video>
    @endif

@endif


