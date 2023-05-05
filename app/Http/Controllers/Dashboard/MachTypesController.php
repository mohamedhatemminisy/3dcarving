<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\UnitRequest;
use App\Models\MachineType;
use Illuminate\Http\Request;

class MachTypesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $mach_types = MachineType::latest()->paginate(PAGINATION_COUNT);
        return view('dashboard.machtypes.index', compact('mach_types'));  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.machtypes.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UnitRequest $request)
    {
        $data = $request->all();
        MachineType::create($data);
        return redirect()->route('mach_types.index')
            ->with(['success' => trans('admin.added')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {   
        $machine = MachineType::find($id);
        return view('dashboard.machtypes.show', compact('machine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $machine = MachineType::orderBy('id', 'DESC')->find($id);
        return view('dashboard.machtypes.edit', compact('machine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UnitRequest $request, string $id)
    {
        $machine = MachineType::find($id);
        $data = $request->all();
        $machine->fill($data)->save();
        return redirect()->route('mach_types.index')
            ->with(['success' => trans('admin.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $machine = MachineType::orderBy('id', 'DESC')->find($id);
            if (!$machine)
                return redirect()->route('mach_types.index')->with(['error' => trans('admin.coun_not_found')]);
            $machine->delete();
            return redirect()->route('mach_types.index')->with(['success' =>  trans('admin.detelted_sucess')]);
        } catch (\Exception $ex) {
            return redirect()->route('mach_types.index')->with(['error' =>  trans('admin.try_again')]);
        }
    }
}
