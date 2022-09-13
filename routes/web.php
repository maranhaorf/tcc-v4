<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FornecedorController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\ItemPedidoController;
use App\Http\Controllers\PerfilController;
use App\Http\Controllers\TelaController;

use App\Http\Controllers\OrcamentoPedidoController;
use App\Http\Controllers\orcamentoController;
use Illuminate\Routing\Route as RoutingRoute;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
	return view('welcome');
});
Route::get('/sobre_nos', function () {
	return view('pagina\sobre_nos');
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {
	Route::get('table-list', function () {
		return view('pages.table_list');
	})->name('table');

	Route::get('typography', function () {
		return view('pages.typography');
	})->name('typography');

	Route::get('icons', function () {
		return view('pages.icons');
	})->name('icons');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
	})->name('notifications');

	Route::get('rtl-support', function () {
		return view('pages.language');
	})->name('language');

	Route::get('upgrade', function () {
		return view('pages.upgrade');
	})->name('upgrade');
});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);
});




Route::resource('fornecedor', FornecedorController::class);
Route::resource('orcamento', orcamentoController::class);
Route::resource('/orcamentosPedido', OrcamentoPedidoController::class);
Route::resource('produto', ProdutoController::class);
Route::resource('estoque', EstoqueController::class);
Route::resource('pedido', PedidoController::class);
Route::resource('/perfil', PerfilController::class);
Route::resource('/item', ItemPedidoController::class);

Route::get('/produto_quantidade/{id}', [App\Http\Controllers\ItemPedidoController::class, 'produto_quantidade'])->name('produto_quantidade');
Route::get('/finalizado', [App\Http\Controllers\PedidoController::class, 'finalizado'])->name('finalizado');
Route::get('/concluido', [App\Http\Controllers\PedidoController::class, 'concluido'])->name('concluido');
Route::get('/disponibilidade', [App\Http\Controllers\TelaController::class, 'disponibilidade'])->name('disponibilidade');
Route::get('/produto_quantidade_2/{id}', [App\Http\Controllers\ItemPedidoController::class, 'produto_quantidade_2'])->name('produto_quantidade_2');
Route::get('/estoque_minimo', [App\Http\Controllers\ItemPedidoController::class, 'estoque_minimo'])->name('estoque_minimo');
Route::get('/finalizar_pedido/{id}', [App\Http\Controllers\ItemPedidoController::class, 'finalizar_pedido'])->name('finalizar_pedido');
Route::get('/add_produtos/{id}', [App\Http\Controllers\PedidoController::class, 'add_produtos'])->name('add_produtos');

Route::get('/add_produtos2/{id}', [App\Http\Controllers\orcamentoController::class, 'add_produtos'])->name('add_produtos2');
Route::get('/detalhe_pedido/{id}', [App\Http\Controllers\PedidoController::class, 'detalhe_pedido'])->name('detalhe_pedido');

Route::get('/orcamento_pedido/{id}', [App\Http\Controllers\orcamentoController::class, 'orcamento_pedido'])->name('orcamento_pedido');

Route::post('/cadastro/{id}', [App\Http\Controllers\orcamentoController::class, 'cadastro'])->name('cadastro');

Route::get('/concluir_pedido/{id}', [App\Http\Controllers\ItemPedidoController::class, 'concluir_pedido'])->name('concluir_pedido');


Route::get('/produto_quantidade3/{id}', [App\Http\Controllers\OrcamentoPedidoController::class, 'produto_quantidade3'])->name('produto_quantidade3');
Route::get('/produto_quantidade4/{id}', [App\Http\Controllers\OrcamentoPedidoController::class, 'produto_quantidade4'])->name('produto_quantidade4');
Route::get('/finalizar_pedido2/{id}', [App\Http\Controllers\OrcamentoPedidoController::class, 'finalizar_pedido2'])->name('finalizar_pedido2');
