<?php

return [
    'secret' => $_ENV['APIKEY'],
    'algorithm' => 'HS256',
    'issuer' => 'http://localhost:8000',
    'audience' => 'http://localhost:8000',
];

