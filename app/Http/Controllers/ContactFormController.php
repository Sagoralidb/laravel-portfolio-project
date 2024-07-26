<?php
namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactFormController extends Controller
{
    public function store(Request $request) {
        $contact_form_data = $request->all();

        try {
            Mail::to('mdsagorali033@gmail.com')->send(new ContactFormMail($contact_form_data));

            return response()->json([
                'status' => true,
                'message' => 'Your mail submitted successfully.',
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => false,
                'message' => 'Failed to send email. Please try again later.',
            ]);
        }
    }
}
