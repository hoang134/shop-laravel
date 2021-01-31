<?php

namespace App\Helpers;

use App\Mail\GeneralMail;
use App\Models\Setting;

class MailHelper
{
    /**
     * Send mail order information
     *
     * @param string $toEmail
     * @param array $dataView
     */
    public static function sendMailOrderInfo($toEmail, $dataView)
    {
        $setting = Setting::first();

        //Send mail
        $subject = 'Thông tin đơn hàng';

        $mailJob = new GeneralMail();
        $mailJob->setFromDefault()
            ->setView('emails.order-info', $dataView)
            ->setSubject($subject)
            ->setTo($toEmail);

        if ($setting) {
            $mailJob->setFrom($setting->email, $setting->company);
        } else {
            $mailJob->setFromDefault();
        }
        $mailJob->sentMail();
    }
}
