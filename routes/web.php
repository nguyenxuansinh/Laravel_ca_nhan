<?php


use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get("/",[TaskController::class,'index'])->name("index");

Route::get("/search",[TaskController::class,'search'])->name("tasks.search");