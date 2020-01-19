<?php

return [
    'subject' => [
        'prefix' => '[Contact Form]'
    ],
    'emails' => [
        'to'   => 'sinisa@dvasadva.hr',
        'from' => 'eklektik909@gmail.com'
    ],
    'messages' => [
        'error'   => 'There was an error sending, please try again later.',
        'success' => 'Your message has been sent successfully.',
        'validation' => [
            'emptyname'    => 'Name is required.',
            'emptyemail'   => 'Email is invalid.',
            'emptysubject' => 'Subject is required.',
            'emptymessage' => 'Message is required.'
        ]
    ],
    'fields' => [
        'name'     => 'Name',
        'email'    => 'Email',
        'phone'    => 'Phone',
        'subject'  => 'Subject',
        'message'  => 'Message',
        'btn-send' => 'Send'
    ]
];