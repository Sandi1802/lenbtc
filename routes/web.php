<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MasterDataController;
use App\Http\Controllers\LogController;
use App\Http\Controllers\ProcurementController;
use App\Models\Procurement;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Auth Routes (no middleware)
Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');

// Protected Routes (requires login)
Route::middleware('auth')->group(function () {

    Route::get('/', function () {
        return redirect('/overview');
    });

    Route::get('/overview', function () {
        return view('overview');
    });

    Route::get('/dashboard', function () {
        $totalProcurement = Procurement::count();
        $avgProgress = Procurement::all()->avg(fn($p) => $p->progress_percentage);
        $avgProgress = round($avgProgress ?? 0);
        return view('dashboard', compact('totalProcurement', 'avgProgress'));
    });

    Route::get('/procurement', [ProcurementController::class, 'index']);
    Route::post('/procurement', [ProcurementController::class, 'store']);
    Route::get('/procurement/create', [ProcurementController::class, 'create']);
    Route::get('/procurement/{id}', [ProcurementController::class, 'show']);
    Route::post('/procurement/{id}', [ProcurementController::class, 'update']);
    Route::delete('/procurement/{id}', [ProcurementController::class, 'destroy']);

    // Master Data
    Route::prefix('master-data')->group(function () {
        Route::get('/vessels', [MasterDataController::class, 'vessels'])->name('master-data.vessels');
        Route::post('/vessels', [MasterDataController::class, 'storeVessel'])->name('master-data.vessels.store');
        Route::delete('/vessels/{id}', [MasterDataController::class, 'deleteVessel'])->name('master-data.vessels.delete');

        Route::get('/stakeholders', [MasterDataController::class, 'stakeholders'])->name('master-data.stakeholders');
        Route::post('/stakeholders', [MasterDataController::class, 'storeStakeholder'])->name('master-data.stakeholders.store');
        Route::delete('/stakeholders/{id}', [MasterDataController::class, 'deleteStakeholder'])->name('master-data.stakeholders.delete');

        Route::get('/scope', [MasterDataController::class, 'scope'])->name('master-data.scope');
        Route::post('/scope', [MasterDataController::class, 'storeScope'])->name('master-data.scope.store');
        Route::delete('/scope/{id}', [MasterDataController::class, 'deleteScope'])->name('master-data.scope.delete');

        Route::get('/employees', [MasterDataController::class, 'employees'])->name('master-data.employees');
        Route::post('/employees', [MasterDataController::class, 'storeEmployee'])->name('master-data.employees.store');
        Route::delete('/employees/{id}', [MasterDataController::class, 'deleteEmployee'])->name('master-data.employees.delete');
    });

    // Logs
    Route::prefix('logs')->group(function () {
        Route::get('/issue', [LogController::class, 'issues'])->name('logs.issues');
        Route::post('/issue', [LogController::class, 'storeIssue'])->name('logs.issues.store');
        Route::delete('/issue/{id}', [LogController::class, 'deleteIssue'])->name('logs.issues.delete');

        Route::get('/risk', [LogController::class, 'risks'])->name('logs.risks');
        Route::post('/risk', [LogController::class, 'storeRisk'])->name('logs.risks.store');
        Route::delete('/risk/{id}', [LogController::class, 'deleteRisk'])->name('logs.risks.delete');

        Route::get('/notes', [LogController::class, 'notes'])->name('logs.notes');
        Route::post('/notes', [LogController::class, 'storeNote'])->name('logs.notes.store');
        Route::delete('/notes/{id}', [LogController::class, 'deleteNote'])->name('logs.notes.delete');
    });

});
