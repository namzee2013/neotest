<?php 



Route::group(['prefix'=>'admin'], function(){

  Route::group(['prefix'=>'category'], function () {       
      Route::get('list',['as'=>'admin.category.getList','uses'=>'CategoryController@getList']);
      Route::get('add',['as'=>'admin.category.getAdd','uses'=>'CategoryController@getAdd']);        
      Route::post('add',['as'=>'admin.category.postAdd','uses'=>'CategoryController@postAdd']);  
      Route::get('edit/{id}',['as'=>'admin.category.getEdit','uses'=>'CategoryController@getEdit']);        
      Route::post('edit/{id}',['as'=>'admin.category.postEdit','uses'=>'CategoryController@postEdit']); 
      Route::get('delete/{id}',['as'=>'admin.category.getDelete','uses'=>'CategoryController@getDelete']);
  });
  Route::group(['prefix'=>'type'], function () {       
      Route::get('list',['as'=>'admin.type.getList','uses'=>'TypeController@getList']);
      Route::get('add',['as'=>'admin.type.getAdd','uses'=>'TypeController@getAdd']);        
      Route::post('add',['as'=>'admin.type.postAdd','uses'=>'TypeController@postAdd']);  
      Route::get('edit/{id}',['as'=>'admin.type.getEdit','uses'=>'TypeController@getEdit']);        
      Route::post('edit/{id}',['as'=>'admin.type.postEdit','uses'=>'TypeController@postEdit']); 
      Route::get('delete/{id}',['as'=>'admin.type.getDelete','uses'=>'TypeController@getDelete']);
  });
  Route::group(['prefix'=>'question'], function () {       
      Route::get('list',['as'=>'admin.question.getList','uses'=>'QuestionController@getList']);
      Route::get('choose',['as'=>'admin.question.getChoose','uses'=>'QuestionController@getChoose']);        
      
      Route::post('add-one-choice',['as'=>'admin.question.postOneChoice','uses'=>'QuestionController@postAddOneChoiceQuest']);
      
      Route::post('add-multi-choice',['as'=>'admin.question.postAddMultiChoiceQuest','uses'=>'QuestionController@postAddMultiChoiceQuest']);
      
      Route::post('add-text-quest',['as'=>'admin.question.postAddTextQuest','uses'=>'QuestionController@postAddTextQuest']);
      Route::get('edit/{id}',['as'=>'admin.question.getEdit','uses'=>'QuestionController@getEdit']);        
      Route::post('edit-radio-quest/{id}',['as'=>'admin.question.postEditRadioQuest','uses'=>'QuestionController@postEditRadioQuest']); 
      Route::post('edit-check-quest/{id}',['as'=>'admin.question.postEditCheckQuest','uses'=>'QuestionController@postEditCheckQuest']);
      Route::post('edit-text-quest/{id}',['as'=>'admin.question.postEditTextQuest','uses'=>'QuestionController@postEditTextQuest']); 
      Route::get('del-option/{id}',['as'=>'admin.question.deleteOption','uses'=>'QuestionController@deleteOption']);
      Route::get('del-question/{id}',['as'=>'admin.question.deleteQuestion','uses'=>'QuestionController@deleteQuestion']);
      Route::get('add',['as'=>'admin.question.addQuestion','uses'=>'QuestionController@addQuestion']);

  });
  Route::group(['prefix'=>'test'],function(){
      Route::get('list',['as'=>'admin.test.getList','uses'=>'TestController@getList']);
      Route::get('delete/{id}',['as'=>'admin.test.getDeleteTest','uses'=>'TestController@getDeleteTest']);
      Route::get('view/{id}',['as'=>'admin.test.getViewTest','uses'=>'TestController@getViewTest']);
      Route::get('add',['as'=>'admin.test.getAdd','uses'=>'TestController@getAdd']);
      Route::post('add',['as'=>'admin.test.postAdd','uses'=>'TestController@postAdd']);
      Route::get('add-test',['as'=>'admin.test.chooseCategory','uses'=>'TestController@chooseCategory']);
      Route::get('customize-add/{id}',['as'=>'admin.test.getAddCustomize','uses'=>'TestController@getAddCustomize']);
      Route::post('customize-add/{id}',['as'=>'admin.test.postAddCustomize','uses'=>'TestController@postAddCustomize']);
      Route::post('send-link',['as'=>'admin.test.sendLinkTest','uses'=>'TestController@sendLinkTest']);      
      Route::get('question-add',['as'=>'admin.test.getFormAddTest','uses'=>'TestController@getFormAddTest']);
      Route::get('add-new/{cate}',['as'=>'admin.test.addNewTest','uses'=>'TestController@addNewTest']);
      Route::get('update/{id}',['as'=>'admin.test.updateQuestionOfTest','uses'=>'TestController@updateQuestionOfTest']);
      Route::post('update/{id}',['as'=>'admin.test.postUpdateQuestionOfTest','uses'=>'TestController@postUpdateQuestionOfTest']);
      Route::get('del-test-question/{id}',['as'=>'admin.test.delQuestionofTest','uses'=>'TestController@delQuestionofTest']);
      Route::post('save-test/{id}',['as'=>'admin.test.saveQuestionofTest','uses'=>'TestController@saveQuestionofTest']);

  });

});



 ?>