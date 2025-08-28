<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Invoice;
use App\Http\Requests\V1\StoreInvoiceRequest;
use App\Http\Requests\V1\UpdateInvoiceRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\InvoiceResource;
use App\Http\Resources\V1\InvoiceCollection;
use App\Filters\V1\InvoicesFilter;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)// request is needed to access the request object
    {
        $filter = new InvoicesFilter();
        $queryItems = $filter->transform($request);

        if(count($queryItems) == 0) {
            // If there are query items, filter the customers based on those items
            return new InvoiceCollection(Invoice::paginate());
        }
        else
        { // If there are no query items, return all customers
            $invoices = Invoice::where($queryItems)->paginate();

            return new InvoiceCollection($invoices->appends($request->query()));
             //so that the pagination links do not reset the query parameters
        }
        
        // Return all invoices(displays them in JSON format in camelCase)

          //camelCase -> 'customerId' instead of 'customer_id'

           // (needed for JSON consistency)

         //paginate->certain amount of entries in a page
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInvoiceRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Invoice $invoice)
    {
        //
        return new InvoiceResource($invoice); // Returns data based on InvoiceResource
        // This will return the invoice data in a structured format as defined in InvoiceResourc
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Invoice $invoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInvoiceRequest $request, Invoice $invoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
