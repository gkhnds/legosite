<?php
session_start();

$limit = 5; // 1 dakika içinde izin verilen maksimum istek sayısı
$interval = 60; // saniye cinsinden süre sınırı (1 dakika)

$user_ip = $_SERVER['REMOTE_ADDR'];

// Eğer henüz istek kaydedilmemişse yeni kayıt oluştur
if (!isset($_SESSION['rate_limit'][$user_ip])) {
    $_SESSION['rate_limit'][$user_ip] = ['count' => 0, 'timestamp' => time()];
}

$request_data = &$_SESSION['rate_limit'][$user_ip];
$current_time = time();

// Süre sınırını aşmışsa sayacı sıfırla
if ($current_time - $request_data['timestamp'] > $interval) {
    $request_data['count'] = 0;
    $request_data['timestamp'] = $current_time;
}

// İstek sayısını artır ve izin verilen sayıyı kontrol et
$request_data['count']++;
if ($request_data['count'] > $limit) {
    http_response_code(429); // Too Many Requests
    echo "Too many requests have been sent. Please try again after a while."; // Özelleştirilmiş mesaj
    exit;
}
