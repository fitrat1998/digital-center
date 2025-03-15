<?php

namespace App\Http\Controllers;

use App\Models\Request as RequestModel;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Log;
use Vonage\Client;
use Vonage\Client\Credentials\Basic;
use Vonage\SMS\Message\SMS;


class RequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requests = RequestModel::all();

        return view('requests.index', compact('requests'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    function sendSms($to, $message)
    {
        $basic = new \Vonage\Client\Credentials\Basic(env('VONAGE_KEY'), env('VONAGE_SECRET'));
        $client = new \Vonage\Client($basic);

        try {
            $response = $client->sms()->send(
                new \Vonage\SMS\Message\SMS($to, env('VONAGE_FROM'), $message)
            );

            \Log::info("To‘liq SMS javobi: " . json_encode($response));

            if (!$response) {
                return "API dan hech qanday javob kelmadi!";
            }

            $message = $response->current();

            if (!$message) {
                return "API javob obyektida hech narsa yo‘q!";
            }

            return $message->getStatus() == 0 ? "SMS yuborildi!" : "Xatolik: " . $message->getStatus();
        } catch (\Exception $e) {
            \Log::error("SMS yuborishda xatolik: " . $e->getMessage());
            return "Xatolik: " . $e->getMessage();
        }
    }







    public function accept(Request $request)
    {
        $req = RequestModel::find($request->accept_id);

        if ($req) {
            $req->update([
                'comment' => $request->comment,
                'status' => 'accepted',
            ]);

            $phone = preg_replace('/[^0-9]/', '', $req->phone); // Faqat raqamlarni olish
            $phone = '+998' . substr($phone, -9); // Oxirgi 9 ta raqamni olib, oldiga 998 qo‘shish

//            return $last7Digits;


            $smsNatija = $this->sendSms($phone, 'Murojatingiz qabul qilindi');

            return redirect()->back()->with('success', __('messages.requests.accept'))->with('sms_status', $smsNatija);
        }

        return redirect()->back()->with('error', 'Murojat topilmadi');
    }

    public function reject(Request $request)
    {
        $req = RequestModel::find($request->reject_id);

        if ($req) {
            $req->update([
                'comment' => $request->comment,
                'status' => 'rejected',
            ]);
            return redirect()->back()->with('danger', __('messages.requests.reject'));
        }

        return redirect()->back();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequestRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequestRequest $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        //
    }
}
