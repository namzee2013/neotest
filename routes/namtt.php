<?php
Route::get('add-role', function(){
  DB::table('roles')->insert(
    ['role'=>'superadmin']
  );
  DB::table('roles')->insert(
    ['role'=>'admin']
  );
  DB::table('roles')->insert(
    ['role'=>'member']
  );
  echo "ok";
});
Route::get('add-type', function(){
  DB::table('types')->insert(
      ['id'=>1,'type'=>'single']
  );
  DB::table('types')->insert(
      ['id'=>2,'type'=>'multiple']
  );
  DB::table('types')->insert(
      ['id'=>3,'type'=>'text']
  );
  echo "ok";
});
Route::get('add-admin', function(){
  $id = DB::table('roles')->select('id')->where('role','=','superadmin')->get()->first()->id;
  DB::table('users')->insert([
    'name'=>'administrator',
    'email'=>'admin@gmail.com',
    'password'=>bcrypt('123456'),
    'role_id'=>$id
  ]);
  echo "ok";
});
Route::get('delete-admin', function(){
  DB::table('users')->where('email', 'admin@gmail.com')->delete();
});
Route::group(['prefix'=>'admin'], function(){
  Route::get('/', ['as'=>'admin.home', 'uses'=>'Admin\HomeController@index']);
  Route::group(['prefix'=>'statistic'], function(){
    Route::get('test', ['as'=>'admin.statistic.getCountTest','uses'=>'Admin\HomeController@getCountTest']);
    Route::get('user-test', ['as'=>'admin.statistic.getCountUserTest','uses'=>'Admin\HomeController@getCountUserTest']);
    Route::get('test-with-mark', ['as'=>'admin.statistic.getCountTestWithMark','uses'=>'Admin\HomeController@getCountTestWithMark']);
  });
  Route::group(['prefix'=>'role'], function(){
    Route::get('/', ['as'=>'admin.role','uses'=>'Admin\RoleController@index']);
    Route::get('create', ['as'=>'admin.role.create','uses'=>'Admin\RoleController@create']);
    Route::post('store', ['as'=>'admin.role.store','uses'=>'Admin\RoleController@store']);
    Route::get('edit/{id}', ['as'=>'admin.role.edit','uses'=>'Admin\RoleController@edit']);
    Route::post('update/{id}', ['as'=>'admin.role.update','uses'=>'Admin\RoleController@update']);
    Route::get('delete/{id}', ['as'=>'admin.role.delete','uses'=>'Admin\RoleController@delete']);
  });
  Route::group(['prefix'=>'user'], function(){
    Route::get('/', ['as'=>'admin.user','uses'=>'Admin\UserController@index']);
    Route::get('create', ['as'=>'admin.user.create','uses'=>'Admin\UserController@create']);
    Route::post('store', ['as'=>'admin.user.store','uses'=>'Admin\UserController@store']);
    Route::get('edit/{id}', ['as'=>'admin.user.edit','uses'=>'Admin\UserController@edit']);
    Route::post('update/{id}', ['as'=>'admin.user.update','uses'=>'Admin\UserController@update']);
    Route::get('delete/{id}', ['as'=>'admin.user.delete','uses'=>'Admin\UserController@delete']);
  });
  Route::group(['prefix'=>'test'], function(){
    Route::get('/', ['as'=>'admin.test','uses'=>'Admin\TestController@index']);
    Route::get('get-sum-mark', ['as'=>'admin.test.getSumMark', 'uses'=>'Admin\TestController@getSumMark']);
    Route::get('set-mark-all', ['as'=>'admin.test.setMarkAll','uses'=>'Admin\TestController@setMarkAll']);
    Route::get('{id}/set-mark', ['as'=>'admin.test.setmark','uses'=>'Admin\TestController@setMark']);
    Route::get('question/{id}/set-mark', ['as'=>'admin.test.question.setMarkQuestion','uses'=>'Admin\TestController@setMarkQuestion']);
    Route::get('all', ['as'=>'admin.test.all','uses'=>'Admin\UserTestController@getAll']);
    Route::get('all/category/{id}', ['as'=>'admin.test.all.getAllByCategory','uses'=>'Admin\UserTestController@getAllByCategory']);
    Route::get('not-marked', ['as'=>'admin.test.notmarked','uses'=>'Admin\UserTestController@getNotMarked']);
    Route::get('not-marked/category/{id}', ['as'=>'admin.test.getNotMarkedByCategory','uses'=>'Admin\UserTestController@getNotMarkedByCategory']);
    Route::get('marked', ['as'=>'admin.test.marked','uses'=>'Admin\UserTestController@getMarked']);
    Route::get('marked/category/{id}', ['as'=>'admin.test.getMarkedByCategory','uses'=>'Admin\UserTestController@getMarkedByCategory']);
    Route::get('{id}/marked', ['as'=>'admin.test.editmark','uses'=>'Admin\UserTestController@editMark']);
    Route::get('marked/post', ['as'=>'admin.test.marked.post','uses'=>'Admin\UserTestController@marked']);
    Route::get('update-comment', ['as'=>'admin.test.updateComment','uses'=>'Admin\UserTestController@updateComment']);
  });
  Route::group(['prefix'=>'rate'], function(){
    Route::get('/',['as'=>'admin.rate','uses'=>'Admin\RateController@index']);
    Route::get('create', ['as'=>'admin.rate.create','uses'=>'Admin\RateController@create']);
    Route::post('store', ['as'=>'admin.rate.store','uses'=>'Admin\RateController@store']);
    Route::get('edit/{id}', ['as'=>'admin.rate.edit','uses'=>'Admin\RateController@edit']);
    Route::post('update/{id}', ['as'=>'admin.rate.update','uses'=>'Admin\RateController@update']);
    Route::get('delete/{id}', ['as'=>'admin.rate.delete','uses'=>'Admin\RateController@delete']);
    Route::get('category/{id}', ['as'=>'admin.rate.getByCategory','uses'=>'Admin\RateController@getByCategory']);
  });
});
