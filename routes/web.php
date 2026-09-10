<?php

use App\Http\Controllers\ItemController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| The 3 endpoints every DevOps practice app exposes so you can verify a
| deployment the same way every time:
|   GET /          -> welcome (names the stack)
|   GET /health    -> {"status":"ok"}  (use for probes / load balancers)
|   GET /api/items -> a small list     (your "does it actually work?" check)
*/

Route::get('/', [ItemController::class, 'welcome']);
Route::get('/health', [ItemController::class, 'health']);
Route::get('/api/items', [ItemController::class, 'items']);
