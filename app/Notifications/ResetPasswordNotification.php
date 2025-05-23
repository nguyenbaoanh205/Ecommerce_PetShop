<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ResetPasswordNotification extends Notification
{
    use Queueable; // Nếu bạn muốn sử dụng hàng đợi cho notification

    public $token;

    public function __construct($token)
    {
        $this->token = $token; // Lưu token để sử dụng trong email
    }

    public function via($notifiable)
    {
        return ['mail']; // Chỉ định rằng notification sẽ được gửi qua email
    }

    public function toMail($notifiable)
    {
        // Tạo URL đặt lại mật khẩu
        $resetUrl = url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false));

        return (new MailMessage)
            ->subject('Đặt lại mật khẩu tài khoản')
            ->view('emails.reset-password', ['resetUrl' => $resetUrl]); // Sử dụng view email
    }
}
