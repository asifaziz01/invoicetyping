<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class InvoiceController extends Controller
{
    public function form()
    {
        $company = config('invoice.company');
        $client = config('invoice.client');
        $bank = config('invoice.bank');
        $signature = asset('assets/signature.png');
        return view('invoice.form', compact('company', 'client', 'bank', 'signature'));
    }

    public function generate(Request $request)
    {
        $data = $request->validate([
            'invoice_date' => 'required|date',
            'period_from'  => 'required|date',
            'period_to'    => 'required|date',
            'quantity'     => 'required|numeric|min:0',
            'rate'         => 'required|numeric|min:0',
        ]);

        $data['total'] = $data['quantity'] * $data['rate'];

        // Static config (you can later move this to config file or DB)
        $data['company'] = config('invoice.company');
        $data['client'] = config('invoice.client');
        $data['bank'] = config('invoice.bank');


        $data['invoice_no'] = 'REC' . date('Ym') . '-' . str_pad(rand(1, 99), 3, '0', STR_PAD_LEFT) . '-' . time();      

        $data['total_in_words'] = 'Rupees ' . $this->numberToWords($data['total']);
        
        // Signature
        $path = public_path('assets/signature.png');

        $type = pathinfo($path, PATHINFO_EXTENSION);
        $image = file_get_contents($path);

        $base64 = 'data:image/' . $type . ';base64,' . base64_encode($image);

        $data['signature'] = $base64;

        $pdf = Pdf::loadView('invoice.template', $data)
                  ->setPaper('a4');

        return $pdf->download($data['invoice_no'] .'.pdf');
    }

    private function numberToWords($number) {
        $f = new \NumberFormatter("en", \NumberFormatter::SPELLOUT);
        return ucfirst($f->format($number)) . ' only';
    }
}