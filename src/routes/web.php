<?php

/*
 * Acacha/profile routes
 *
 * Take into account we have to add 'web' middleware group here because Laravel by defaults add this middleware in
 * RouteServiceProvider
 */

Route::group(['middleware' => 'web'], function () {
    Route::get('/settings', 'SettingsController@index')->name('profile');;
});