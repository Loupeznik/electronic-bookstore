<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;

class ContactFormController extends Controller
{
    /**
     * Show list of pending contact forms.
     * 
     */
    public function index()
    {
        $forms = ContactForm::where('status', 0)->get();

        return view('admin.contact.index', compact('forms'));
    }

    /**
     * Show form to create a new contact form
     */
    public function create()
    {
        return view('contact');
    }

    /**
     * Store created contact form.
     * 
     * @param \Illuminate\Http\Request $request
     */
    public function store(Request $request)
    {
        ContactForm::create($this->validateInput($request));

        return redirect('/contact')->with('status', 'success')->with('message', 'Contact form has been saved');
    }

    /**
     * Show contact form details
     * 
     * @param \App\Models\ContactForm $contact
     */
    public function show(ContactForm $contact)
    {
        return view('admin.contact.detail', compact('contact'));
    }

    /**
     * Delete a contact form
     * 
     * @param \App\Models\ContactForm $contact
     */
    public function destroy(ContactForm $contact)
    {
        $contact->delete();

        return redirect('/admin/contact')->with('status', 'success')->with('message', 'Contact form deleted');
    }

    private function validateInput($input)
    {
        return $input->validate([
            'name' => ['required', 'max:50', 'min:2'],
            'email' => ['required', 'max:100'],
            'content' => ['required', 'min:10', 'max:1000'],
        ]);
    }
}
