<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\OrderRequest;
use App\Models\Customer;
use App\Models\Machine;
use App\Models\Order;
use App\Models\OrderFiles;
use App\Models\OrderMaterial;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Contracts\Role;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::get();
        $designers = User::role('designer')->get();
        $accountants = User::role('accountant')->get();
        $machines = Machine::get();
        $user = auth()->user();
        $role =  $user->getRoleNames()[0];
        $order = Order::latest();
        if($role  == 'seller'){
            $orders = $order->where('added_by', auth()->user()->id)->paginate(PAGINATION_COUNT);
        }elseif($role == 'super_admin'){
            $orders = $order->paginate(PAGINATION_COUNT);
        }elseif($role == 'designer'){
            $orders = $order->where('designer_id',$user->id)->latest()->paginate(PAGINATION_COUNT);
        }elseif($role == 'accountant'){
            $orders = $order->where('accountant_id',$user->id)->latest()->paginate(PAGINATION_COUNT);
        }
        
        return view('dashboard.orders.index', compact('machines','orders','units','designers','accountants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $customers = Customer::where('added_by',auth()->user()->id)->latest()->get();
        return view('dashboard.orders.create',compact('customers'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(OrderRequest $request)
    {
        $data = $request->all();
        $data['added_by'] = auth()->user()->id;
        $order = Order::create($data);
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $file = upload_file($file, 'files_');
                $order_files = new OrderFiles();
                $order_files->file = $file;
                $order_files->order_id = $order->id;
                $order_files->save();
            }
        }
        return redirect()->route('orders.index')
        ->with(['success' => trans('admin.added')]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::find($id);
        return view('dashboard.orders.show', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::orderBy('id', 'DESC')->find($id);
        $customers = Customer::where('added_by',auth()->user()->id)->latest()->get();
        return view('dashboard.orders.edit', compact('order','customers'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(OrderRequest $request, string $id)
    {
        $order = Order::find($id);
        $data = $request->all();
        $order->fill($data)->save();
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach ($files as $file) {
                $file = upload_file($file, 'files_');
                $order_files = new OrderFiles();
                $order_files->file = $file;
                $order_files->order_id = $order->id;
                $order_files->save();
            }
        }
        return redirect()->route('orders.index')
        ->with(['success' => trans('admin.updated')]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $order = Order::orderBy('id', 'DESC')->find($id);
            if (!$order)
                return redirect()->route('orders.index')->with(['error' => trans('admin.coun_not_found')]);
            $order->delete();
            return redirect()->route('orders.index')->with(['success' =>  trans('admin.detelted_sucess')]);
        } catch (\Exception $ex) {
            return redirect()->route('orders.index')->with(['error' =>  trans('admin.try_again')]);
        }
    }

    public function updatePrice(Request $request){
        $order = Order::find($request->order_id);
        $order->price = $request->price;
        $order->pricing_status = 'waiting_for_approval';
        $order->save();
        return redirect()->route('orders.index')
        ->with(['success' => trans('admin.price_updated')]);
    }

    public function updatePriceStatus(Request $request){
        $order = Order::find($request->order_id);
        $order->pricing_status = $request->pricing_status;
        if($request->pricing_status == 'approved'){
            $order->price_approved_at = now();
        }
        $order->save();
        return redirect()->route('orders.index')
        ->with(['success' => trans('admin.price_status_updated')]);
    }

    public function order_status(Request $request){
        $order = Order::find($request->order_id);
        $order->status = $request->status;
        $order->save();
        return redirect()->route('orders.index')
        ->with(['success' => trans('admin.order_status_updated')]);
    }
    
    public function order_designer(Request $request){
        $order = Order::find($request->order_id);
        $order->designer_id = $request->designer;
        $order->design_start_at = now();
        $order->save();
        return redirect()->route('orders.index')
        ->with(['success' => trans('admin.order_status_updated')]);
    }
    
    public function update_order_status(Request $request){
        $order = Order::find($request->order_id);
        $order->design_status = $request->design_status;
        if($request->design_status == 'compeleted'){
            $order->design_compelete_at = now();
        }
        $order->save();
        return redirect()->route('orders.index')
        ->with(['success' => trans('admin.order_status_updated')]);
    }

    public function order_accountant(Request $request){
        $order = Order::find($request->order_id);
        $order->accountant_id = $request->accountant;
        $order->save();
        return redirect()->route('orders.index')
        ->with(['success' => trans('admin.order_accountant')]);
    }
    public function order_material(Request $request){
        $data = $request->all();
        $orderMaterial = OrderMaterial::where('order_id',$request->order_id)->first();
        if($orderMaterial){
            $orderMaterial->fill($data)->save();
        }else{
             OrderMaterial::create($data);
        }
        return redirect()->route('orders.index')
        ->with(['success' => trans('admin.orderMaterial')]);
    }
    
    public function operation_status(Request $request){
        $order = Order::find($request->order_id);
        $order->operation_status = $request->operation_status;
        $order->operation_hold_reason = $request->operation_hold_reason;
        $order->save();
        return redirect()->route('orders.index')
        ->with(['success' => trans('admin.order_accountant')]);
    }
     
    public function order_machine(Request $request){
        $machine = Machine::find( $request->machine);
        $order = Order::find($request->order_id);
        $order->machine_id = $request->machine;
        $order->machine_type_id =  $machine->machine_type_id;
        $order->save();
        $machine->status = 'working';
        $machine->save();

        return redirect()->route('orders.index')
        ->with(['success' => trans('admin.order_status_updated')]);
    }

    
}
