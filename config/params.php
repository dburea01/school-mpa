<?php

return [
    'app_url_front' => env('APP_URL'),

    /*
    |--------------------------------------------------------------------------
    | max_emails_forgot_access_code_a_day
    |--------------------------------------------------------------------------
    | To prevent too much emails sent (= fees), an user cannot ask an email
    | to receive too much reset password links a day
    */
    'max_emails_forgot_password_a_day' => (int)env('MAX_EMAIL_FORGOT_PASSWORD_A_DAY', 3),

    /*
    |--------------------------------------------------------------------------
    | delay_validity_token_reset_password
    |--------------------------------------------------------------------------
    | Delay validity (in minutes) of a token to reset a password
    */
    'delay_validity_token_reset_password' => (int)env('DELAY_VALIDITY_TOKEN_RESET_PASSWORD', 30),

    /*
    |--------------------------------------------------------------------------
    | max_email_contact_owner_a_day
    |--------------------------------------------------------------------------
    | qty max emails an user can send to contact the owner of a classified ad (by day)
    */
    'max_email_contact_owner_a_day' => (int)env('MAX_EMAIL_CONTACT_OWNER_A_DAY', 10),

    /*
    |--------------------------------------------------------------------------
    | max_alerts_by_user
    |--------------------------------------------------------------------------
    | qty max of alerts an user can have
    */
    'max_alerts_by_user' => (int)env('MAX_ALERTS_BY_USER', 3),

    /*
    |--------------------------------------------------------------------------
    | image_width_redim
    |--------------------------------------------------------------------------
    | the uploaded images will be resized to this width
    */
    'image_width_redim' => (int)env('IMAGE_WIDTH_REDIM', 400),
];
