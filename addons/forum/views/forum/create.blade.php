

<div class="container">
        <div class="tt-wrapper-inner">
            <h1 class="tt-title-border">
                Create New Topic
            </h1>
            <form class="form-default form-create-topic">


                <div class="form-group">
                    <label for="title">Topic Title</label>
                    <div class="tt-value-wrapper">
                        <input type="text" name="name" class="form-control" id="title" placeholder="Subject of your topic">
                    </div>
                    <div class="tt-note">Describe your topic well, while keeping the subject as short as possible.</div>
                    
                </div>

                <div class="pt-editor">
                    <h6 class="pt-title">Topic Body</h6>
                    <small>Double click to highlight text</small>

                    <div class="form-group post-textarea rounded shadow">
                        <textarea name="discussion" id="discussion" class="form-control h-200 editable" rows="5" placeholder="Lets get started"></textarea>
                        
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="inputTopicTitle">Category</label>
                                <select class="form-control" name='category' id="category">
                                    <option value="">Select Category</option>
                                    
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                   
                                </select>
                            </div>
                        </div>

                    </div>
                     <div class="row">
                        <div class="col-auto ml-md-auto">
                            <a href="javascript:void(0)" class="btn btn-secondary btn-width-lg" id="submitPost">Create Post</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>


        <div class="tt-topic-list tt-offset-top-30">
            <div class="tt-list-search">
                <div class="tt-title">Your Topics</div>
                
            </div>
            <div class="tt-list-header tt-border-bottom">
                <div class="tt-col-topic">Topic</div>
                <div class="tt-col-category">Category</div>
                <div class="tt-col-value hide-mobile">Replies</div>
                <div class="tt-col-value hide-mobile">Views</div>
                <div class="tt-col-value">Activity</div>
            </div>

            {{-- ajax data --}}
            <div id="posts"></div>

        </div>
    </div>

    <input type="hidden" value="{{ route('forum.store') }}" id="forum_store">
    <input type="hidden" value="{{ route('forum.my.posts') }}" id="forum_my_posts">
    <script src="{{ asset('assets/js/jquery.js') }}"></script>
    <script src="{{ asset('assets/js/popper.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.js') }}"></script>

    <script>

        "use strict"

        $('#submitPost').on('click', function(){

            var url  = $('#forum_store').val();
            var title  = $('#title').val();
            var discussion  = $('#discussion').val();
            var category  = $('#category').children("option:selected").val();

            // ajax setup
            $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

            $.ajax({
            type: 'POST',
            url: url,
            data: {
                title: title,
                discussion: discussion,
                category:category
            },
            success: function(data) {
                $('#title').val('');
                $('#discussion').val('');
                $('#category:selected').val('');
                getPostList();
            }
            });

        });

        // getPostList
        function getPostList() {

            var url  = $('#forum_my_posts').val();

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
                    $('#posts').html('<img src="{{ asset('forum-not-found.png') }}" alt="No Post Found">');
                }
            }
                
            });
        }


        $(document).ready(function(){
            getPostList();

var editor = new MediumEditor('.editable', {
    toolbar: true,
    spellcheck: true,
    cleanPastedHTML: true,
    targetBlank: true,
    placeholder: {
        text: 'Write an topic'
    },
    keyboardCommands: {
        /* This example includes the default options for keyboardCommands,
           if nothing is passed this is what it used */
        commands: [
            {
                command: 'bold',
                key: 'b',
                meta: true,
                shift: false
            },
            {
                command: 'italic',
                key: 'i',
                meta: true,
                shift: false
            },
            {
                command: 'underline',
                key: 'u',
                meta: true,
                shift: false
            }
        ],
    },
    showWhenToolbarIsVisible:true,
    sticky:true,
    buttons:['bold', 'italic', 'underline', 'anchor', 'h2', 'h3', 'quote'],
    keyboardCommands: true,
    hideOnClick: false,

});

        

    });




    </script>
