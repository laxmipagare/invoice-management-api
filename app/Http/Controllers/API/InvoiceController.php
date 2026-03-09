<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Invoice;
use Auth;
use Mpdf\Mpdf;
use Illuminate\Support\Facades\View;

class InvoiceController extends Controller
{
    //

    public function index(Request $request)
    {
        $invoices = Invoice::where('created_by',Auth::id())->get();
      
        $query = Invoice::query();
        if($request->status){
        $query->where('status',$request->status);
        }

        $invoices = $query->paginate(2);
        
        return response()->json([
        'status'=>'success',
        'data'=>$invoices
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
        'customer_name'=>'required',
        'customer_email'=>'required|email',
        'invoice_date'=>'required',
        'total_amount'=>'required'
        ]);

        $invoice = Invoice::create([

        'customer_name'=>$request->customer_name,
        'customer_email'=>$request->customer_email,
        'invoice_date'=>$request->invoice_date,
        'total_amount'=>$request->total_amount,
        'status'=>$request->status,
        'created_by'=>Auth::id()

        ]);
        return response()->json([
        'status'=>'success',
        'data'=>$invoice,
        'message'=>'Invoice created successfully'
        ]);
    }

    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return response()->json([
        'status'=>'success',
        'data'=>$invoice
        ]);
    }

    public function update(Request $request,$id)
    {   
        $invoice = Invoice::findOrFail($id);
    
        $invoice->update([
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'invoice_date' => $request->invoice_date,
            'total_amount' => $request->total_amount,
            'status' => $request->status,
            'create_by' => $request->create_by
        ]);
        
        return response()->json([
            'status' => 'success',
            'message' => 'Invoice updated successfully',
            'data' => $invoice
        ]);
    }

    public function destroy($id)
    {
        if(Auth::user()->role != 'Admin')
        {
            return response()->json(['message'=>'Unauthorized'],403);
        }
        Invoice::destroy($id);
        return response()->json([
        'status'=>'success',
        'message'=>'Invoice deleted'
        ]);
    }

    public function downloadPDF($id)
    {
        if (!Auth::check()) {
            // Return JSON 401 for API
            return response()->json([
            'message' => 'Unauthenticated.'
            ], 401);
        }
         // Find invoice
        $invoice = Invoice::findOrFail($id);

        // Generate HTML
        $html = View::make('invoice_pdf', compact('invoice'))->render();

        // Generate PDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        // Return PDF inline
        return response($mpdf->Output('invoice.pdf', 'S'), 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="invoice.pdf"');
    }

    

}
