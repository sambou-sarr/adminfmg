<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\ClientsImport;
use App\Exports\ClientsExport;
use Maatwebsite\Excel\Facades\Excel;

class ClientExcelController extends Controller
{
    public function export()
    {
        return Excel::download(new ClientsExport, 'clients.xlsx');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,csv',
        ]);

        Excel::import(new ClientsImport, $request->file('file'));

        return back()->with('success', 'Importation des clients réussie !');
    }
}
