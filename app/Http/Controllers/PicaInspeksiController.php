<?php

namespace App\Http\Controllers;

use App\Models\InspeksiLaptop;
use Illuminate\Http\Request;
use Inertia\Inertia;

class PicaInspeksiController extends Controller
{
    public function index($site)
    {
        $inspeksi_laptop = InspeksiLaptop::with('inventory.pengguna')->where('site', $site)->get();
        // return $inspeksi_laptop;
        return Inertia::render('PicaInspeksi/PicaInspeksiIndex', ['inspeksi_laptop' => $inspeksi_laptop]);
    }
}