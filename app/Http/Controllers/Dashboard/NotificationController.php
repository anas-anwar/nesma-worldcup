<?php

namespace App\Http\Controllers\Dashboard;

use App\DataTables\NotificationDatatable;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\NotM;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(NotificationDatatable $notifications)
    {
        
        return $notifications->render('dashboard.Notification.index',['title' => 'Notifications Page']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('dashboard.Notification.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'type' => 'required|string',
            'notifiable_type'=>'required|string',
            'notifiable_id' => 'required',
            'data' => 'required',
            'read_at' => 'required',
           
        ]);

        $result = $this->sendNotification([
            "title"=> "this is title",
            "body"=> "this is body"
        ]);
        if($result == false){
            dd("faild");
            return redirect('dashboard.Notification.create');

            //->withErrors("firebase error")
            //->withInput();

        }
        //$notification = new NotM();
        
        //$notification->id = rand(999,9999);
        //$notification->type = $request['type'];
        //$notification->notifiable_type = $request['notifiable_type'];
        //$notification->notifiable_id = $request['notifiable_id'];
        //$notification->data = $request['data'];
        ////$notification->read_at = $request['read_at'];
        
        //$result = $notification->save();

        return redirect('notifications')->with('add_status', $result);

    }
    public function sendNotification($request)
    {
        $url = 'https://fcm.googleapis.com/fcm/send';

        $FcmToken = Account::whereNotNull('device_token')->pluck('device_token')->all();

        $serverKey = 'AAAARP85D58:APA91bEEiyP8ETTPChQqzg7fNDwihDSO5mt2CTbtOAOGcRuaJfcqA2OXelQYKuiQeHKhHYHnyiGUPtFiI6BRqI6AvmUK6A8jwo7YeeKX0U4Mvo5GIdziy84GMUer-pU4dPWe01JemMeT'; 
        if(sizeof($FcmToken) == 0){
            return false;
        }
        print_r($FcmToken);
        $data = [
            "registration_ids" => $FcmToken,
            "notification" => [
                "title" => $request['title'],
                "body" => $request['body'],  
            ]
        ];
        $encodedData = json_encode($data);
    
        $headers = [
            'Authorization:key=' . $serverKey,
            'Content-Type: application/json',
        ];
    
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
        // Disabling SSL Certificate support temporarly
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $encodedData);
        // Execute post
        $result = curl_exec($ch);
        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }        
        $result_1 = json_decode($result);
        if($result_1 &&  $result_1->failure){
            return false;
        }
        // Close connection
        curl_close($ch);
        // FCM response
        //dd($result);
        return $result;
    }
     
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        //$notification = Notification::findOrFail($id);
        return view('dashboard.Notification.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'type' => 'required|string',
            'notifiable_type'=>'required|string',
            'notifiable_id' => 'required',
            'data' => 'required',
            'read_at' => 'required',
            
        ]);

        $notification = Notification::findOrfail($id);
        $notification->type = $request['type'];
        $notification->notifiable_type = $request['notifiable_type'];
        $notification->notifiable_type = $request['notifiable_type'];
        $notification->data = $request['data'];
        $notification->read_at = $request['read_at'];
        $result = $notification->save();

        return redirect('notificatios')->with('add_status', $result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Notification::findOrFail($id)->delete();
        return response()->json([
            'success' => true,
        ]);
    }
}
