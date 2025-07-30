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
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SecretaireController;
use App\Http\Controllers\MesureInstructionsController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::prefix('/recours')
    ->middleware(['auth'])
    ->group(function () {
        //ADMIN
        Route::resource('roles', RoleController::class);

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
        // Routes crud permission
        Route::resource('permissions', PermissionController::class)->parameters(['permission' => 'permission:id']);

        //CONSEILLER

        Route::get('/home/conseiller', [ConseillerController::class, 'home']);
        Route::get('/get/liste/recours/a_instruires', [ConseillerController::class, 'getlisterecours_a_instruires'])->name('get_liste_instruire');
        Route::get('/get/form/recours/a_instruire', [ConseillerController::class, 'getformrecours_a_instruire'])->name('get_form_instruire');
        Route::post('/post/form/recours/a_instruire', [ConseillerController::class, 'postformrecours_a_instruire'])->name('post_form_instruire');
        // Routes crud mesure_instructions
        Route::resource('mesure_instructions', MesureInstructionsController::class)->parameters(['mesure_instructions' => 'instruction:id']);





        /*   Route::get('/get/liste/recours/en_instructions', [GreffierController::class, 'getlisterecours_en_instructions']);
        Route::get('/get/form/recours/en_instruction', [GreffierController::class, 'getformrecours_en_instruction'])->name('get_form_instruction');
        Route::post('/post/form/recours/en_instruction', [GreffierController::class, 'postformrecours_en_instruction'])->name('post_form_instruction');
    */


        //SECRETAIRE
        Route::get('/home/secretaire', [SecretaireController::class, 'home']);
        //SECRETAIRE && GREFFIER

        Route::get('form/create', [SecretaireController::class, 'formulaire_recours_creation'])
            ->name('form.recours.create');
        Route::post('form/create/post', [SecretaireController::class, 'formulaire_recours_creation_post'])
            ->name('form.recours.create.post');
Route::get('form/update', [SecretaireController::class, 'formulaire_recours_update'])
            ->name('getformrecours_modifiy');
            
        Route::put('form/update/post', [SecretaireController::class, 'formulaire_recours_update_post'])
            ->name('form.recours.update.post');
        //GREFFIER
        Route::get('/home/greffier', [GreffierController::class, 'home']);
        Route::get('/get/liste/recours/en_instructions', [GreffierController::class, 'getlisterecours_en_instructions'])->name('getlisterecours_en_instructions');
        Route::get('/get/form/recours/en_instruction', [GreffierController::class, 'getformrecours_en_instruction'])->name('get_form_instruction');
        Route::post('/post/form/recours/en_instruction', [GreffierController::class, 'postformrecours_en_instruction'])->name('post_form_instruction');

        //ALL USER
        Route::get('recours/get/liste/recours/instruires', [SecretaireController::class, 'getlisterecours'])->name('get_liste');
        Route::get('recours/get/detail/recours/instruires', [SecretaireController::class, 'getdetailrecours'])->name('get_detail');
        Route::get('recours/get/history/recours/instruires', [SecretaireController::class, 'gethistoryrecours'])->name('get_history_recours');


        //LES PRESIDENTS
        Route::get('/recours/get/liste/recours/a_reaffectes', [PresidentController::class, 'getlisterecours_a_reaffectes'])->name('getlisterecours_a_reaffectes');
        Route::post('/recours/post/reaffecter/membre', [PresidentController::class, 'getmembrerefratore']);
        Route::post('/recours/post/form/recoursa_reaffectes', [PresidentController::class, 'postformrecours_a_reaffectes'])->name('post_form_reaffecte');
        Route::post('/post/affecter/membre', [PresidentController::class, 'getmembre'])->name('affecter_membre');
        //PCA || PCJ
        Route::get('/home/president', [PresidentController::class, 'home'])->name('home');
        Route::get('/get/liste/recours/a_affectes', [PresidentController::class, 'getlisterecours_a_affectes'])->name('getlisterecours_a_affectes');
        Route::get('/get/form/recours/a_affecte', [PresidentController::class, 'getformrecours_a_affecte'])->name('get_form_affecte');
        Route::post('/post/form/recours/a_affecte', [PresidentController::class, 'postformrecours_a_affecte'])->name('post_form_affecte');

        //PCJ
        /*         Route::get('/home/president/cj', [PresidentController::class, 'home'])->name('home');
        Route::get('/get/liste/recours/a_affectes/cj', [PresidentController::class, 'getlisterecours_a_affectes'])->name('pcj.getlisterecours_a_affectes');
        Route::get('/get/form/recours/a_affecte/cj', [PresidentController::class, 'getformrecours_a_affecte'])->name('pcj.get_form_affecte');
        Route::post('/post/form/recours/a_affecte/cj', [PresidentController::class, 'postformrecours_a_affecte'])->name('pcj.post_form_affecte');
    */

        //All user
        Route::get('/change/password', [SecretaireController::class, 'changepwdview'])->name('change_pwd_view');
        Route::post('/change/password', [SecretaireController::class, 'change_pwd'])->name('password_change');


        
    });
/* 
Route::prefix('/recours')
    ->middleware(['auth', 'role:SECRETAIRE'])
    ->group(function () {});

Route::prefix('/recours')
    ->middleware(['auth', 'role:PCA'])
    ->name('pca.')
    ->group(function () {});

Route::prefix('/recours')
    ->middleware(['auth', 'role:PCJ'])
    ->name('pcj.')
    ->group(function () {}); */

/* 
Route::prefix('/recours')
    ->middleware(['auth', 'role:CONSEILLER'])
    ->group(function () {
}); */
/* Route::prefix('/recours')
    ->middleware(['auth', 'role:GREFFIER'])
    ->group(function () {
});
 */

/*Route::prefix('/recours')
    ->middleware(['auth', 'role:SUPER ADMIN'])
    ->group(function () {

    });*/
Route::get('/unauthorized', function () {
    return response()->view('errors.403', [], 403);
})->name('unauthorized');

Route::get('/not-found', function () {
    return response()->view('errors.404', [], 404);
})->name('notfound');

Route::get('/server-error', function () {
    return response()->view('errors.500', [], 500);
})->name('servererror');

Route::get('/server-error', function () {
    return response()->view('errors.419', [], 419);
})->name('servererror');


//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
