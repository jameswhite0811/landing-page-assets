<?php

$url = "https://script.google.com/macros/s/AKfycby5PBV00LMwfUu2OlKj4KKRhmAE6zZhveW5enhUsWPiHu_v47fgPdcjSS2wpn7kKZzuXw/exec";

// Sanitize input
$name = trim($_POST['name'] ?? '');
$phone = trim($_POST['phone'] ?? '');
$address = trim($_POST['address'] ?? '');
$location = trim($_POST['location'] ?? '');
$agree = isset($_POST['agree']) ? 'Yes' : 'No';

// Validate
if (empty($name) || empty($phone) || empty($address) || empty($location)) {
    die('All fields are required.');
}

if (!preg_match('/^\d{10}$/', preg_replace('/\D/', '', $phone))) {
    die('Invalid phone number. Use 10 digits.');
}

// Prepare POST data
$postData = [
    'name' => $name,
    'phone' => $phone,
    'address' => $address,
    'location' => $location,
    'agree' => $agree
];

// Send to Google Apps Script
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);

$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

// Handle response
if ($response === false) {
    echo "cURL Error: $error";
} else {
    header('Location: ../thankyou.html');
    exit();
}
