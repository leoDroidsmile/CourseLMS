<?php

Route::group(['middleware'=>['installed','auth'],'prefix'=>'dashboard'],function (){
    Route::get('quiz/create','QuizController@create')->name('quiz.create');
    Route::get('quiz/list','QuizController@create')->name('quiz.list');
    Route::post('quiz/store','QuizController@store')->name('quiz.store');
    Route::get('quiz/status','QuizController@published')->name('quiz.published');
    Route::get('quiz/edit/{id}','QuizController@edit')->name('quiz.edit');
    Route::post('quiz/update','QuizController@update')->name('quiz.update');
    Route::get('quiz/delete/{id}','QuizController@delete')->name('quiz.delete');

    Route::get('quiz/questions/add/{id}','QuizController@questionsIndex')->name('question.add');
    Route::post('quiz/questions/store','QuizController@questionsStore')->name('questions.store');
    Route::get('quiz/questions/status','QuizController@questionsPublished')->name('questions.published');
    Route::get('quiz/questions/delete/{id}','QuizController@questionsDelete')->name('questions.delete');
    Route::get('quiz/questions/edit/{id}','QuizController@questionsEdit')->name('questions.edit');
    Route::post('quiz/questions/update','QuizController@questionsUpdate')->name('questions.update');


});

/*frontend */
Route::get('question/{id}/{content_id}','QuizController@start')->name('start');
Route::get('start/quiz/{id}/{content_id}','QuizController@quizStart')->name('start.quiz');
Route::post('quiz/done','QuizController@quizDone')->name('quiz.submit');
/*score show after done the quiz*/
Route::get('quiz/score/{id}','QuizController@questionScoreShow')->name('quiz.score.show');

