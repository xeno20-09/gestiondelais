<?php

use App\Http\Middleware\CheckRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TitreController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\GreffierController;
use App\Http\Controllers\PresidentController;
use App\Http\Controllers\StructureController;
use App\Http\Controllers\ConseillerController;
use App\Http\Controllers\SecretaireController;
use App\Http\Controllers\MesureInstructionsController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('recours/get/liste/recours/instruires', [SecretaireController::class, 'getlisterecours'])->name('get_liste');

Route::prefix('/recours')
    ->middleware(['auth', 'role:SECRETAIRE'])
    ->group(function () {
        Route::get('/home/secretaire', [SecretaireController::class, 'home']);
        Route::get('form/create', [SecretaireController::class, 'formulaire_recours_creation'])
            ->name('form.recours.create');
        Route::post('form/create/post', [SecretaireController::class, 'formulaire_recours_creation_post'])
            ->name('form.recours.create.post');
    });
Route::get('/recours/get/liste/recours/a_reaffectes', [PresidentController::class, 'getlisterecours_a_reaffectes'])->name('getlisterecours_a_reaffectes');
Route::post('/recours/post/reaffecter/membre', [PresidentController::class, 'getmembrerefratore']);
Route::post('/recours/post/form/recoursa_reaffectes', [PresidentController::class, 'postformrecours_a_reaffectes'])->name('post_form_reaffecte');

Route::prefix('/recours')
    ->middleware(['auth', 'role:PCA,PCJ'])
    ->group(function () {
        Route::get('/home/president', [PresidentController::class, 'home']);
        Route::get('/get/liste/recours/a_affectes', [PresidentController::class, 'getlisterecours_a_affectes'])->name('getlisterecours_a_affectes');
        Route::get('/get/form/recours/a_affecte', [PresidentController::class, 'getformrecours_a_affecte'])->name('get_form_affecte');
        Route::post('/post/affecter/membre', [PresidentController::class, 'getmembre']);
        Route::post('/post/form/recours/a_affecte', [PresidentController::class, 'postformrecours_a_affecte'])->name('post_form_affecte');
    });


Route::prefix('/recours')
    ->middleware(['auth', 'role:CONSEILLER'])
    ->group(function () {
        Route::get('/home/conseiller', [ConseillerController::class, 'home']);
        Route::get('/get/liste/recours/a_instruires', [ConseillerController::class, 'getlisterecours_a_instruires'])->name('get_liste_instruire');
        Route::get('/get/form/recours/a_instruire', [ConseillerController::class, 'getformrecours_a_instruire'])->name('get_form_instruire');
        Route::post('/post/form/recours/a_instruire', [ConseillerController::class, 'postformrecours_a_instruire'])->name('post_form_instruire');
        // Routes crud mesure_instructions
        Route::resource('mesure_instructions', MesureInstructionsController::class)->parameters(['mesure_instructions' => 'instruction:id']);
    });

Route::prefix('/recours')
    ->middleware(['auth', 'role:GREFFIER'])
    ->group(function () {
        Route::get('/home/greffier', [GreffierController::class, 'home']);
        Route::get('/get/liste/recours/en_instructions', [GreffierController::class, 'getlisterecours_en_instructions']);
        Route::get('/get/form/recours/en_instruction', [GreffierController::class, 'getformrecours_en_instruction'])->name('get_form_instruction');
        Route::post('/post/form/recours/en_instruction', [GreffierController::class, 'postformrecours_en_instruction'])->name('post_form_instruction');
    });


Route::prefix('/recours')
    ->middleware(['auth', 'role:SUPER ADMIN'])
    ->group(function () {
        Route::get('/home/admin', [AdminController::class, 'home'])->name('liste_users');
        Route::get('/form/change/user/info', [AdminController::class, 'change_mail'])->name('modify_users_info');
        Route::post('/post/form/change/user/info', [AdminController::class, 'post_form_modify_info'])->name('post_form_modify_info');
        Route::delete('/users/destroy', [AdminController::class, 'user_destroy'])->name('user_destroy');
        Route::get('/add/user', [AdminController::class, 'add_user'])->name('form.add.user');
        Route::post('post/user', [AdminController::class, 'post_user'])->name('post.user');


        // Routes crud structure
        Route::resource('structures', StructureController::class)->parameters(['structure' => 'structure:id']);
        // Routes crud role
        Route::resource('roles', RoleController::class)->parameters(['role' => 'role:id']);
        // Routes crud titre
        Route::resource('titres', TitreController::class)->parameters(['titre' => 'titre:id']);
        // Routes crud section
        Route::resource('sections', SectionController::class)->parameters(['section' => 'section:id']);

        /*   Route::get('/get/liste/recours/en_instructions', [GreffierController::class, 'getlisterecours_en_instructions']);
        Route::get('/get/form/recours/en_instruction', [GreffierController::class, 'getformrecours_en_instruction'])->name('get_form_instruction');
        Route::post('/post/form/recours/en_instruction', [GreffierController::class, 'postformrecours_en_instruction'])->name('post_form_instruction');
    */
    });
Route::get('/unauthorized', function () {
    return response()->view('errors.403', [], 403);
})->name('unauthorized');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
