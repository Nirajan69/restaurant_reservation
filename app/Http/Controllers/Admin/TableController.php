<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Table;
use Illuminate\Http\Request;

class TableController extends Controller

{
    public function index()
    {
        $tables = Table::all();
        return view('admin.tables.index', compact('tables'));
    }

    public function create()
    {
        return view('admin.tables.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'table_name' => 'required|string|max:255',
            'members' => 'required|integer',
            'location' => 'required|string|max:255',
            'location_image' => 'nullable|image',
        ]);

        $data = $request->all();

        if ($request->hasFile('location_image')) {
            $data['location_image'] = $request->file('location_image')->store('tables', 'public');
        }

        Table::create($data);

        return redirect()->route('admin.tables.index')->with('success', 'Table added successfully!');
    }

    // public function edit(Table $table)
    // {
    //     return view('admin.tables.edit', compact('table'));
    // }

    // public function update(Request $request, Table $table)
    // {
    //     $request->validate([
    //         'table_name' => 'required|string|max:255',
    //         'members' => 'required|integer',
    //         'location' => 'required|string|max:255',
    //         'location_image' => 'nullable|image',
    //     ]);

    //     $data = $request->all();

    //     if ($request->hasFile('location_image')) {
    //         $data['location_image'] = $request->file('location_image')->store('tables', 'public');
    //     }

    //     $table->update($data);

    //     return redirect()->route('admin.tables.index')->with('success', 'Table updated successfully!');
    // }

   // Show the form for editing the table
   public function edit($id)
   {
       $table = Table::findOrFail($id);
       return view('admin.tables.edit', compact('table'));
   }

   // Handle the update request
   public function update(Request $request, $id)
   {
       $table = Table::findOrFail($id);
       $table->update($request->all());
       return redirect()->route('admin.tables.index')->with('success', 'Table updated successfully');
   }


    public function destroy(Table $table)
    {
        $table->delete();
        return redirect()->route('admin.tables.index')->with('success', 'Table deleted successfully!');
    }
}
