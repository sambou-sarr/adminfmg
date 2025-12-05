<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Imports\CommandesImport;
use Maatwebsite\Excel\Facades\Excel;

class CommandeImportController extends Controller
{
    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new CommandesImport, $request->file('file'));

        return redirect()->back()->with('success', 'Fichier importé avec succès !');
    }
}
