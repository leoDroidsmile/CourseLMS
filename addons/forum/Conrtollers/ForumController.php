<?php

namespace App\Http\Controllers;

use App\HelpfulAnswer;
use Illuminate\Http\Request;
use Auth;
use App\Forum;
use App\PostReply;
use App\Model\Category;
use App\ForumPostView;
use Carbon\Carbon;

class ForumController extends Controller
{
    // index
    public function index()
    {
        switch (env('FORUM_UI')) {
            case 'legacy':
                return view('forum.layouts.app');
                break;

            case 'forumly':
                return view('forum.forumly.index');
                break;
            
            default:
                return view('forum.layouts.app');
                break;
        }
    }

    // posts
    public function posts()
    {
        return view('forum.posts');
    }

    // all_posts
    public function all_posts()
    {

        switch (env('FORUM_UI')) {
            case 'legacy':
                
                $posts = Forum::latest()->get();
                $sendPosts = '';
                foreach($posts as $post){

                    $post_replies_count = PostReply::where('post_id', $post->id)->count();
                    $post_views_count = ForumPostView::where('post_id', $post->id)->count();

                    $sendPosts .= '
                        <div class="tt-item tt-itemselect">
                        <div class="tt-col-description">
                            <h6 class="tt-title"><a onclick="singlePost(this)" data-id="'. $post->id .'" id="post-'. $post->id .'" href="javascript:void(0)">
                            '. $post->title .'
                            </a></h6>
                            <div class="row align-items-center no-gutters">
                                <div class="col-1 ml-auto show-mobile">
                                    <div class="tt-value">'. $post_replies_count .'</div>
                                </div>
                            </div>
                        </div>
                        <div class="tt-col-category"><span class="tt-color01 tt-badge">'. $post->categoryName->name .'</span></div>
                        <div class="tt-col-value tt-color-select hide-mobile">'. $post_replies_count .'</div>
                        <div class="tt-col-value hide-mobile">'. $post_views_count .'</div>
                        <div class="tt-col-value hide-mobile">
                            '. $post->created_at->diffForHumans() .'
                        </div>
                    </div>
                    <input type="hidden" class="singlePost" value="'.route('forum.single', $post->id).'">
                    ';
                }
                return $sendPosts;

                break;

            case 'forumly':
                return view('forum.forumly.all_posts');
                break;
            
            default:
                
                $posts = Forum::latest()->get();
                $sendPosts = '';
                foreach($posts as $post){

                    $post_replies_count = PostReply::where('post_id', $post->id)->count();
                    $post_views_count = ForumPostView::where('post_id', $post->id)->count();

                    $sendPosts .= '
                        <div class="tt-item tt-itemselect">
                        <div class="tt-col-description">
                            <h6 class="tt-title"><a onclick="singlePost(this)" data-id="'. $post->id .'" id="post-'. $post->id .'" href="javascript:void(0)">
                            '. $post->title .'
                            </a></h6>
                            <div class="row align-items-center no-gutters">
                                <div class="col-1 ml-auto show-mobile">
                                    <div class="tt-value">'. $post_replies_count .'</div>
                                </div>
                            </div>
                        </div>
                        <div class="tt-col-category"><span class="tt-color01 tt-badge">'. $post->categoryName->name .'</span></div>
                        <div class="tt-col-value tt-color-select hide-mobile">'. $post_replies_count .'</div>
                        <div class="tt-col-value hide-mobile">'. $post_views_count .'</div>
                        <div class="tt-col-value hide-mobile">
                            '. $post->created_at->diffForHumans() .'
                        </div>
                    </div>
                    <input type="hidden" class="singlePost" value="'.route('forum.single', $post->id).'">
                    ';
                }
                return $sendPosts;

                break;
        }

        
        
    }

    // my_posts
    public function my_posts()
    {

        
        $posts = Forum::where('user_id', Auth::user()->id)->latest()->get();
        $sendPosts = '';


        foreach($posts as $post){

            $post_replies_count = PostReply::where('post_id', $post->id)->count();
            $post_views_count = ForumPostView::where('post_id', $post->id)->count();

            $sendPosts .= '
                <div class="tt-item tt-itemselect">
                <div class="tt-col-description">
                    <h6 class="tt-title"><a onclick="singlePost(this)" data-id="'. $post->id .'" id="post-'. $post->id .'" href="javascript:void(0)">
                       '. $post->title .'
                    </a></h6>
                    <div class="row align-items-center no-gutters">
                        <div class="col-1 ml-auto show-mobile">
                            <div class="tt-value">1h</div>
                        </div>
                    </div>
                </div>
                <div class="tt-col-category"><span class="tt-color01 tt-badge">'. $post->categoryName->name .'</span></div>
                <div class="tt-col-value tt-color-select hide-mobile">'. $post_replies_count .'</div>
                <div class="tt-col-value hide-mobile">'. $post_views_count .'</div>
                <div class="tt-col-value hide-mobile">
                    '. $post->created_at->diffForHumans() .'
                </div>
            </div>
            <input type="hidden" class="singlePost" value="'.route('forum.single', $post->id).'">
            ';
            
        }

        return $sendPosts;
    }

    // create
    public function create()
    {
        $your_posts = Forum::where('user_id', 1)->latest()->get();
        $categories = Category::all();
        

        switch (env('FORUM_UI')) {
            case 'legacy':
                return view('forum.create', compact('your_posts','categories'));
                break;

            case 'forumly':
                return view('forum.forumly.create', compact('your_posts','categories'));
                break;
            
            default:
                return view('forum.create', compact('your_posts','categories'));
                break;
        }

        
    }

    // create
    public function store(Request $request)
    {

        $this->validate($request,[
            'title'=>'required',
            'discussion'=>'required',
            'category'=>'required'
        ],[
            'title.required' => 'Title is requried',
            'discussion.required' => 'Question details is requried',
            'category.required' => 'Category is requried',
        ]);

        

        switch (env('FORUM_UI')) {
            case 'legacy':
                $forum =new  Forum();
                $forum->user_id = Auth::user()->id;
                $forum->title = $request->title;
                $forum->discussion = $request->discussion ?? null;
                $forum->category = $request->category ?? null;
                $forum->save();
                return response()->json('success',200);
                break;

            case 'forumly':
                $forum =new  Forum();
                $forum->user_id = Auth::user()->id;
                $forum->title = $request->title;
                $forum->discussion = $request->discussion ?? null;
                $forum->category = $request->category ?? null;
                $forum->save();
                return back();
                break;
            
            default:
                $forum =new  Forum();
                $forum->user_id = Auth::user()->id;
                $forum->title = $request->title;
                $forum->discussion = $request->discussion ?? null;
                $forum->category = $request->category ?? null;
                $forum->save();
                return response()->json('success',200);
                break;
        }

    }

    // trending
    public function show(Request $request,$id)
    {


        switch (env('FORUM_UI')) {
            case 'legacy':
                if($id == null){
                    $single_post = Forum::where('id', $request->postId)->with('username')->first();
                    $total_reply = PostReply::where('post_id', $request->postId)->count();
                }else{
                    $single_post = Forum::where('id', $id)->with('username')->first();
                    $total_reply = PostReply::where('post_id', $id)->count();
                }
                

                try {
                    if (Auth::check()) {
                    $post_views = ForumPostView::where('post_id', $request->postId)->first();

                    if ($post_views === null) {
                        $views = new ForumPostView();
                        $views->post_id = $request->postId;
                        $views->user_id = Auth::user()->id;
                        $views->ip_address = $request->ip();
                        $views->save();
                    }
                }
                } catch (\Throwable $th) {
                    //throw $th;
                }

                return view('forum.single', compact('single_post','total_reply'));
                break;

            case 'forumly':

                    $single_post = Forum::where('id', $id)->with('username')->first();
                    $total_reply = PostReply::where('post_id', $id)->count();

                    $post_replies = PostReply::where('post_id', $single_post->id)->get();
          
                

                try {
                    if (Auth::check()) {
                    $post_views = ForumPostView::where('post_id', $single_post->id)->first();

                    if ($post_views === null) {
                        $views = new ForumPostView();
                        $views->post_id = $single_post->id;
                        $views->user_id = Auth::user()->id;
                        $views->ip_address = $request->ip();
                        $views->save();
                    }
                }
                } catch (\Throwable $th) {
                    //throw $th;
                }
                
                return view('forum.forumly.single', compact('single_post','total_reply','post_replies'));
                break;
            
            default:
                if($id == null){
                    $single_post = Forum::where('id', $request->postId)->with('username')->first();
                    $total_reply = PostReply::where('post_id', $request->postId)->count();
                }else{
                    $single_post = Forum::where('id', $id)->with('username')->first();
                    $total_reply = PostReply::where('post_id', $id)->count();
                }
                

                try {
                    if (Auth::check()) {
                    $post_views = ForumPostView::where('post_id', $request->postId)->first();

                    if ($post_views === null) {
                        $views = new ForumPostView();
                        $views->post_id = $request->postId;
                        $views->user_id = Auth::user()->id;
                        $views->ip_address = $request->ip();
                        $views->save();
                    }
                }
                } catch (\Throwable $th) {
                    //throw $th;
                }

                return view('forum.single', compact('single_post','total_reply'));
                break;
        }
        
        
    }

    // share
    public function share($id)
    {
            $single_post = Forum::where('id', $id)->with('username')->first();
            $total_reply = PostReply::where('post_id', $id)->count();

        try {

            if (Auth::check()) {
                $post_views = ForumPostView::where('post_id',  $id)->first();

                if ($post_views === null) {
                    $views = new ForumPostView();
                    $views->post_id =  $id;
                    $views->user_id = Auth::user()->id;
                    $views->ip_address = $request->ip();
                    $views->save();
                }
            }

        } catch (\Throwable $th) {
            //throw $th;
        }

        return view('forum.share', compact('single_post','total_reply'));
    }

    //reply
    public function reply(Request $request)
    {

        $this->validate($request,[
            'reply'=>'required',
        ],[
            'reply.required' => 'Reply is requried',
        ]);


        switch (env('FORUM_UI')) {
            case 'legacy':
                $reply = new PostReply();
                $reply->reply = $request->reply;
                $reply->post_id = $request->post_id;
                $reply->user_id = Auth::user()->id;
                $reply->save();
                return response()->json('success',200);
                break;

            case 'forumly':
                $reply = new PostReply();
                $reply->reply = $request->reply;
                $reply->post_id = $request->post_id;
                $reply->user_id = Auth::user()->id;
                $reply->save();
                return back();
                break;
            
            default:
                $reply = new PostReply();
                $reply->reply = $request->reply;
                $reply->post_id = $request->post_id;
                $reply->user_id = Auth::user()->id;
                $reply->save();
                return response()->json('success',200);
                break;
        }

        
    }


    // getReply
    public function getReply(Request $request)
    {
        $post_replies = PostReply::where('post_id', $request->forum_post_id)->get();
        $helpful_count = HelpfulAnswer::where('post_id', $request->forum_post_id)->count();
        $total_replies = PostReply::where('post_id', $request->forum_post_id)->count();


        $helpful = HelpfulAnswer::where('post_id',$request->forum_post_id)->first();

        $auth_check =  Auth::check() ? 'javascript:void(0)' : route('login');


        $replyData = '';

        foreach ($post_replies as $post_reply){

            $loveCount = HelpfulAnswer::where('post_reply_id',$post_reply->id)->count();

            if (Auth::check()) {
                if ($loveCount == 0){
                $class = "fa-heart-o";
                }else{
                    $class = "fa-heart";
                }
            }else{
                $class = "fa-heart-o";
            }

            $replyData .= '<div class="tt-item">
                 <div class="tt-single-topic">
                    <div class="tt-item-header pt-noborder">
                        <div class="tt-item-info info-top">
                            <div class="tt-avatar-icon">
                                <img src="'. asset($post_reply->user->image) .'" class="img-fluid rounded w-8">
                            </div>
                            <div class="tt-avatar-title">
                            
                               <strong>'.$post_reply->user->name.'</strong>
                            </div>

                                '. $post_reply->created_at->diffForHumans() .'

                        </div>
                    </div>
                    <div class="tt-item-description">
                        '.$post_reply->reply.'
                    </div>
                    <div class="tt-item-info info-bottom">

                        <a href="'. $auth_check .'" data-replyid="'. $post_reply->id .'" data-id="love-'. $post_reply->id .'" class="tt-icon-btn" onclick="helpful(this)">
                            <i class="fa '.$class.'" id="love-'.$post_reply->id.'" aria-hidden="true"></i>
                            <span class="tt-text helpful_count" id="lovecount-'. $post_reply->id .'"> '. $loveCount .'</span>
                        </a>

                    </div>
                </div>
            </div> ';
        }
        return response()->json(['replyData' => $replyData, 'total_replies' => $total_replies]);
    }

    public function helpful(Request $request){

        $helpful = HelpfulAnswer::where('post_reply_id',$request->reply_id)->first();
        if ($helpful == null){
            $h = new HelpfulAnswer();
            $h->post_reply_id = $request->reply_id;
            $h->post_id = $request->post_id;
            $h->user_id = Auth::user()->id;
            $h->save();
            $class = "fa-heart";
            $remove_class = "fa-heart-o";
        }else{
            $helpful->delete();
            $class = "fa-heart-o";
            $remove_class = "fa-heart";
        }

        $helpful_count = HelpfulAnswer::where('post_reply_id', $request->reply_id)->where('post_id', $request->post_id)->count();

        return response()->json(['helpful_count' => $helpful_count, 'love' => $class,'remove_love'=>$remove_class]);
    }


    // forum_search
    public function forum_search(Request $request)
    {
        


        switch (env('FORUM_UI')) {
            case 'legacy':
                $searchingFor = $request->input;
                $results = Forum::where('title','LIKE','%' . $request->input . '%')->get();
                $sendData = '';
                foreach($results as $result)
                {
                    if ($result->count() > 0) {
                        $sendData .=
                            '
                            <div class="col-12 bg-gray">
                                <a onclick="singlePost(this)" data-id="'. $result->id .'" id="post-'. $result->id .'" href="javascript:void(0)">' . $result->title . '</a>
                            </div>
                            ';
                    }else{
                        $sendData .=
                            '
                            <div class="col-12 bg-gray">
                                <span>No Post Found</span>
                            </div>
                            ';
                    }
                    
                }
                return $sendData;
                break;

            case 'forumly':
                $searchingFor = $request->qs;
                $results = Forum::where('title','LIKE','%' . $request->qs . '%')->get();
                return view('forum.forumly.search', compact('results', 'searchingFor'));
                break;
            
            default:
                $searchingFor = $request->input;
                $results = Forum::where('title','LIKE','%' . $request->input . '%')->get();
                $sendData = '';
                foreach($results as $result)
                {
                    if ($result->count() > 0) {
                        $sendData .=
                            '
                            <div class="col-12 bg-gray">
                                <a onclick="singlePost(this)" data-id="'. $result->id .'" id="post-'. $result->id .'" href="javascript:void(0)">' . $result->title . '</a>
                            </div>
                            ';
                    }else{
                        $sendData .=
                            '
                            <div class="col-12 bg-gray">
                                <span>No Post Found</span>
                            </div>
                            ';
                    }
                    
                }
                return $sendData;
                break;

             
        }
    }


    // forum_panel
    

    public function forum_panel()
    {

        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        if (Auth::user()->user_type === 'Admin') {
            $forums = Forum::latest()->paginate(20);


            

        // Forum
        $posts_count = Forum::count();
        $posts_today = Forum::where('created_at', $today)->count();
        $posts_yesterday = Forum::where('created_at', $yesterday)->count();

        if ($posts_today > $posts_yesterday) {
            $post_compare = 'icon-arrow-up text-success';
        }else{
            $post_compare = 'icon-arrow-down text-danger';
        }
        // Forum::END

        // PostReply
        $replies_count = PostReply::count();
        $replies_today = PostReply::where('created_at', $today)->count();
        $replies_yesterday = PostReply::where('created_at', $yesterday)->count();

        if ($replies_today > $replies_yesterday) {
            $replies_compare = 'icon-arrow-up text-success';
        }else{
            $replies_compare = 'icon-arrow-down text-danger';
        }
        // PostReply::END

        // ForumPostView
        $views_count = ForumPostView::count();
        $views_today = ForumPostView::where('created_at', $today)->count();
        $views_yesterday = ForumPostView::where('created_at', $yesterday)->count();

        if ($views_today > $views_yesterday) {
            $views_compare = 'icon-arrow-up text-success';
        }else{
            $views_compare = 'icon-arrow-down text-danger';
        }
        // ForumPostView::END


        }else{
            $forums = Forum::where('user_id', Auth::user()->id)->latest()->paginate(20);


        

        // Forum
        $posts_count = Forum::where('user_id', Auth::user()->id)->count();
        $posts_today = Forum::where('user_id', Auth::user()->id)->where('created_at', $today)->count();
        $posts_yesterday = Forum::where('user_id', Auth::user()->id)->where('created_at', $yesterday)->count();

        if ($posts_today > $posts_yesterday) {
            $post_compare = 'icon-arrow-up text-success';
        }else{
            $post_compare = 'icon-arrow-down text-danger';
        }
        // Forum::END

        // PostReply
        $replies_count = PostReply::where('user_id', Auth::user()->id)->count();
        $replies_today = PostReply::where('user_id', Auth::user()->id)->where('created_at', $today)->count();
        $replies_yesterday = PostReply::where('user_id', Auth::user()->id)->where('created_at', $yesterday)->count();

        if ($replies_today > $replies_yesterday) {
            $replies_compare = 'icon-arrow-up text-success';
        }else{
            $replies_compare = 'icon-arrow-down text-danger';
        }
        // PostReply::END

        // ForumPostView
        $views_count = ForumPostView::where('user_id', Auth::user()->id)->count();
        $views_today = ForumPostView::where('created_at', $today)->count();
        $views_yesterday = ForumPostView::where('created_at', $yesterday)->count();

        if ($views_today > $views_yesterday) {
            $views_compare = 'icon-arrow-up text-success';
        }else{
            $views_compare = 'icon-arrow-down text-danger';
        }
        // ForumPostView::END

        }
        
        return view('forum.panel.index', compact(
            'forums', 
            'posts_count', 
            'post_compare',
            'replies_count',
            'replies_compare',
            'views_count',
            'views_compare'
        ));
    }

    // forum_replies

    public function forum_replies()
    {
        $replies = PostReply::latest()->paginate(20);


        $today = Carbon::today();
        $yesterday = Carbon::yesterday();

        // Forum
        $posts_count = Forum::count();
        $posts_today = Forum::where('created_at', $today)->count();
        $posts_yesterday = Forum::where('created_at', $yesterday)->count();

        if ($posts_today > $posts_yesterday) {
            $post_compare = 'icon-arrow-up text-success';
        }else{
            $post_compare = 'icon-arrow-down text-danger';
        }
        // Forum::END

        // PostReply
        $replies_count = PostReply::count();
        $replies_today = PostReply::where('created_at', $today)->count();
        $replies_yesterday = PostReply::where('created_at', $yesterday)->count();

        if ($replies_today > $replies_yesterday) {
            $replies_compare = 'icon-arrow-up text-success';
        }else{
            $replies_compare = 'icon-arrow-down text-danger';
        }
        // PostReply::END

        // ForumPostView
        $views_count = ForumPostView::count();
        $views_today = ForumPostView::where('created_at', $today)->count();
        $views_yesterday = ForumPostView::where('created_at', $yesterday)->count();

        if ($views_today > $views_yesterday) {
            $views_compare = 'icon-arrow-up text-success';
        }else{
            $views_compare = 'icon-arrow-down text-danger';
        }
        // ForumPostView::END

        return view('forum.panel.replies', compact(
            'replies', 
            'posts_count', 
            'post_compare',
            'replies_count',
            'replies_compare',
            'views_count',
            'views_compare'
        ));
    }

    // forum_reply_delete
        public function forum_reply_delete($id)
        {
            try {
                PostReply::where('id', $id)->delete();
                notify()->success(translate('Deleted successfully'));
                return back();
            } catch (\Throwable $th) {
                notify()->error(translate('Something went wrong'));
                return back();
            }
        }


        /**
         * VOTE
         */

         public function vote_up($id, $post)
         {
            $h = new HelpfulAnswer();
            $h->post_reply_id = $id;
            $h->post_id = $post;
            $h->user_id = Auth::user()->id;
            $h->save();
            return back();
         }

         public function vote_down($id, $post)
         {
            $helpful = HelpfulAnswer::where('post_reply_id',$id)->first();
            $helpful->delete();
            return back();
         }

         /**
          * CATEGORIES
          */

          public function all_categories()
          {
            $topics = Forum::latest()->get();
            return view('forum.forumly.category', compact('topics'));
          }

          public function category_posts($id)
          {
            $category_topics = Forum::where('category', $id)->latest()->paginate(20);
            $category = Category::where('id', $id)->select('name')->first();
            return view('forum.forumly.category_posts', compact('category_topics', 'category'));
          }
    
    //END
}