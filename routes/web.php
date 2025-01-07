<?php

use App\Http\Controllers\ClienteController;
use App\Http\Controllers\EmpresaController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\EstoqueController;
use App\Http\Controllers\FuncionarioController;
use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReceitaController;
use App\Http\Controllers\VendaController;
use Illuminate\Support\Facades\Route;

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

    Route::resource('clientes', ClienteController::class);
    Route::resource('funcionarios', FuncionarioController::class);
    Route::resource('produtos', ProdutoController::class);
    Route::resource('estoques', EstoqueController::class);
    Route::resource('vendas', VendaController::class);
    Route::resource('empresas', EmpresaController::class);
    Route::resource('enderecos', EnderecoController::class);
    Route::get('endereco/{cep}', [EnderecoController::class, 'buscarEnderecoPorCep'])->name('buscarCep');
    Route::get('/receitas/{produto_id}', [ReceitaController::class, 'index'])->name('receitas.index');
    Route::resource('receitas', ReceitaController::class)->except(['index']);
});

require __DIR__ . '/auth.php';

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
