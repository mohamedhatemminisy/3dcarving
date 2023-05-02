<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\CustomerRequest;
use App\Models\Customer;
use Illuminate\Http\Request;

class CustomersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::latest()->paginate(PAGINATION_COUNT);
        return view('dashboard.customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CustomerRequest $request)
    {
        $data = $request->all();
        $data['added_by'] = auth()->user()->id;
        Customer::create($data);
        return redirect()->route('customers.index')
            ->with(['success' => trans('admin.added')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $customer = Customer::find($id);
        return view('dashboard.customers.show', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $customer = Customer::orderBy('id', 'DESC')->find($id);
        return view('dashboard.customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CustomerRequest $request, string $id)
    {
        $customer = Customer::find($id);
        $data = $request->all();
        $data['added_by'] = auth()->user()->id;
        $customer->fill($data)->save();
        return redirect()->route('customers.index')
            ->with(['success' => trans('admin.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //get specific customers and its translations
        try {
            $customer = Customer::orderBy('id', 'DESC')->find($id);
            if (!$customer)
                return redirect()->route('customers.index')->with(['error' => trans('admin.coun_not_found')]);
            $customer->delete();
            return redirect()->route('customers.index')->with(['success' =>  trans('admin.detelted_sucess')]);
        } catch (\Exception $ex) {
            return redirect()->route('customers.index')->with(['error' =>  trans('admin.try_again')]);
        }
    }
}
