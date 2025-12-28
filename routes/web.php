<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    AuthController,
    ArticleController,
    FabricController,
    AccessoryController,
    InventoryTransactionController,
    ProductionStepController,
    InvoiceController,
    CustomerController
};
use App\Models\{
    Article,
    Fabric,
    Invoice,
    ProductionStep
};

/*
|--------------------------------------------------------------------------
| 🌐 Public Routes
|--------------------------------------------------------------------------
*/

// Root → Login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| 🔐 Protected Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | 🏠 Dashboard
    |--------------------------------------------------------------------------
    */
    Route::get('/dashboard', function () {

        $stats = [
            'articles' => Article::count(),
            'fabrics' => Fabric::sum('quantity'),
            'invoices' => Invoice::count(),
            'production_pending' => ProductionStep::where('status', 'pending')->count(),
        ];

        $recentInvoices = Invoice::with('customer')
            ->latest()
            ->limit(8)
            ->get();

        return view('welcome', compact('stats', 'recentInvoices'));

    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | 📦 Core Modules
    |--------------------------------------------------------------------------
    */
    Route::resources([
        'articles' => ArticleController::class,
        'fabrics' => FabricController::class,
        'accessories' => AccessoryController::class,
        'transactions' => InventoryTransactionController::class,
        'invoices' => InvoiceController::class,
        'customers' => CustomerController::class,
    ]);

    /*
    |--------------------------------------------------------------------------
    | 🏭 Production (ARTICLE BASED – IMPORTANT)
    |--------------------------------------------------------------------------
    */

    // Production board for an ARTICLE
    Route::get(
        'production-steps/{article}',
        [ProductionStepController::class, 'index']
    )->name('production_steps.index');

//    // Update single production step
//    Route::patch(
//        'production-steps/step/{step}',
//        [ProductionStepController::class, 'update']
//    )->name('production_steps.update');
    Route::patch(
        '/production-steps/{step}',
        [ProductionStepController::class, 'update']
    )->name('production_steps.update');


    /*
    |--------------------------------------------------------------------------
    | 🔍 Search
    |--------------------------------------------------------------------------
    */
    Route::get('articles/search', [ArticleController::class, 'search'])->name('articles.search');
    Route::get('fabrics/search', [FabricController::class, 'search'])->name('fabrics.search');
    Route::get('accessories/search', [AccessoryController::class, 'search'])->name('accessories.search');
    Route::get('transactions/search', [InventoryTransactionController::class, 'search'])->name('transactions.search');
    Route::get('invoices/search', [InvoiceController::class, 'search'])->name('invoices.search');
    Route::get('customers/search', [CustomerController::class, 'search'])->name('customers.search');

    /*
    |--------------------------------------------------------------------------
    | ✅ Custom Actions
    |--------------------------------------------------------------------------
    */
    Route::patch(
        'invoices/{invoice}/approve',
        [InvoiceController::class, 'approve']
    )->name('invoices.approve');
});

//
//
//use Illuminate\Support\Facades\Route;
//use App\Http\Controllers\{
//    AuthController,
//    ArticleController,
//    FabricController,
//    AccessoryController,
//    InventoryTransactionController,
//    ProductionStepController,
//    InvoiceController,
//    CustomerController
//};
//use App\Models\{
//    Article,
//    Fabric,
//    Invoice,
//    ProductionStep
//};
//
///*
//|--------------------------------------------------------------------------
//| 🌐 Public Routes
//|--------------------------------------------------------------------------
//*/
//
//// Redirect root to login
//Route::get('/', function () {
//    return redirect()->route('login');
//});
//
//// Authentication
//Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
//Route::post('/login', [AuthController::class, 'login']);
//
//Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
//Route::post('/register', [AuthController::class, 'register']);
//
//Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
//
///*
//|--------------------------------------------------------------------------
//| 🔐 Protected Routes (Require Login)
//|--------------------------------------------------------------------------
//*/
//Route::middleware('auth')->group(function () {
//
//    /*
//    |--------------------------------------------------------------------------
//    | 🏠 Dashboard
//    |--------------------------------------------------------------------------
//    */
//    Route::get('/dashboard', function () {
//
//        $stats = [
//            'articles' => Article::count(),
//            'fabrics' => Fabric::sum('quantity'),
//            'invoices' => Invoice::count(),
//            'production_pending' => ProductionStep::where('status', 'pending')->count(),
//        ];
//
//        $recentInvoices = Invoice::with('customer')
//            ->latest()
//            ->limit(8)
//            ->get();
//
//        return view('welcome', compact('stats', 'recentInvoices'));
//
//    })->name('dashboard');
//
//    /*
//    |--------------------------------------------------------------------------
//    | 🧱 Core Resource Modules
//    |--------------------------------------------------------------------------
//    */
//    Route::resources([
//        'articles' => ArticleController::class,
//        'fabrics' => FabricController::class,
//        'accessories' => AccessoryController::class,
//        'transactions' => InventoryTransactionController::class,
//        'invoices' => InvoiceController::class,
//        'customers' => CustomerController::class,
//    ]);
//
//    /*
//    |--------------------------------------------------------------------------
//    | 🏭 Production Steps (Article Based)
//    |--------------------------------------------------------------------------
//    */
//
//    // Production board for a specific article
////    Route::get(
////        'production/{article}',
////        [ProductionStepController::class, 'index']
////    )->name('production.index');
////
////    // Update a single production step
////    Route::patch(
////        'production/step/{step}',
////        [ProductionStepController::class, 'update']
////    )->name('production.step.update');
//    Route::get('production-steps/{article}', [ProductionStepController::class, 'index'])
//        ->name('production_steps.index');
//
//    Route::patch('production-steps/step/{step}', [ProductionStepController::class, 'update'])
//        ->name('production_steps.update');
//
//    // Search
//
//
//    /*
//    |--------------------------------------------------------------------------
//    | 🔍 Search Routes
//    |--------------------------------------------------------------------------
//    */
//    Route::get('articles/search', [ArticleController::class, 'search'])->name('articles.search');
//    Route::get('fabrics/search', [FabricController::class, 'search'])->name('fabrics.search');
//    Route::get('accessories/search', [AccessoryController::class, 'search'])->name('accessories.search');
//    Route::get('transactions/search', [InventoryTransactionController::class, 'search'])->name('transactions.search');
//    Route::get('invoices/search', [InvoiceController::class, 'search'])->name('invoices.search');
//    Route::get('customers/search', [CustomerController::class, 'search'])->name('customers.search');
//
//    /*
//    |--------------------------------------------------------------------------
//    | ✅ Custom Actions
//    |--------------------------------------------------------------------------
//    */
//    Route::patch(
//        'invoices/{invoice}/approve',
//        [InvoiceController::class, 'approve']
//    )->name('invoices.approve');
//});
//
////use Illuminate\Support\Facades\Route;
////use App\Http\Controllers\{
////    ArticleController,
////    FabricController,
////    AccessoryController,
////    InventoryTransactionController,
////    ProductionStepController,
////    InvoiceController,
////    CustomerController,
////    AuthController
////};
////use App\Models\{Article, Fabric, Invoice, ProductionStep,Customer,InventoryTransaction};
////
/////*
////|--------------------------------------------------------------------------
////| 🌐 Public Routes
////|--------------------------------------------------------------------------
////*/
////
////// Redirect root (/) to login or dashboard
////Route::get('/', function () {
////    return redirect()->route('login');
////});
////
////// Authentication routes
////Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
////Route::post('/login', [AuthController::class, 'login']);
////Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
////Route::post('/register', [AuthController::class, 'register']);
////Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
////
/////*
////|--------------------------------------------------------------------------
////| 🔐 Protected Routes (Require Login)
////|--------------------------------------------------------------------------
////*/
////Route::middleware(['auth'])->group(function () {
////
////    // Dashboard / Home
////    Route::get('/home', function () {
////        $stats = [
////            'articles' => Article::count(),
////            'fabrics' => Fabric::sum('quantity'),
////            'invoices' => Invoice::count(),
////            'production_pending' => ProductionStep::where('status', 'pending')->count(),
////        ];
////        $recentInvoices = Invoice::with('customer')->latest()->limit(8)->get();
////
////        return view('dashboard', compact('stats', 'recentInvoices'));
////    })->name('home');
////
////    Route::get('/dashboard', function () {
////        $stats = [
////            'articles' => Article::count(),
////            'fabrics' => Fabric::sum('quantity'),
////            'invoices' => Invoice::count(),
////            'production_pending' => ProductionStep::where('status', 'pending')->count(),
////        ];
////        $recentInvoices = Invoice::with('customer')->latest()->limit(8)->get();
////
////        return view('welcome', compact('stats', 'recentInvoices'));
////    })->name('dashboard');
////
////    /*
////    |--------------------------------------------------------------------------
////    | 🧱 Resource Routes
////    |--------------------------------------------------------------------------
////    */
////    Route::resources([
////        'articles' => ArticleController::class,
////        'fabrics' => FabricController::class,
////        'accessories' => AccessoryController::class,
////        'transactions' => InventoryTransactionController::class,
////        'production' => ProductionStepController::class,
////        'invoices' => InvoiceController::class,
////        'customers' => CustomerController::class,
////    ]);
////
////    /*
////    |--------------------------------------------------------------------------
////    | 🔍 Search Routes
////    |--------------------------------------------------------------------------
////    */
////    Route::get('articles/search', [ArticleController::class, 'search'])->name('articles.search');
////    Route::get('fabrics/search', [FabricController::class, 'search'])->name('fabrics.search');
////    Route::get('accessories/search', [AccessoryController::class, 'search'])->name('accessories.search');
////    Route::get('transactions/search', [InventoryTransactionController::class, 'search'])->name('transactions.search');
////    Route::get('production/search', [ProductionStepController::class, 'search'])->name('production.search');
////    Route::get('invoices/search', [InvoiceController::class, 'search'])->name('invoices.search');
////    Route::get('customers/search', [CustomerController::class, 'search'])->name('customers.search');
////    Route::get('production/{article}', [ProductionStepController::class, 'index'])
////        ->name('production.index');
////
////    Route::patch('production/step/{step}', [ProductionStepController::class, 'update'])
////        ->name('production.step.update');
////
////
////    /*
////    |--------------------------------------------------------------------------
////    | ✅ Custom Routes
////    |--------------------------------------------------------------------------
////    */
////    Route::patch('invoices/{invoice}/approve', [InvoiceController::class, 'approve'])
////        ->name('invoices.approve');
////});
//////
//////use Illuminate\Support\Facades\Route;
//////use App\Http\Controllers\ArticleController;
//////use App\Http\Controllers\FabricController;
//////use App\Http\Controllers\AccessoryController;
//////use App\Http\Controllers\InventoryTransactionController;
//////use App\Http\Controllers\ProductionStepController;
//////use App\Http\Controllers\InvoiceController;
//////use App\Http\Controllers\CustomerController;
//////use App\Models\Article;
//////use App\Models\Fabric;
//////use App\Models\Invoice;
//////use App\Models\ProductionStep;
//////
//////
//////// Default homepage → landing page
////////Route::get('/', function () {
////////    return view('welcome');   // shows the homepage with module links
////////})->name('home');
//////Route::get('/home', function () {
//////    $stats = [
//////        'articles' => Article::count(),
//////        'fabrics' => Fabric::sum('quantity'),
//////        'invoices' => Invoice::count(),
//////        'production_pending' => ProductionStep::where('status','pending')->count(),
//////    ];
//////
//////    $recentInvoices = Invoice::with('customer')->latest()->limit(8)->get();
//////
////////    return view('welcome', compact('stats','recentInvoices'));
//////    return view('dashboard');
//////})->name('home');
//////// Dashboard (simple blade view, no login required)
//////Route::get('/dashboard', function () {
//////    $stats = [
//////        'articles' => Article::count(),
//////        'fabrics' => Fabric::sum('quantity'),
//////        'invoices' => Invoice::count(),
//////        'production_pending' => ProductionStep::where('status','pending')->count(),
//////    ];
//////    $recentInvoices = Invoice::with('customer')->latest()->limit(8)->get();
////////    return view('dashboard');
//////    return view('welcome', compact('stats','recentInvoices'));
//////})->name('dashboard');
//////
//////// Resource routes
//////Route::resource('articles', ArticleController::class);
//////Route::resource('fabrics', FabricController::class);
//////Route::resource('accessories', AccessoryController::class);
//////Route::resource('transactions', InventoryTransactionController::class); // ✅ fixed naming
//////Route::resource('production', ProductionStepController::class);
//////Route::resource('invoices', InvoiceController::class);
//////Route::resource('customers', CustomerController::class);
//////// 🔍 Search Routes
//////Route::get('articles/search', [ArticleController::class, 'search'])->name('articles.search');
//////Route::get('fabrics/search', [FabricController::class, 'search'])->name('fabrics.search');
//////Route::get('accessories/search', [AccessoryController::class, 'search'])->name('accessories.search');
//////Route::get('transactions/search', [InventoryTransactionController::class, 'search'])->name('transactions.search');
//////Route::get('production/search', [ProductionStepController::class, 'search'])->name('production.search');
//////Route::get('invoices/search', [InvoiceController::class, 'search'])->name('invoices.search');
//////Route::get('customers/search', [CustomerController::class, 'search'])->name('customers.search');
//////
//////
//////// Approve invoice route
//////Route::patch('invoices/{invoice}/approve', [InvoiceController::class, 'approve'])
//////    ->name('invoices.approve');
////////Route::get('/login',[\App\Http\Controllers\Auth\AuthController::class,'Login']);
