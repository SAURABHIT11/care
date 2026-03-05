<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ImageAssetController;

Route::post('/image-assets', [ImageAssetController::class, 'store']);