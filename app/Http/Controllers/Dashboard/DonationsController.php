<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\DonatiorRequest;
use App\Models\Donation;
use App\Models\DonationFile;
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
        $data['added_by'] = auth()->user()->id;
        $donation = Donation::create($data);
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $file = upload_file($file, 'files_');
                $donation_files = new DonationFile();
                $donation_files->file = $file;
                $donation_files->donation_id = $donation->id;
                $donation_files->save();
            }
        }
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
        $parties = Party::get();
        $donatiors = User::role('donatior')->get();
        $donation = Donation::orderBy('id', 'DESC')->find($id);
        return view('dashboard.donations.edit', compact('donation','parties','donatiors'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(DonatiorRequest $request, string $id)
    {
        $donation = Donation::find($id);
        $data = $request->all();
        $data['added_by'] = auth()->user()->id;
        $donation->fill($data)->save();
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $file = upload_file($file, 'files_');
                $donation_files = new DonationFile();
                $donation_files->file = $file;
                $donation_files->donation_id = $donation->id;
                $donation_files->save();
            }
        }
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
