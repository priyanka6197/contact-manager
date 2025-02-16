<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contacts = Contact::all();
        return view('contacts.index', compact('contacts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('contacts.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:contacts,phone',
        ]);

        Contact::create($request->all());

        return redirect('/')->with('success', 'Contact added successfully');
    }


    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contact $contact)
    {
        return view('contacts.edit', compact('contact'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|unique:contacts,phone,' . $contact->id,
        ]);

        $contact->update($request->all());

        return redirect('/')->with('success', 'Contact updated successfully');
    }


    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Contact $contact)
    {
        $contact->delete();
        return redirect('/')->with('success', 'Contact deleted successfully');
    }

    public function importXML(Request $request)
    {
        $request->validate([
            'xml_file' => 'required|file|mimes:xml',
        ]);

        $xml = simplexml_load_file($request->file('xml_file'));

        foreach ($xml->contact as $contact) {
            Contact::updateOrCreate(
                ['phone' => (string) $contact->phone],
                ['name' => (string) $contact->name]
            );
        }

        return redirect('/')->with('success', 'Contacts imported successfully');
    }


}
