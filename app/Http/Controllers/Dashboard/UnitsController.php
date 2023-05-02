<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Unit;
use Illuminate\Http\Request;
use App\Http\Requests\Dashboard\UnitRequest;

class UnitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::latest()->paginate(PAGINATION_COUNT);
        return view('dashboard.units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.units.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitRequest $request)
    {
        $data = $request->all();
        Unit::create($data);
        return redirect()->route('units.index')
            ->with(['success' => trans('admin.added')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $unit = Unit::find($id);
        return view('dashboard.units.show', compact('unit'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $unit = Unit::orderBy('id', 'DESC')->find($id);
        return view('dashboard.units.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitRequest $request, string $id)
    {
        $unit = Unit::find($id);
        $data = $request->all();
        $unit->fill($data)->save();
        return redirect()->route('units.index')
            ->with(['success' => trans('admin.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $unit = Unit::orderBy('id', 'DESC')->find($id);
            if (!$unit)
                return redirect()->route('units.index')->with(['error' => trans('admin.coun_not_found')]);
            $unit->delete();
            return redirect()->route('units.index')->with(['success' =>  trans('admin.detelted_sucess')]);
        } catch (\Exception $ex) {
            return redirect()->route('units.index')->with(['error' =>  trans('admin.try_again')]);
        }
    }
}
