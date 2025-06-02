<?php

namespace App\Http\Controllers;

use App\Models\ClassModel;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Checkout\Session;
use Illuminate\Http\Request;
use App\Models\Enrollment;
use App\Models\Payment;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function __construct()
    {
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    public function EnrollmentPayment(Request $request)
    {
        $request->validate([
            'price' => 'required',
        ]);
        Log::info($request->all());
        try {
            // $charge = Charge::create([
            //     'amount' => $request->price * 100,
            //     'currency' => 'jpy',
            //     'source' => $request->stripeToken,
            //     'description' => 'Enrollment Payment',
            // ]);
            // return response()->json([
            //     'status' => 'success',
            //     'message' => 'Payment successful',
            //     'data' => $charge,
            // ]);
            $class_name = ClassModel::find($request->class_id)->name;
            $session = Session::create([
                'payment_method_types' => ['card'],
                'line_items' => [
                    [
                        'price_data' => [
                            'currency' => 'jpy',
                            'product_data' => [
                                'name' => $class_name,
                            ],
                            'unit_amount' => $request->price,
                        ],
                        'quantity' => 1,
                    ],
                ],
                'mode' => 'payment',
                'success_url' => route('payment.status', ['payment_status' => 'お支払いが正常に完了しました。', 'student_id' => $request->student_id, 'class_id' => $request->class_id, 'enrollment_date' => $request->enrollment_date,'price' => $request->price,'health' => 'success']),
                // 'cancel_url' => route('enrollments.add', ['status' => 'Your Payment is failed', 'offer_id' => $offer->id, 'talkroom_id' => $request->talkroom_id, 'health' => 'failed']),
                'customer_email' => env('ADMIN_MAIL'),
            ]);
            Log::info($session);
            // return response()->json([
            //     'status' => '200',
            //     'message' => 'Payment successful',
            //     'data' => $session,
            // ]);
            return response()->json(['id' => $session->id]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => '400',
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function EnrollmentPaymentStatus(Request $request)
    {
        $request->validate([
            'payment_status' => 'required',
            'student_id' => 'required',
            'class_id' => 'required',
            'enrollment_date' => 'required',
            'health' => 'required',
        ]);
        Log::info($request->all());
        try {
            $enrollment =  Enrollment::create([
                'student_id' => $request->student_id,
                'class_id' => $request->class_id,
                'enrollment_date' => $request->enrollment_date,
                'status' => 'active',
            ]);
            Payment::create([
                'enrollment_id' => $enrollment->id,
                'amount' => $request->price,
                'payment_date' => $request->enrollment_date,
                'payment_method' => 'stripe',
                'payment_status' => $request->health,
            ]);
           
            return redirect()->route('EnrollmentPaymentSuccess');
        } catch (\Exception $e) {
            return response()->json([
                'status' => '400',
                'message' => $e->getMessage(),
            ]);
        }
    }
    public function EnrollmentPaymentSuccess()
    {
        return view('payment.success');
    }
}
