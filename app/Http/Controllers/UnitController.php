<?php

namespace App\Http\Controllers;

use App\Models\Unit;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response(Unit::get());
    }
}
