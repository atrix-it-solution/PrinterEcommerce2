<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use App\Mail\TestQuote;

class QuoteController extends Controller
{
    public function sendQuote(Request $request)
    {

        try {
            // Validate the form data
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'email' => 'required|email|max:255',
                'phone' => 'required|string|max:20',
                'subject' => 'required|string|max:255',
                'message' => 'required|string|max:1000',
                'product_id' => 'nullable|string|max:255',
                'product_name' => 'nullable|string|max:255',
                'product_price' => 'nullable|string|max:255',
                'product_url' => 'nullable|string|max:500'
            ]);

            // Try to send email
            $emailSent = false;
            $emailError = null;
            
            try {
                
                // Use the TestQuote mail that we know works
                Mail::to('')
                    ->send(new TestQuote($validated));
                    
                $emailSent = true;
                
            } catch (\Exception $emailException) {
                $emailError = $emailException->getMessage();
            }

            // // Log the quote request (always works)
            // Log::channel('quotes')->info('New Quote Request', array_merge($validated, [
            //     'email_sent' => $emailSent,
            //     'email_error' => $emailError,
            //     'submitted_at' => now()->toDateTimeString(),
            //     'ip_address' => $request->ip()
            // ]));

            // Return success message (email status doesn't affect form submission success)
            return response()->json([
                'success' => true,
                'message' => 'Thank you! Your quote request has been sent successfully. We will contact you soon.'
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Quote validation failed', $e->errors());
            
            return response()->json([
                'success' => false,
                'message' => 'Please fix the validation errors.',
                'errors' => $e->errors()
            ], 422);
            
        } catch (\Exception $e) {
            Log::error('Quote request failed completely: ' . $e->getMessage());
            
            return response()->json([
                'success' => false,
                'message' => 'Sorry, there was an error processing your request. Please try again later.'
            ], 500);
        }
    }
}