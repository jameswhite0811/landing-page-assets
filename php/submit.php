<?php

$url = "https://script.google.com/macros/s/AKfycbzWWvKLH-bTqwP3UjuzCjNOQZu3HjE34tVcfB3ex1SmV8L4u5g1MVTNWaL4s5W4nh_2gQ/exec"; // Replace with your actual Apps Script URL

$postData = [
    'name' => $_POST['name'] ?? '',
    'phone' => $_POST['phone'] ?? '',
    'referred_by' => $_POST['referred_by'] ?? ''
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($postData));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification
//curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false); // Disable host verification

$response = curl_exec($ch);
$error = curl_error($ch);
curl_close($ch);

if ($response === false) {
    echo "cURL Error: " . $error;
} else {
    // Redirect to thanks.html after successful submission
    header("Location: thankyou.html");
    exit();
}


?>
