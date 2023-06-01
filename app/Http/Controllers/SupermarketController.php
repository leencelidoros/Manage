<?php

namespace App\Http\Controllers;

use App\Imports\EmployeeImport;
use App\Models\Manager;
use App\Models\Supermarket;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Vtiful\Kernel\Excel;

class SupermarketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $supermarkets = Supermarket::orderBy('name')->get();
        $viewType = $request->input('viewType', 'grid');

        return view('supermarkets.index', compact('supermarkets', 'viewType'));
    }
    public function create()
    {
        $supermarkets = new Supermarket(); // Create a new instance of the Supermarket model

        return view('supermarkets.create', compact('supermarkets'));
    }

    public function store(Request $request)
    {
        $supermarket = new Supermarket();
        $supermarket->name = $request->input('name');
        $supermarket->location = $request->input('location');
        $supermarket->save();

        return redirect()->route('supermarkets.index');
    }
    public function someMethod()
    {
        $supermarketId = 1; // Replace with the actual ID of the supermarket
        $url = route('supermarkets.import-employees', ['supermarket' => $supermarketId]);


        // Use the $url variable as needed
    }

    public function edit($id)
    {
        $supermarket = Supermarket::findOrFail($id);

        return view('supermarkets.edit', compact('supermarket'));
    }

    public function update(Request $request, $id)
    {
        $supermarket = Supermarket::findOrFail($id);
        $supermarket->name = $request->input('name');
        $supermarket->location = $request->input('location');
        $supermarket->save();

        return redirect()->route('supermarkets.index');
    }

    public function destroy($id)
    {
        $supermarket = Supermarket::findOrFail($id);
        $supermarket->delete();

        return redirect()->route('supermarkets.index');
    }
    public function importEmployeesView($supermarketId)
    {
        $supermarket = Supermarket::findOrFail($supermarketId);
        return view('supermarkets.import-employees', compact('supermarket'));
    }

    public function importEmployees(Request $request, Supermarket $supermarket)
    {
        $file = $request->file('csv_file');
        if ($file->getClientOriginalExtension() === 'csv') {
            $path = $file->getPathname();
            $manager = Manager::create([
                'name' => $request->input('manager_name'),
                'phone' => $request->input('manager_phone'),
                'email'=>$request->input('manager_email'),
                'supermarket_id' => $supermarket->id,
            ]);

            Excel::import(new EmployeeImport($manager), $path);

            return redirect()->back()->with('success', 'Employees imported successfully.');
        }

        return redirect()->back()->with('error', 'Please upload a CSV file.');
    }
    public function importSuppliers(Request $request)
    {
        $file = $request->file('csv_file');

        if (!$file) {
            return redirect()->back()->with('error', 'Please upload a CSV file.');
        }

        $path = $file->getPathname();

        $supermarketId = $request->input('supermarket_id');

        $data = array_map('str_getcsv', file($path));

        DB::beginTransaction();

        try {
            foreach ($data as $row) {
                $supplier = new Supplier();
                $supplier->name = $row[0];
                $supplier->phone = $row[1];
                $supplier->location = $row[2];
                $supplier->supermarket_id = $supermarketId;
                $supplier->save();
            }

            DB::commit();

            return redirect()->route('supermarkets.index')->with('success', 'Suppliers imported successfully.');
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with('error', 'Error occurred during supplier import: ' . $e->getMessage());
        }
    }
    public function importSuppliersView($supermarketId)
    {
        $supermarket = Supermarket::findOrFail($supermarketId);
        return view('supermarkets.import-suppliers', compact('supermarket'));
    }


}
