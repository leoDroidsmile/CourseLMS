<?php

/**
 * FORUM
 */

Route::get('/forum','ForumController@index')->name('forum.index');
Route::get('/forum/all/posts','ForumController@all_posts')->name('forum.all.posts'); //ajax
Route::get('/forum/posts','ForumController@posts')->name('forum.posts'); //ajax
Route::get('/forum/post/{id}','ForumController@show')->name('forum.single');
Route::post('/forum/post/reply','ForumController@getReply')->name('forum.get.reply'); //ajax
Route::get('/forum/search','ForumController@forum_search')->name('forum.search');

/**
 * VOTE
 */
Route::get('/forum/post/reply/{id}/{post}/{vote}/up','ForumController@vote_up')->name('vote.up');
Route::get('/forum/post/reply/{id}/{post}/{vote}/down','ForumController@vote_down')->name('vote.down');

/**
 * CATEGORY
 */
Route::get('/forum/categories','ForumController@all_categories')->name('forum.all.categories');
Route::get('/forum/category/{id}/{slug}','ForumController@category_posts')->name('forum.category.posts');

Route::get('/forum/post/share/{id}','ForumController@share')->name('forum.share');

Route::group(['middleware' => ['installed', 'auth'], 'prefix' => 'forum'], function (){
    
    Route::get('/my/posts','ForumController@my_posts')->name('forum.my.posts'); //ajax
    Route::get('/create','ForumController@create')->name('forum.create'); //ajax
    Route::post('/store','ForumController@store')->name('forum.store'); //ajax
    Route::post('/reply','ForumController@reply')->name('forum.post.reply'); //ajax
    Route::post('/helpful','ForumController@helpful')->name('forum.helpful'); //ajax
});

 Route::group(['middleware' => ['installed', 'auth'], 'prefix' => 'dashboard'], function () {
    Route::get('forum/panel', 'ForumController@forum_panel')->name('forum.panel');
    Route::get('forum/replies', 'ForumController@forum_replies')->name('forum.replies');
    Route::get('forum/replies/delete/{id}', 'ForumController@forum_reply_delete')->name('forum.reply.delete');
});







/**
 * FORUM END
 */