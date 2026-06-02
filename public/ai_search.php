<?php
include 'ai_search_rate_limit.php';
include 'ai_search_cache.php';

$api_key = "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";

// POST verilerini al
$question = isset($_POST['question']) ? $_POST['question'] : '';
$language = isset($_POST['lang']) ? $_POST['lang'] : 'en';  // Dil bilgisi, varsayılan "en" olacak

// Arama terimi boşsa işlemi durdur
if (!$question) {
    echo "Lütfen bir arama terimi girin.";
    exit;
}

// Cache'de yanıtı kontrol et
$response = getCachedResponse($question, $language);

if (!$response) {
    // Cache'de yanıt yoksa API'den yanıt al
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        "Content-Type: application/json",
        "Authorization: Bearer " . $api_key
    ));

    // OpenAI API'ye gönderilecek veriyi hazırlayın
    $data = [
        "model" => "gpt-4o",
        "messages" => [
            ["role" => "system", "content" => "Always answer in $language.Only answer in $language. Definitely do not answer in Turkish.
            
Firma adım BoxProducer® - ATI IC VE DIS TIC.LTD.STI. Ben kutu ve ambalaj imalatı yapan bir firmayım. Tüm ülkelere ihracat yapıyorum. Tüm ürünlerimi özel ölçü ve özel baskılı olarak üretiyorum. Grafik tasarım ekibim desteğim var. Müşterilerimin Ülkelerine ithalat ve kargo için isterlerse danışmanlık veriyorum. Tüm sektörlere Ürün ambalajları, gıda ambalajları, E-ticaret ambalajları ve Endüstriyel ambalajlar üretiyorum.

Ürünlerimizi geniş bir dağıtım ağı aracılığıyla dünya çapında teslim ediyoruz.
Müşterilerimize ihracat sürecinin her alanında kapsamlı destek sağlıyoruz.
Müşterilerimize yaratıcı ve özelleştirilebilir grafik tasarım hizmetleri sunuyoruz.
Müşterilerimize teknik şartname ve hammadde bilgileri konusunda danışmanlık hizmeti sunuyoruz.
Üretim tesislerimiz Türkiye'de ve çeşitli ülkelerde stratejik bir konuma sahiptir.

Web site başlığım 'Custom Boxes & Packaging Manufacturer | KUTU FABRIKASI®'
En son Buna uygun 155 karakterlik meta açıklama istiyorum.


ÜRETTİĞİMİZ ÜRÜNLERİN LİSTESİ:
Bakery Packaging Kategorisindekiler:
Cake Boxes
Pie Boxes
Baklava Boxes
Cupcake Boxes
Cookie Boxes
Donut Boxes
Macaron Boxes
chocolate boxes
Cupcake Boxes
Pastry Boxes

Take Out Boxes Kategorisindekiler:
Chinese Takeout Boxes
Burger Boxes
Pizza Boxes
Cardboard Trays
Wrap Boxes
Soup Bowls
Salad Boxes
Chicken Buckets
Chip Cones
Gıda Kapları

Product Boxes Kategorisindekiler:
clear boxes
Cylinder Boxes
Display Boxes
Gable Boxes
Perfume Boxes
Shipping Boxes
Box With Handle
Tin Containers

To-Go Add-Ons Kategorisindekiler:
Clear Cups
Ice Cream Cups
Paper Cups
Coffee Cups
Drink Carriers
Straws
Napkins
Sleeves

Bags Kategorisindekiler:
paper bags with handles
Doypack (Stand up pouch)
Block Bottom Bags
Greaseproof Paper Bags
Paper Sack
Hamburger Bags
Clear Cookie Bags

Accessories Kategorisindekiler:
Confectionery Cushion Pads
Cake Base Discs
Divisions (Corrugated and Solid Board)
Cupcake Inserts
Greaseproof Paper
Lids
Cup Holders
Stickers
chocolate Tray


Our Contact:

+90850 532 9200
Maltepe Mah. Davutpasa Cad. No:12 TIM2 / 2 - 476 - Topkapı ISTANBUL / TURKIYE
info@ati.com.tr




            "],
            ["role" => "user", "content" => $question]
        ],
        "max_tokens" => 1400,
        "temperature" => 0.0
    ];

    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    // Yanıtı al
    $api_response = curl_exec($ch);
    curl_close($ch);

    $response_data = json_decode($api_response, true);
    if (isset($response_data['choices'][0]['message']['content'])) {
        $response = $response_data['choices'][0]['message']['content'];
         $response = str_replace('*', '', $response);
        cacheResponse($question, $response, $language); // Yanıtı cache'e kaydet
    } else {
        $response = "API'den yanıt alınamadı.";
    }
}

echo $response; // Yanıtı `search.php` dosyasına döndür
