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
        ],
        'ama' => [
            'business' => [
                'name' => 'Q1: What is your business\' name?',
                'product_name' => 'Q2: What is your product\'s name?',
                'permissions' => 'Q3: Do you have the necessary permissions from the company to talk about the product on /r/Twitch?',
                'tos' => 'Q4: Do you have a Terms of Service?',
                'tos_url' => 'Q4.1: Please provide a link to your Terms of Service.',
                'user_data' => 'Q5: What user data do you require on your product?',
                'date' => 'Q6: What date would you like your AMA to start on?',
                'days' => 'Q7: How many days would you like your AMA to run for?'
            ],
            'streamer' => [
                'name' => '<i class="fa fa-1x fa-twitch"></i> Your Twitch username',
                'partnered' => 'Q1: Are you partnered with Twitch?',
                'viewers' => 'Q2: Roughly how many viewers do you get per stream?',
                'host' => 'Q3: What makes you think you would make a good AMA host?',
                'why' => 'Q4: Why do you want to have an AMA?',
                'focus' => 'Q5: What do you want to be the focus of your AMA (if anything)?',
                'background' => 'Q6: Can you give us a background on yourself and your stream?',
                'date' => 'Q7: What date would you like your AMA to start on?',
                'days' => 'Q8: How many days would you like your AMA to run for?'
            ]
        ]
    ]
];