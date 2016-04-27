<?php
namespace App\Http\Controllers;

use Illuminate\Routing\Controller as BaseController;

class MailController extends BaseController {

    //@todo update the email constant later.
    const EMAIL_TO_DEFAULT = 'email@gmail.com';

    /**
     * This is for the contact section.
     * this should just send and email and return to the contact page.
     *
     * @return view
     */
    public function sendContactEmail() {

        $objMessage = new \stdClass();

        // The template file, at this time of writting a comment it was
        // located at laravel/app/views/emails/contacts/message.blade.php
        // All data is passed in there before being sent out to: SELF::EMAIL_TO_DEFAULT.

        $objMessage->templateName = 'emails.contacts.message';

        // Much easier to pass 1 object into the Closure.
        $objMessage->senderName = Request::get('sender');
        $objMessage->senderEmail = Request::get('email');
        $objMessage->subject = Request::get('subject');
        $objMessage->messageBody = Request::get('message-body');

        // If there is no contactEmailTo in app config then use the default.
        $objMessage->emailTo = Config::get('app.contactEmailTo', MailController::EMAIL_TO_DEFAULT);

        Mail::send($objMessage->templateName, array(
            'viewModel' => $objMessage
        ),

        /**
         * This will setup an email to with the data we need to constant EMAIL_TO_DEFAULT.
         * I wrote this code to be easy to copy and paste and reuse later if I need to.
         */
        function($message) use ($objMessage)
        {
            $message->to($objMessage->emailTo, $objMessage->senderName)->subject(
                $objMessage->subject
            );
        });
    }
}
