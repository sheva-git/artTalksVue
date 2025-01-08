<?php
header('Content-Type: application/json');

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");


$pictures = [
    [
        "id" => 1,
        "name" => "Sunset",
        "artist" => "James Marcol",
        "image" => "http://localhost/art-talks/Backend/im1.png",
        "resolution" => "600x400",
        "weight" => "50KB",
        "description" => "A beautiful sunset .",
        "width" => "16",
        "height" => "29",
        "size" => "15KB",
    ],
    [
        "id" => 2,
        "name" => "Bike",
        "artist" => "Emily Stone",
        "image" => "http://localhost/art-talks/Backend/im2.png",
        "resolution" => "600x400",
        "weight" => "48KB",
        "description" => "A majestic Bike with wheels.",
        "width" => "15",
        "height" => "20",
        "size" => "15KB",
    ],  
];


echo json_encode($pictures);
?>
