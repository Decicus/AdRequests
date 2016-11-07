<?php

return [
    'fields' => [
        'desktop' => [
            'name' => 'Q1: What is the name of the tool?',
            'url' => 'Q2: What is the download URL for your tool?',
            'description' => 'Q3: Please give us a small description of your service.',
            'user_data' => 'Q4: What user data will you require?',
            'api' => 'Q5: Do you require data from the Twitch API?',
            'api_data' => 'Q5.1: What user data will you store from the Twitch API?',
            'api_scopes' => 'Q5.2: What scopes will you use from the Twitch API?',
            'api_scopes_description' => 'Q5.3: Please describe why you need each of the above scopes.',
            'tos' => 'Q6: Do you have a Terms of Service?',
            'tos_url' => 'Q6.1: Please provide a URL to your Terms of Service.',
            'open_source' => 'Q7: Is your code open source, or avaliable upon request?',
            'open_source_url' => 'Q7.1: Please provide a URL to where we can find the code.',
            'beta' => 'Q8: If you are in beta, do you expect any updates to change the above answers?',
            'beta_description' => 'Q8.1: What do you expect to change when you leave beta?'
        ]
    ]
];