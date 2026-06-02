<?php
$cacheFile = 'ai_search_cache.json'; // Yanıtların kaydedileceği JSON dosyası

// Cache'de arama terimini kontrol eden fonksiyon
function getCachedResponse($question, $language) {
    global $cacheFile;
    if (!file_exists($cacheFile)) return null;

    $cachedResponses = json_decode(file_get_contents($cacheFile), true);
    $questionKey = strtolower($question . '_' . $language);

    return isset($cachedResponses[$questionKey]) ? $cachedResponses[$questionKey] : null;
}

// Yeni bir arama yanıtını cache'e kaydeden fonksiyon
function cacheResponse($question, $response, $language) {
    global $cacheFile;

    $cachedResponses = file_exists($cacheFile) ? json_decode(file_get_contents($cacheFile), true) : [];
    $questionKey = strtolower($question . '_' . $language);

    $cachedResponses[$questionKey] = $response;
    file_put_contents($cacheFile, json_encode($cachedResponses));
}
