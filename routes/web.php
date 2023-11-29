<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;
Route::get('/',function(){
return redirect()->route('task.index');
});

Route::resource('/task', TaskController::class);
Route::match(['put'], '/task/{id}/update-status', [TaskController::class, 'updateStatusTask'])->name('task.updateStatusTask');
