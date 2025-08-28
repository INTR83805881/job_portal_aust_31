<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Customer;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CustomerResource;
use App\Http\Resources\V1\CustomerCollection;
use Illuminate\Http\Request;
use App\Filters\V1\CustomerFilter; // Import the CustomerQuery service
use App\Http\Requests\V1\StoreCustomerRequest;
use App\Http\Requests\V1\UpdateCustomerRequest;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)// request is needed to access the request object
    {
        $filter = new CustomerFilter();
        $filterItems = $filter->transform($request);

        $includeInvoices = $request->query('includeInvoices');

         $customers = Customer::where($filterItems);


       

        if ($includeInvoices) 
        {
            $customers=$customers->with('invoices');
        }
            
            
         
        return new CustomerCollection($customers->paginate()->appends($request->query()));
            // Eager load invoices if requested
        // Return a collection of customers based on the query items
        // This will return the customers data in a structured format as defined in CustomerResource
        // The CustomerResource will format the data to be returned in camelCase
        // and will include only the fields defined in the toArray method of CustomerResource
        // The CustomerCollection will handle the pagination and return the data in a collection format
        // Return all customers(displays them in JSON format in camelCase)
        // paginate->certain amount of entries in a page
    
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
    public function store(StoreCustomerRequest $request)
    {
        return new CustomerResource(Customer::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Customer $customer)
    {
         $includeInvoices = request()->query('includeInvoices');

         if($includeInvoices)
         {
            return new CustomerResource($customer->loadMissing('invoices')); //to show included invoices if true
         }

        return new CustomerResource($customer); // Returns data based on CustomerResource
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Customer $customer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCustomerRequest $request, Customer $customer)
    {
        $customer->update($request->all());
        
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Customer $customer)
    {
        //
    }
}
