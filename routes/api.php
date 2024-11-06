<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth_controller;
use App\Http\Controllers\api\seasone_controller;
use App\Http\Controllers\api\video_controller;
use App\Http\Controllers\api\sport_controller;
use App\Http\Controllers\api\employee_controller;
use App\Http\Controllers\api\club_controller;
use App\Http\Controllers\api\information_controller;
use App\Http\Controllers\api\matche_controller;
use App\Http\Controllers\api\Player_Controller;
use App\Http\Controllers\api\replacments_controller;
use App\Http\Controllers\api\plan_controller;
use App\Http\Controllers\api\statistic_controller;
use App\Http\Controllers\api\posse_controller;
use App\Http\Controllers\api\wear_controller;
use App\Http\Controllers\api\prime_controller;
use App\Http\Controllers\api\standing_controller;


use App\Models\prime;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('regester',[Auth_controller::class,'regester']);
Route::post('login',[Auth_controller::class,'login']);
Route::middleware(['auth:sanctum'])->group(function ()
{Route::post('logout',[Auth_controller::class,'logout']);
////////////////////////seasone
Route::post('store_seasone',[seasone_controller::class,'create']);
Route::post('update_seasone/{uuid}',[seasone_controller::class,'update']);
Route::get('destore_seasone/{uuid}',[seasone_controller::class,'destore']);
Route::get('index_seasone',[seasone_controller::class,'index']);
Route::get('show_seasone',[seasone_controller::class,'show']);
////////////////////////video
Route::post('store_video',[video_controller::class,'create']);
Route::post('update_video/{uuid}',[video_controller::class,'update']);
Route::get('destore_video/{uuid}',[video_controller::class,'destore']);
Route::get('show_video',[video_controller::class,'show']);
////////////////////////sport
Route::post('store_sport',[sport_controller::class,'create']);
Route::post('update_sport/{uuid}',[sport_controller::class,'update']);
Route::get('destore_sport/{uuid}',[sport_controller::class,'destore']);
Route::get('index_sport',[sport_controller::class,'index']);
////////////////////////employee
Route::post('store_employee',[employee_controller::class,'create']);
Route::post('update_employee/{uuid}',[employee_controller::class,'update']);
Route::get('destore_employee/{uuid}',[employee_controller::class,'destore']);
Route::get('index_employee',[employee_controller::class,'index']);
////////////////////////club
Route::post('store_club',[club_controller::class,'create']);
Route::post('update_club/{uuid}',[club_controller::class,'update']);
Route::get('destore_club/{uuid}',[club_controller::class,'destore']);
Route::get('index_club',[club_controller::class,'index']);
Route::get('show_club',[club_controller::class,'show']);
////////////////////////matche
Route::post('store_matche',[matche_controller::class,'store']);
Route::post('update_matche/{uuid}',[matche_controller::class,'update']);
Route::get('destore_matche/{uuid}',[matche_controller::class,'destore']);
Route::get('index_matche',[matche_controller::class,'index']);
Route::get('show_matche',[matche_controller::class,'show']);
////////////////////////player
Route::post('store_player',[Player_Controller::class,'store']);
Route::post('update_player/{uuid}',[Player_Controller::class,'update']);
Route::get('destore_player/{uuid}',[Player_Controller::class,'destore']);
Route::get('index_player',[Player_Controller::class,'index']);
Route::get('show_player',[Player_Controller::class,'show']);
////////////////////////replacment
Route::post('store_reolacment',[replacments_controller::class,'store']);
Route::post('update_reolacment/{uuid}',[replacments_controller::class,'update']);
Route::get('destore_reolacment/{uuid}',[replacments_controller::class,'destore']);
Route::get('show_reolacment',[replacments_controller::class,'show']);
///////////////////////plan
Route::post('store_plan',[plan_controller::class,'store']);
Route::post('update_plan/{uuid}',[plan_controller::class,'update']);
Route::get('destore_plan/{uuid}',[plan_controller::class,'destore']);
Route::get('index_plan',[plan_controller::class,'index']);
///////////////////////statistic
Route::post('store_statistic',[statistic_controller::class,'store']);
Route::post('update_statistic/{uuid}',[statistic_controller::class,'update']);
Route::get('destore_statistic/{uuid}',[statistic_controller::class,'destore']);
Route::get('index_statistic',[statistic_controller::class,'index']);
///////////////////////posse
Route::post('store_posse',[posse_controller::class,'store']);
Route::post('update_posse/{uuid}',[posse_controller::class,'update']);
Route::get('destore_posse/{uuid}',[posse_controller::class,'destore']);
Route::get('index_posse',[posse_controller::class,'index']);
///////////////////////wear
Route::post('store_wear',[wear_controller::class,'store']);
Route::post('update_wear/{uuid}',[wear_controller::class,'update']);
Route::get('destore_wear/{uuid}',[wear_controller::class,'destore']);
Route::get('index_wear',[wear_controller::class,'index']);
///////////////////////prime
Route::post('store_prime',[prime_controller::class,'store']);
Route::post('update_prime/{uuid}',[prime_controller::class,'update']);
Route::get('destore_prime/{uuid}',[prime_controller::class,'destore']);
Route::get('index_prime',[prime_controller::class,'index']);
//////////////////////inforemation
Route::post('store_information',[information_controller::class,'store']);
Route::post('update_information/{uuid}',[information_controller::class,'update']);
Route::get('destore_information/{uuid}',[information_controller::class,'destore']);
Route::get('index_information',[information_controller::class,'index']);
//////////////////////standing
Route::post('store_standing',[standing_controller::class,'store']);
Route::post('update_standing/{uuid}',[standing_controller::class,'update']);
Route::get('destore_standing/{uuid}',[standing_controller::class,'destore']);
Route::get('show_standing',[standing_controller::class,'show']);});




















































