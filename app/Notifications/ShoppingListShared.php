<?php

namespace App\Notifications;

use App\Models\ShoppingList;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ShoppingListShared extends Notification
{
    use Queueable;

    /**
     * The user who shared the shopping list
     *
     * @var \App\Models\User
     */
    private $user;

    /**
     * The affected shopping list
     *
     * @var \App\Models\ShoppingList
     */
    private $shoppingList;

    /**
     * Create a new notification instance.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\ShoppingList  $shoppingList
     * @return void
     */
    public function __construct(User $user, ShoppingList $shoppingList)
    {
        $this->user = $user;
        $this->shoppingList = $shoppingList;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // This is mainly a phpstan fix
        $subject = !is_array(__('Shoppinglist shared')) ? __('Shoppinglist shared') : 'Shoppinglist shared';

        return (new MailMessage)
            ->subject($subject)
            ->line(__('The user :email shared the shopping list :shoppingList with you.', [
                'email'        => $this->user->email,
                'shoppingList' => $this->shoppingList->name
            ]))
            ->line(__('No further action is required.'));
    }
}
