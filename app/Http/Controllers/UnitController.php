<?php

namespace App\Http\Controllers;

use App\Models\Unit;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Database\Eloquent\Collection<\App\Models\Unit>
     */
    public function index()
    {
        return Unit::get();
    }
}
