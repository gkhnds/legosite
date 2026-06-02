<?php
// Gerekli ayarlar
$apiKey = "87c239d3137e4b9881234450a4a4299a"; // API anahtarınızı buraya ekleyin
$keyLocation = "https://customboxglobal.com/18d892efede34930962f9a452bec71bf.txt"; // Anahtar dosyanızın URL’sini buraya ekleyin
$sitemapUrl = "https://customboxglobal.com/sitemap.xml"; // Sitemap URL'nizi buraya ekleyin

echo "<h2>IndexNow Gönderici Başlatıldı</h2>";

// 1. Sitemap URL'sinden içerik çekme
echo "<p>Sitemap dosyasını alıyor...</p>";
$xmlContent = file_get_contents($sitemapUrl);

if (!$xmlContent) {
    echo "<p style='color:red;'>Sitemap dosyası alınamadı. Lütfen URL'yi kontrol edin.</p>";
    exit;
} else {
    echo "<p>Sitemap dosyası başarıyla alındı.</p>";
}

// 2. URL'leri ayrıştırma
echo "<p>URL'leri ayrıştırıyor...</p>";
$xml = new SimpleXMLElement($xmlContent);
$urls = [];
foreach ($xml->url as $url) {
    $urls[] = (string)$url->loc;
}
echo "<p>" . count($urls) . " adet URL bulundu.</p>";

// 3. IndexNow API'sine gönderim yapma
echo "<p>URL'leri IndexNow API'sine gönderiyor...</p>";
$payload = json_encode([
    "host" => parse_url($sitemapUrl, PHP_URL_HOST),
    "key" => $apiKey,
    "keyLocation" => $keyLocation,
    "urlList" => $urls,
]);

$ch = curl_init('https://api.indexnow.org/indexnow');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json',
    'Content-Length: ' . strlen($payload)
]);

$result = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
curl_close($ch);

// 4. Gönderim sonucu gösterme
if ($httpCode == 200) {
    echo "<p style='color:green;'>URL'ler başarıyla gönderildi.</p>";
} else {
    echo "<p style='color:red;'>Bir hata oluştu. HTTP Durum Kodu: $httpCode</p>";
    echo "<pre>$result</pre>"; // Detaylı hata mesajı için
}

echo "<p>İşlem tamamlandı.</p>";
?>
