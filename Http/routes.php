<?php

Route::group(['as' => 'RlPWA.'], function()
{
    Route::get('/{appName}/manifest.json', 'RlPWAController@manifestJson')->name('manifest');

    Route::get('/offline/', 'RlPWAController@offline');
});
