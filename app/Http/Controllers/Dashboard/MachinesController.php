<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Machine;
use Illuminate\Http\Request;

class MachinesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $machines = Machine::latest()->paginate(PAGINATION_COUNT);
        return view('dashboard.machines.index', compact('machines'));    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.machines.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Machine::create($data);
        return redirect()->route('machines.index')
            ->with(['success' => trans('admin.added')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $machine = Machine::find($id);
        return view('dashboard.machines.show', compact('machine'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $machine = Machine::orderBy('id', 'DESC')->find($id);
        return view('dashboard.machines.edit', compact('machine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $machine = Machine::find($id);
        $data = $request->all();
        $machine->fill($data)->save();
        return redirect()->route('machines.index')
            ->with(['success' => trans('admin.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $machine = Machine::orderBy('id', 'DESC')->find($id);
            if (!$machine)
                return redirect()->route('machines.index')->with(['error' => trans('admin.coun_not_found')]);
            $machine->delete();
            return redirect()->route('machines.index')->with(['success' =>  trans('admin.detelted_sucess')]);
        } catch (\Exception $ex) {
            return redirect()->route('machines.index')->with(['error' =>  trans('admin.try_again')]);
        }
    }
}
