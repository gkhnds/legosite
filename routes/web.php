<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\DeveloperController;
use App\Http\Controllers\LegoController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\FormController;
use App\Http\Middleware\LegoPool;
Route::get('/connection', [SystemController::class, 'Connection'])->name('Connection');
Route::get('/optimize/{uuid}', [SystemController::class, 'Optimize'])->name('Optimize');
Route::get('/removeTemplate/{uuid}', [SystemController::class, 'RemoveTemplate'])->name('RemoveTemplate');

Route::group(['prefix' => 'system','middleware' => ['web'] ], function () {

    Route::get('/welcome', [SystemController::class, 'Welcome'])->name('Welcome');
    Route::get('/install', [SystemController::class, 'Install'])->name('Install');
    Route::post('/install', [SystemController::class, 'InstallPost'])->name('InstallPost');
    Route::get('/error', [SystemController::class, 'Error'])->name('Error');

    Route::group(['prefix' => 'developer','middleware' => [LegoPool::class]], function () {
        Route::get('/', [DeveloperController::class, 'Index']);
        Route::get('/view-clear', [SystemController::class, 'ViewClear'])->name('ViewClear');
        Route::get('/session-clear', [SystemController::class, 'SessionClear'])->name('SessionClear');
        Route::get('/cache-clear', [SystemController::class, 'CacheClear'])->name('CacheClear');
        Route::get('/litespeed-clear', [SystemController::class, 'LiteSpeedClear'])->name('LiteSpeedClear');
        Route::get('/query-clear', [SystemController::class, 'QueryClear'])->name('QueryClear');
        Route::get('/file-clear', [SystemController::class, 'FileClear'])->name('FileClear');
        Route::get('/ladders', [DeveloperController::class, 'Ladders'])->name('Ladders');
        Route::get('/translate', [DeveloperController::class, 'Translate'])->name('Translate');
        Route::get('/masters', [DeveloperController::class, 'Masters'])->name('Masters');
        Route::get('/customparameter', [DeveloperController::class, 'CustomParameter'])->name('CustomParameter');
        Route::get('/errorlog', [\Rap2hpoutre\LaravelLogViewer\LogViewerController::class, 'index'])->name('ErrorLog');
        Route::get('/lang-change/{lang}', [DeveloperController::class, 'LangChange'])->name('LangChange');
    });
});

Route::get('/tr/developerBar', [DeveloperController::class, 'developerBar'])->name('developerBar')->middleware(['web']);


Route::get('/', [LegoController::class, 'Rotation'])->name('Rotation');
Route::get('/', [LegoController::class, 'Starting'])->name('Hello')->middleware([LegoPool::class]);

Route::group(['prefix' => '/{lang}/' ,'middleware' => [LegoPool::class]], function () {

    Route::get('/', [LegoController::class, 'Index'])->name('Index');
    Route::get('/404', [LegoController::class, 'error404'])->name('error404');
    Route::get('/devStatus', [LegoController::class, 'devStatus'])->name('devStatus');


    /* ***** E-Ticaret Sepet Ve Sipariş Oluşturma ***** */
    Route::group(['prefix' => '/cart/'],
        function () {
            Route::get('/', [CartController::class, 'CartDetail'])->name('CartDetail');
            Route::post('/cartPush', [CartController::class, 'CartPush'])->name('CartPush');
            Route::post('/cartDelete', [CartController::class, 'CartDelete'])->name('CartDelete');
            Route::post('/cartPayment', [CartController::class, 'CartPayment'])->name('CartPayment');
            Route::post('/cartUpdate', [CartController::class, 'CartUpdate'])->name('CartUpdate');
            Route::post('/cart-piece-update', [CartController::class, 'CartPieceUpdate'])->name('CartPieceUpdate');
        });



    Route::get('search/{tag}/{page}', [LegoController::class, 'Search'])->name('Search');
    Route::group(['prefix' => '/{component_slug}/'], function () {
        Route::get('/', [LegoController::class, 'Par1'])->name('Par1');
        Route::get('{slug}', [LegoController::class, 'Par2'])->name('Par2');
        Route::get('{slug}/{pageNumber}', [LegoController::class, 'Paginate'])->name('Paginate');
    });



    Route::post('/FormPush', [FormController::class, 'FormPush'])->name('FormPush');

});



