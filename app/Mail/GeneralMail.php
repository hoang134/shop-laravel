<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\{Config, Mail};

class GeneralMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $data;

    protected $viewCus;
    protected $toCus;
    protected $subjectCus;
    protected $fromEmail;
    protected $fromName;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * set view and data view
     *
     * @param string $view
     * @param array $dataView
     * @return $this
     */
    public function setView($view, $dataView = [])
    {
        $this->viewCus = $view;
        $this->data = $dataView;
        return $this;
    }

    /**
     * set from email
     *
     * @param string $email
     * @param string $name
     * @return $this
     */
    public function setFrom($email, $name)
    {
        $this->fromEmail = $email;
        $this->fromName = $name;
        return $this;
    }

    /**
     * set from email
     *
     * @return $this
     */
    public function setFromDefault()
    {
        $this->fromEmail = Config::get('mail.username');
        $this->fromName = Config::get('mail.from.name');
        return $this;
    }

    /**
     * set to email
     *
     * @param string $toMail
     * @return $this
     */
    public function setTo($toMail)
    {
        $this->toCus = $toMail;
        return $this;
    }

    /**
     * set subject email
     *
     * @param string $subject
     * @return $this
     */
    public function setSubject($subject)
    {
        $this->subjectCus = $subject;
        return $this;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from($this->fromEmail, $this->fromName)
            ->view($this->viewCus)
            ->with($this->data)
            ->subject($this->subjectCus);
    }

    /**
     * sent mail
     *
     * @return mixed
     */
    public function sentMail()
    {
        return Mail::to($this->toCus)->send($this);
    }
}
