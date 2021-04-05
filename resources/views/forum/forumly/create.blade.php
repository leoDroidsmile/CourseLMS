@extends('forum.forumly.layouts.app')
@section('forum_title')
    @translate(Create New Question)
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content')

    @php
        $topics = App\Forum::latest()->take(6)->get();
        $all_topics = App\Forum::latest()->paginate(20);
    @endphp



<!-- Start Page Banner Area -->
    <div class="page-banner-area">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-title">
                        <h2>@translate(Create New Question)</h2>
                        <span class="sub-title"><a href="{{ route('forum.index') }}">Home </a> / @translate(Create New Question)</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Pages Banner Area -->


<!-- Start Questions Area -->
    <div class="question-area themeix-ptb">
        <div class="container">
            <div class="row">
                <!-- Start Question -->
                <div class="col-md-9">
                    <div class="questions-wrapper">

                        @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        <div class="dwqa-container">
							<form action="{{ route('forum.store') }}" method="POST" class="dwqa-content-edit-form">
                                @csrf
								<label for="question-title">Title*</label>
								<input id="question-title" type="text" placeholder="Question Title" name="title" required/>
								
								<label for="question-content">Question Details*</label>
								<textarea name="discussion" id="question-content" class="summernote" cols="30" rows="10" required></textarea>
								
								<label for="question-category">Category*</label>
								<select name="category" id="question-category" class="postform" required>
                                    <option value="">Select Category</option>
									@foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
								</select>								
                                
                                <button type="submit" type="submit" value="Submit" class="themeix-btn hover-bg">Submit Question</button>

							</form>
						

						
						</div>
                    </div>
                </div>
                <!-- End Question -->

                
                <!-- Start Blog Sidebar -->
                @includeWhen(true, forumComp('sidebar'))
                <!-- End Blog Sidebar -->
             
            </div>
        </div>
    </div>
    <!-- End  Questions Area -->
                

            </div>
        </div>
    </div>
    <!-- End Answers Area -->
   
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                placeholder: 'Write your question here',
                tabsize: 3,
                height: 300
            });
        });
    </script>

@endsection