<?php
	    // ->name('posttest');
Route::group(['prefix' => 'test'], function(){
	Route::get('/{link}','TestController@getInformation')
    	->name('getInfo');
	Route::post('{link}','TestController@getDirection')
    	->name('getDirection');
	Route::get('/{link}/all','TestController@getAllQuestion')
	    ->name('test');
	Route::get('/{link}/ok','TestController@postTest');
	Route::get('/{link}/ok/done','TestController@testDone');

	Route::get('/{link}/{id}','TestController@getEachQuestion')
	    ->name('eachtest');

});
