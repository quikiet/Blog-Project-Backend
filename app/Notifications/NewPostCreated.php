<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewPostCreated extends Notification
{
    use Queueable;
    public $post;
    /**
     * Create a new notification instance.
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Thông báo: Bài viết mới được đăng tải')
            ->line("{$this->post->posts_user->name} đã đăng tải bài viết mới: {$this->post->title}")
            ->action('Xem chi tiết', url('/admin/posts/pending'))
            ->line('Cảm ơn bạn đã sử dụng hệ thống!');
    }

    public function toDatabase($notifiable)
    {
        $user = $this->post->posts_user;
        return [
            'message' => "Bạn có thông báo mới từ {$this->post->posts_user->name}.",
            'type' => "new_post",
            'user' => [
                'id' => $user->id,
                'name' => $user->name,
                'avatar' => $user->avatar ?? '',
                'post_slug' => $this->post->slug,
            ],
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
