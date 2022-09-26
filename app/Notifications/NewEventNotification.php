<?php

namespace App\Notifications;


use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

use NotificationChannels\Fcm\FcmChannel;
use NotificationChannels\Fcm\FcmMessage;
use NotificationChannels\Fcm\Resources\AndroidConfig;
use NotificationChannels\Fcm\Resources\AndroidFcmOptions;
use NotificationChannels\Fcm\Resources\AndroidNotification;
use NotificationChannels\Fcm\Resources\ApnsConfig;
use NotificationChannels\Fcm\Resources\ApnsFcmOptions;

use app\Models\Event;

class NewEventNotification extends Notification
{
    use Queueable;
    protected $event;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Event $event)
    {
        $this->event=$event;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */

    // Notification Channel: mail, database
    public function via($notifiable)
    {
       $channels = ['database'];
    //   if (in_array('mail', $notifiable->notification_options)) {
    //    $channel[] = 'mail';
    //   }
       return $channels;
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->line('Anew event occur')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }
    
    public function toDatabase($notifiable)
    {
        return [
            'title' => 'New Event',
            'message' => $this->event->match_id. 'new event occur',

        ];
    }
  

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
           'title'=>'New Event',
           'body'=>'New event occur',
           'action'=>url('matches/'.$this->event->match_id),
           'event'=>$this->event->id
        ];
    }

    //public function toFcm($notifiable)
    //{
        //return FcmMessage::create()
    //        ->setData(['event_id' => $this->event->id, 'match_id' => $this->event->match_id])
    //        ->setNotification(\NotificationChannels\Fcm\Resources\Notification::create()
    //            ->setTitle('Anew event occur')
    //            ->setBody('A'.$this->event->TypeOfEvents->name.'accur in match')
    //           )
    //        ->setAndroid(
    //            AndroidConfig::create()
    //                ->setFcmOptions(AndroidFcmOptions::create()->setAnalyticsLabel('analytics'))
    //                ->setNotification(AndroidNotification::create()->setColor('#0A0A0A'))
    //        )->setApns(
    //            ApnsConfig::create()
    //                ->setFcmOptions(ApnsFcmOptions::create()->setAnalyticsLabel('analytics_ios')));
    //}

   
}
