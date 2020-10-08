<?php
namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class AdminPasswordResetNotification extends ResetPasswordNotification
{
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('【IIDXMEMO】パスワード再設定')
            ->view('admin.email.password_reset', [
                'url' => url('admin/password/reset', $this->token).'?email='.$notifiable->email,
                'login_id' => $notifiable->login_id,
            ]);
    }
}
