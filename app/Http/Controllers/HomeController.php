<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataImport;
use App\Imports\ExcelImport;

class HomeController extends Controller {

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $dataimport = DataImport::select('komoditi',
                        'output',
                        'konsumsiantara',
                        'pajakkurangsubsidi')
                ->orderBy('komoditi')
                ->get();
        return view('home',['dataimport' => $dataimport, 'statusimport' => '']);
    }

    public function importExcel(Request $request)
    {
        try {
            \Excel::import(new ExcelImport, $request->import_file);
            \Session::put('success', 'Your file is imported successfully in database.');
            return back();
        } catch (\Exception $e) {
            \Session::put('error', $e->getMessage());
            return back();
        }
    }

    public function emptyExcel()
    {
        DataImport::truncate();
        return back();
    }

}
