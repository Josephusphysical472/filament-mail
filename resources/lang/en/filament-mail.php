<?php

declare(strict_types=1);

return [
    'navigation' => [
        'group' => 'Email',
        'mail_logs' => 'Mail Logs',
        'mail_templates' => 'Mail Templates',
        'suppressions' => 'Suppressions',
        'dashboard' => 'Mail Dashboard',
    ],

    'mail_log' => [
        'label' => 'Mail Log',
        'plural_label' => 'Mail Logs',
    ],

    'mail_template' => [
        'label' => 'Mail Template',
        'plural_label' => 'Mail Templates',
    ],

    'mail_suppression' => [
        'label' => 'Suppression',
        'plural_label' => 'Suppressions',
    ],

    'actions' => [
        'resend' => 'Resend',
        'retry' => 'Retry',
        'preview' => 'Preview',
        'send_test' => 'Send Test',
        'duplicate' => 'Duplicate',
        'unsuppress' => 'Unsuppress',
    ],

    'statuses' => [
        'pending' => 'Pending',
        'sent' => 'Sent',
        'delivered' => 'Delivered',
        'bounced' => 'Bounced',
        'complained' => 'Complained',
        'failed' => 'Failed',
    ],

    'widgets' => [
        'emails_sent' => 'Emails Sent',
        'delivered' => 'Delivered',
        'bounced' => 'Bounced',
        'opened' => 'Opened',
        'delivery_rate' => 'delivery rate',
        'bounce_rate' => 'bounce rate',
    ],
];
