<?php

namespace App\Http\Controllers;

use App\Jobs\ImportCsvData;
use App\Models\Employee;
use App\Models\Supermarket;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ImportController extends Controller
{

    public function importEmployees(Request $request, Supermarket $supermarket)
    {
        $file = $request->file('csv_file');
        if (request()->isMethod('post')) {
            $path = $file->getPathname();

            $supermarkets = $request->input('supermarket_id');

            $data = array_map('str_getcsv', file($path));

            DB::beginTransaction();

            try {
                foreach ($data as $row) {
                    $employee = new Employee();
                    $employee->name = $row[0];
                    $employee->type = $row[1];
                    $employee->gender = $row[2];
                    $employee->manager_id = $supermarkets;
                    $employee->save();
                }

                DB::commit();

                return redirect()->route('supermarkets.index')->with('success', 'Employees imported successfully.');
            } catch (\Exception $e) {
                DB::rollBack();

                return redirect()->back()->with('error', 'Error occurred during employee import: ' . $e->getMessage());
            }
        }
        ImportCsvData::dispatch($supermarket, $file)->onQueue('imports');
    }
    public function importSuppliers(Request $request, Supermarket $supermarketId)
    {
        $file = $request->file('csv_file');

        if (!$file) {
            return redirect()->back()->with('error', 'Please upload a CSV file.');
        }

        $path = $file->getPathname();

//    public function importSuppliers(Request $request)
//    {
//        $file = $request->file('csv_file');
//
//        if (!$file) {
//            return redirect()->back()->with('error', 'Please upload a CSV file.');
//        }
//
//        $path = $file->getPathname();
//
//        $supermarketId = $request->input('supermarket_id');

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

}

