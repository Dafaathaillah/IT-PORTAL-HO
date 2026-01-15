<?php

namespace App\Http\Controllers;

use App\Models\InvComputer;
use App\Models\InvLaptop;
use App\Models\InvPrinter;
use App\Models\InvScanner;
use App\Models\InvServer;
use Illuminate\Http\Request;

class AllSiteController extends Controller
{
    public function byCategory(Request $request)
    {
        $category = $request->category;
        $site     = auth()->user()->site;
        // dd($category);

        switch ($category) {
            case 'LAPTOP':
                $data = InvLaptop::where('site', $site)
                    ->select('id', 'laptop_code as no_inv')
                    ->get();
                break;

            case 'COMPUTER':
                $data = InvComputer::where('site', $site)
                    ->select('id', 'computer_code as no_inv')
                    ->get();
                break;

            case 'PRINTER':
                $data = InvPrinter::where('site', $site)
                    ->select('id', 'printer_code as no_inv')
                    ->get();
                break;

                case 'SCANNER':
                $data = InvScanner::where('site', $site)
                    ->select('id', 'scanner_code as no_inv')
                    ->get();
                break;

            case 'SERVER':
                $data = InvServer::where('site', $site)
                    ->select('id', 'server_code as no_inv')
                    ->get();
                break;

            default:
                $data = collect();
        }

        return response()->json($data);
    }
}
