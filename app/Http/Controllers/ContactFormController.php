<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ContactForm;

class ContactFormController extends Controller
{
    // Contact form page
    public function index()
    {
        return view('contact');
    }

    // Store created contact form
    public function store(Request $request)
    {
        ContactForm::create($this->validateInput($request));

        return redirect('/contact')->with('status', 'success');
    }

    // List all contact forms for an admin
    public function list()
    {
        $forms = ContactForm::get();

        return view('admin.contact.index', compact('forms'));
    }

    // Show contact form details
    public function show($id)
    {
        $form = ContactForm::find($id);

        return view ('admin.contact.detail', compact('form'));
    }

    // Delete contact form
    public function destroy(ContactForm $form)
    {
        $form->delete();

        return redirect('/admin/contact')->with('status', 'success')->with('message', 'Contact form deleted');
    }

    private function validateInput($input)
    {
        return $input->validate([
            'name' => ['required', 'max:50', 'min:2'],
            'email' => ['max:100', 'nullable'],
            'content' => ['required', 'min:10', 'max:1000'],
        ]);
    }
}
