<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Http\Request;

class PDFController extends Controller
{
    // function to display preview
    public function preview()
    {
        return view('pdf.preview');
    }
    public function generatePDF()
    {
        $pdf = PDF::loadView('pdf.preview');    
        return $pdf->download('demo.pdf');
    }
}
