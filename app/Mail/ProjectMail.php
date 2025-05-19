<?php

namespace App\Mail;

use App\Models\Project;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Attachment;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ProjectMail extends Mailable
{
    use Queueable, SerializesModels;

    public $domain;

    public $errors;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($from = "irfan", $error = "error")
    {
        $this->domain = $from;
        $this->errors = $error;
    }

    public function build()
    {
        $projects = Project::all();

        $pdf = Pdf::loadView('content.pdf.projects', ['projects' => $projects]);
        $pdfContent = $pdf->output();
        return $this->subject('Error Report from ' . $this->domain)
            ->view('mail.send-report')
            ->attachData($pdfContent, 'projects.pdf', [
                'mime' => 'application/pdf',
            ]);
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    // public function envelope()
    // {
    //     return new Envelope(
    //         subject: 'Project Mail',
    //     );
    // }

    /**
     * Get the message content definition.
     *
     * @return \Illuminate\Mail\Mailables\Content
     */
    // public function content()
    // {
    //     return new Content(
    //         view: 'view.name',
    //     );
    // }

    /**
     * Get the attachments for the message.
     *
     * @return array
     */
    // public function attachments()
    // {
    //     return [];
    // }
}
