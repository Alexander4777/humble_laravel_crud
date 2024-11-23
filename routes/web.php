<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Gasto_ingreso;
use App\Http\Controllers\GastoController;

Route::get('/', function () {
    return view('gastoForm');
});

Route::post('/addGasto', function (Request $request) {
    $nombre = $request->input('nombre');
    $tipo = $request->input('tipo');
    $cantidad = $request->input('cantidad');
    $gasto_ingreso = new Gasto_ingreso;
    $gasto_ingreso->nombre = $nombre;
    $gasto_ingreso->tipo = $tipo;
    if ($tipo == 'gasto')
        $gasto_ingreso->cantidad = -$cantidad;
    else $gasto_ingreso->cantidad = $cantidad;
    $gasto_ingreso->fecha = date("Y-m-d H:i:s");
    $gasto_ingreso->save();
    return redirect('/');
});

Route::post('/editGasto/{id}', function ($id, Request $request) {
    $gasto = Gasto_ingreso::find($id);
    $gasto->nombre = $request->input('nombre');
    $gasto->tipo = $request->input('tipo');
    $gasto->cantidad = $request->input('cantidad');
    if ($request->input('tipo') == 'gasto')
        $gasto->cantidad = -$gasto->cantidad;
    else $gasto->cantidad = $gasto->cantidad;
    $gasto->save();
    return redirect('/lista');
})->name('route.edit');


Route::get('/gastos', [GastoController::class, 'getJson']);

Route::get('/lista', function () {
    $gastos = Gasto_ingreso::all();
    return view('lista', compact('gastos'));
});

Route::get('/edit/{id}', function ($id) {
    return view('editGastoForm', compact('id'));
})->name('route.editForm');

Route::get('/delete/{id}', function ($id) {
    $gasto = Gasto_ingreso::find($id);
    $gasto->delete();
    return redirect('/lista');
})->name('route.delete');

Route::get('/grafica', function () {
    return view('grafica');
});