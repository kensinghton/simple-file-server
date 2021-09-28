<?php
return [
    "appName" => "Звалище",
    "baseDir" => dirname( dirname(__FILE__) ),
    "baseUrl" => "https://battletech.com.ua",
    "background" => "",
    "installed" => "true",
    "orderBy" => "name",
    'files' => [
        "maxUploadSize" => "150", // in mb
        "allowed" =>  [
            "jpg" => "image/jpg",
            "jpeg" => "image/jpeg",
            "gif" => "image/gif",
            "png" => "image/png",
            "pdf" => "application/pdf"
        ]
    ],
    "users" => [
        "admin" => [
            "password" => "password1234",
        ],
        // add other users here
    ]
];