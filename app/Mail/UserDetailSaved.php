<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class UserDetailSaved extends Mailable {
    use Queueable, SerializesModels;

    /**
    * Create a new message instance.
    */
    public $user;

    public function __construct( $user ) {
        $this->user = $user;
    }

    public function build() {
        return $this->view( 'emails.user_details_saved' )
        ->with( [ 'user' => $this->user ] );
    }

    /**
    * Get the message envelope.
    */

    public function envelope(): Envelope {
        return new Envelope(
            subject: 'User Detail Saved',
        );
    }

    /**
    * Get the message content definition.
    */

    public function content(): Content {
        return new Content(
            view: 'view.name',
        );
    }

    /**
    * Get the attachments for the message.
    *
    * @return array<int, \Illuminate\Mail\Mailables\Attachment>
    */

    public function attachments(): array {
        return [];
    }
}
