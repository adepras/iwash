<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Booking;

class PaymentController extends Controller
{
    public function __construct()
    {
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isProduction = config('services.midtrans.isProduction');
        Config::$isSanitized = config('services.midtrans.isSanitized');
        Config::$is3ds = config('services.midtrans.is3ds');
    }
    public function createTransaction(Request $request)
    {
        $bookingId = $request->input('booking_id');
        $booking = Booking::find($bookingId);

        if (!$booking) {
            return response()->json(['error' => 'Booking not found.'], 404);
        }

        // Configure Midtrans
        Config::$serverKey = config('services.midtrans.serverKey');
        Config::$isSanitized = true;
        Config::$is3ds = true;
        Config::$isProduction = config('services.midtrans.environment') === 'production';

        // Create transaction data
        $transactionData = [
            'transaction_details' => [
                'order_id' => $booking->id,
                'gross_amount' => $booking->price,
            ],
            'customer_details' => [
                'first_name' => $booking->name,
                'phone' => $booking->phone_number,
            ],
            'item_details' => [
                [
                    'id' => $booking->id,
                    'price' => $booking->price,
                    'quantity' => 1,
                    'name' => $booking->service . ' - ' . $booking->package,
                ],
            ],
        ];

        try {
            $snapToken = Snap::getSnapToken($transactionData);
            return response()->json(['snap_token' => $snapToken]);
        } catch (\Exception $e) {
            return response()->json(['error' =>'bro'], 500);
        }
    }

    public function getSnapToken(Request $request)
    {
        $booking = $request->booking; // Assuming booking data is passed in the request
        $transactionDetails = [
            'order_id' => $booking->id,
            'gross_amount' => $booking->price,
        ];

        $customerDetails = [
            'first_name' => $booking->name,
            'phone' => $booking->phone_number,
        ];

        $params = [
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ];

        $snapToken = Snap::getSnapToken($params);
        dd($request);
        return response()->json(['snapToken' => $snapToken]);
    }
    public function success($id)
    {
        // Handle successful payment
        $booking = Booking::findOrFail($id);
        // Update booking status or other logic
        $booking->status = 'paid';
        $booking->save();

        return view('payment.success', compact('booking'));
    }

    public function pending($id)
    {
        // Handle pending payment
        $booking = Booking::findOrFail($id);
        // Update booking status or other logic
        $booking->status = 'pending';
        $booking->save();

        return view('payment.pending', compact('booking'));
    }

    public function error($id)
    {
        // Handle payment error
        $booking = Booking::findOrFail($id);
        // Update booking status or other logic
        $booking->status = 'failed';
        $booking->save();

        return view('payment.error', compact('booking'));
    }
}
