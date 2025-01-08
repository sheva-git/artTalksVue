<?php
header("Content-Type: application/json");
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");



$pictures = [
    [
        "id" => 1,
        "name" => "Blue Sunset",
        "artist" => "Leah Sinclair",
        "description" => "A beautiful sunset with smiley sand.",
        "image" => "http://localhost/art-talks/Backend/im1.png"
    ],
    [
        "id" => 2,
        "name" => "Red Mordicycle",
        "artist" => "Anna Marie",
        "description" => "Calm and nice picture.",
        "image" =>"http://localhost/art-talks/Backend/im2.png"
    ]
];

echo json_encode($pictures);
?>
