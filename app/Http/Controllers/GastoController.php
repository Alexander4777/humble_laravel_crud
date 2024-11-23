<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gasto_ingreso;

class GastoController extends Controller
{
    public function getJson() {
        $gastos = Gasto_ingreso::all();

        return $gastos->toJson();
    }
}
