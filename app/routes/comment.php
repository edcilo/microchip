<?php


/*
 * Routes
 */
Route::group(
    [
        'prefix' => 'comment/',
        'before' => 'pr:91',
    ],
    function () {

        Route::group(['before' => 'pr:92'], function () {

            Route::post('{sale_id}', [
                'as'   => 'comment.store',
                'uses' => 'CommentController@store',
            ]);

        });

        Route::get('no/{comment_id}', [
            'as'   => 'comment.noPrint',
            'uses' => 'CommentController@noPrint',
        ]);

        Route::get('yes/{comment_id}', [
            'as'   => 'comment.yesPrint',
            'uses' => 'CommentController@yesPrint',
        ]);

        Route::get('print/{comment_id}', [
            'as'   => 'comment.print',
            'uses' => 'CommentController@commentPrint',
        ]);
    }
);
