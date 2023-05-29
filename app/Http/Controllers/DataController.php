<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Data;
use App\Models\form;

class DataController extends Controller
{
    public function edit($id = null)
    {
        // Fetch the data if an ID is provided
        $data = $id ? form::findOrFail($id) : new form();

        return view('edit', compact('data'));
    }

    public function save(Request $request, $id = null)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Validate the uploaded image
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // If an ID is provided, update the existing data; otherwise, create a new record
        if ($id) {
            $data = form::findOrFail($id);
            $data->update($validatedData);
        } else {
          
            form::where($id)->update($validatedData);
        }

        return redirect()->route('data.edit')->with('success', 'Data saved successfully!');
    }
}


