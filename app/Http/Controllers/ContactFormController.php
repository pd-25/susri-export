<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function showForm()
    {
        return view('contact.form');
    }

    public function sendContactForm(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'form_name' => 'required|string|max:255',
            'form_email' => 'required|email',
            'form_phone' => 'required|string|max:20',
            'form_location' => 'required|string',
            'form_message' => 'required|string',
        ]);

        try {
            // Send email
            Mail::to('recipient@example.com')->send(new ContactFormMail($validatedData));
        } catch (\Exception $e) {
            // If sending email fails, redirect back with error message
            return redirect()->back()->with('error', 'Failed to send message. Please try again later.');
        }

        // If email sent successfully, redirect back with success message
        return redirect()->back()->with('success', 'Your message has been sent successfully!');
    }
}
