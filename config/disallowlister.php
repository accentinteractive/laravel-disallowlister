<?php

return [
    /*
     * Set named arrays of disallowed strings here. For example:
     * 'default' => ['*foo*'],
     * 'email_list' => [
     *     '*@*.ru',
     *     '*@*.hk',
     * ],
     */
    'lists' => [
        // If no list name is passed to validation, list 'default' is used.
        'default' => [],
    ],
    'is_case_sensitive' => false,
    'match_word_for_word' => false,
];
