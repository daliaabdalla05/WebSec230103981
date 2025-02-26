<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/', function () {
    return view('welcome'); 
    });
    Route::get('/multable', function () {
    return view('multable'); 
    });
    Route::get('/even', function () {
    return view('even'); 
    });
    Route::get('/prime', function () {
    return view('prime'); 
    });
    Route::get('/MiniTest',function () {
        $bill =(object)[];
        $bill->supermarket="Carrefour";
        $bill->pos="#879837496";
        $bill->products=[
            (object)["quantity"=>1,"unit"=>"kg","name"=>"Twix","price"=>"20"],
            (object)["quantity"=>1,"unit"=>"kg","name"=>"Galaxy","price"=>"30"],
            (object)["quantity"=>1,"unit"=>"kg","name"=>"Wipes","price"=>"20"],
            (object)["quantity"=>1,"unit"=>"kg","name"=>"Paper","price"=>"40"]
        ];
        return view('minitest', ['bill' => $bill]);
        
    });
    Route::get('/Transcript', function () {
        $grade=(object)[];
        $grade->format="GPA";
        $grade->grades=[
            (object)["subject"=>"OOP","grade"=>58,"maxGrade"=>60],
            (object)["subject"=>"Network","grade"=>48,"maxGrade"=>60],
            (object)["subject"=>"English","grade"=>58,"maxGrade"=>70],
            (object)["subject"=>"Math","grade"=>54,"maxGrade"=>60]
        ];
        return view('transcript',['grade'=>$grade]); 
        });
        Route::get('products', [ProductsController::class,'list'])->name('products_list');