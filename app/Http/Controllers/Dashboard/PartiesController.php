<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\PartyRequest;
use App\Models\Party;
use Illuminate\Http\Request;

class PartiesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parties = Party::latest()->paginate(PAGINATION_COUNT);
        return view('dashboard.parties.index', compact('parties'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return view('dashboard.parties.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PartyRequest $request)
    {
        $data = $request->all();
        Party::create($data);
        return redirect()->route('parties.index')
            ->with(['success' => trans('admin.added')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $party = Party::find($id);
        return view('dashboard.parties.show', compact('party'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $party = Party::orderBy('id', 'DESC')->find($id);
        return view('dashboard.parties.edit', compact('party'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PartyRequest $request, string $id)
    {
        $party = Party::find($id);
        $data = $request->all();
        $party->fill($data)->save();
        return redirect()->route('parties.index')
            ->with(['success' => trans('admin.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $party = Party::orderBy('id', 'DESC')->find($id);
            if (!$party)
                return redirect()->route('parties.index')->with(['error' => trans('admin.coun_not_found')]);
            $party->delete();
            return redirect()->route('parties.index')->with(['success' =>  trans('admin.detelted_sucess')]);
        } catch (\Exception $ex) {
            return redirect()->route('parties.index')->with(['error' =>  trans('admin.try_again')]);
        }
    }
}
