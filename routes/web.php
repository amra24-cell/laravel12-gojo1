<?php

use App\Http\Controllers\ProfileController;
use Database\Seeders\ProductSeeder;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Models\Product;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/hello', function () {
    return view('hello');
});

Route::get('/greeting', function () {
    $name = 'James';
    $last_name = 'Mars';
    return view('greeting', compact('name', 'last_name'));
});

Route::get('/gallery2', function () {
    $images = [
        "https://cdn.pixabay.com/photo/2014/11/02/10/41/plane-513641_960_720.jpg",
        "https://cdn.pixabay.com/photo/2015/04/23/22/00/tree-736885_960_720.jpg",
        "https://cdn.pixabay.com/photo/2015/12/01/20/28/road-1072823_960_720.jpg"
    ];
    
    return view('gallery2', compact('images'));
});

Route::get("/gallery/ant", function () {
    $ant = "https://cdn3.movieweb.com/i/article/Oi0Q2edcVVhs4p1UivwyyseezFkHsq/1107:50/Ant-Man-3-Talks-Michael-Douglas-Update.jpg";
    return view("test/ant", compact("ant"));
});

Route::get("/gallery/bird", function () {
    $bird = "https://images.indianexpress.com/2021/03/falcon-anthony-mackie-1200.jpg";
    return view("test/bird", compact("bird"));
});

Route::get("/gallery/cat", function () {
    $cat = "https://media.newyorker.com/photos/5a875e3f33aebd0cab9bab12/master/w_2560%2Cc_limit/Brody-Passionate-Politics-Black-Panther.jpg";
    return view("test/cat", compact("cat"));
});

Route::get("/gallery", function () {
    $ant = "https://cdn3.movieweb.com/i/article/Oi0Q2edcVVhs4p1UivwyyseezFkHsq/1107:50/Ant-Man-3-Talks-Michael-Douglas-Update.jpg";
    $bird = "https://images.indianexpress.com/2021/03/falcon-anthony-mackie-1200.jpg";
    $cat = "https://media.newyorker.com/photos/5a875e3f33aebd0cab9bab12/master/w_2560%2Cc_limit/Brody-Passionate-Politics-Black-Panther.jpg";
    
    // ส่งตัวแปรทั้งหมดไปที่หน้า index
    return view("test/index", compact("ant", "bird", "cat"));
});

Route::get('/active/index', function () {
    return view('active/index');
})->name('index');

Route::get( '/active/about' , function () {
 return view('active/about');
})->name('about');

Route::get( '/active/services' , function () {
 return view('active/services');
})->name('services');

Route::get( '/active/portfolio' , function () {
 return view('active/portfolio');
})->name('portfolio' );

Route::get( '/active/team' , function () {
 return view('active/team');
})->name('team');

Route::get( '/active/blog' , function () {
 return view('active/blog');
})->name('blog');

Route::get( '/active/contact' , function () {
 return view('active/contact');
})->name('contact');

Route::get('query/sql', function () {
    $products = DB::select("SELECT * FROM products");
    // $products = DB::select("SELECT * FROM products WHERE price > 100");
    return view('query-test', compact('products'));
});

Route::get('query/builder', function () {
    $products = DB::table('products')->get();
    // $products = DB::table('products')->where('price', '>', 100)->get();
    return view('query-test', compact('products'));
});

Route::get('query/orm', function () { 
    $products = Product::get();  
    // $products = Product::where('price', '>', 100)->get();
    return view('query-test', compact('products'));
});

Route::get('product/form', function () {
    // ใส่ไว้กัน bugs
})->name("product.form");

Route::get('barchart', function () {    
    return view('barchart');
})->name('barchart');

