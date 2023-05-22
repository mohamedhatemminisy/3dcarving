<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\DonatiorRequest;
use App\Models\Donation;
use App\Models\Party;
use App\Models\User;
use Illuminate\Http\Request;

class DonationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donations = Donation::latest()->paginate(PAGINATION_COUNT);
        return view('dashboard.donations.index', compact('donations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $parties = Party::get();
        $donatiors = User::role('donatior')->get();
        return view('dashboard.donations.create',compact('donatiors','parties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DonatiorRequest $request)
    {
        $data = $request->all();
        Donation::create($data);
        return redirect()->route('donations.index')
            ->with(['success' => trans('admin.added')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $donation = Donation::find($id);
        return view('dashboard.donations.show', compact('donation'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $donation = Donation::orderBy('id', 'DESC')->find($id);
        return view('dashboard.donations.edit', compact('donation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $donation = Donation::find($id);
        $data = $request->all();
        $donation->fill($data)->save();
        return redirect()->route('donations.index')
            ->with(['success' => trans('admin.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $donation = Donation::orderBy('id', 'DESC')->find($id);
            if (!$donation)
                return redirect()->route('donations.index')->with(['error' => trans('admin.coun_not_found')]);
            $donation->delete();
            return redirect()->route('donations.index')->with(['success' =>  trans('admin.detelted_sucess')]);
        } catch (\Exception $ex) {
            return redirect()->route('donations.index')->with(['error' =>  trans('admin.try_again')]);
        }
    }
}
