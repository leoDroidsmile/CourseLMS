

<main id="tt-pageContent" class="tt-offset-small">
    <div class="container">
        <div class="tt-topic-list">
            <div class="tt-list-header">
                <div class="tt-col-topic">Topic</div>
                <div class="tt-col-category">Category</div>
                <div class="tt-col-value hide-mobile">Replies</div>
                <div class="tt-col-value hide-mobile">Views</div>
                <div class="tt-col-value">Activity</div>
            </div>

            <div class="tt-topic-alert tt-alert-default header-photo blur-shadow" >
              {{ App\Forum::count()  }} new posts are added today.
            </div>

            {{-- ajax data --}}
            <div id="posts" class="blur-shadow"></div>

            <div class="tt-topic-alert tt-alert-default footer-photo blur-shadow" role="alert">
              {{ App\Forum::count()  }} new posts are added today.
            </div>

        </div>
    </div>
</main>

    <input type="hidden" value="{{ route('forum.all.posts') }}" id="forum_all_posts">
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>
    <script>
        "use strict"
           $(document).ready(function(){

            var url  = $('#forum_all_posts').val();

            // ajax setup
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $.ajax({
            type: 'GET',
            url: url,
            success: function(data) {
                
                if (data.length > 0) {
                    $('#posts').html(data);
                }else{
                    $('#posts').html('<img src="{{ asset('forum-not-found.png') }}">');
                }
            }
            });

        });
    </script>
