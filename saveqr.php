<?php
// Receive QR image, JSON data, and folder name from request
$data = json_decode(file_get_contents('php://input'), true);
$imageData = $data['image'];
$jsonData = $data['json'];
$folderName = $data['folder'];

// Create directory if it doesn't exist
if (!file_exists($folderName)) {
    mkdir($folderName, 0777, true);
}

// Generate unique filenames for JSON and QR code files
$jsonFilename = $folderName . '/data.json';
$imageFilename = $folderName . '/qrcode.png';

// Save JSON data to file
file_put_contents($jsonFilename, $jsonData);

// Convert base64 image data to image and save to file
file_put_contents($imageFilename, base64_decode(preg_replace('#^data:image/\w+;base64,#i', '', $imageData)));

// Send response
echo json_encode(['success' => true, 'folder' => $folderName]);
?>
