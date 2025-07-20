<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['url'])) {
    $url = trim($_POST['url']);

    // Twitter / X URL doğrulaması
    if (!preg_match('/^https?:\/\/(www\.)?(twitter\.com|x\.com)\/\w+\/status\/\d+/', $url)) {
        echo "<script>alert('Geçersiz Twitter URL\\'si');window.history.back();</script>";
        exit;
    }

    // twdown.net'e POST verisi
    $postdata = http_build_query(['URL' => $url]);

    $opts = [
        "http" => [
            "method" => "POST",
            "header" => "Content-type: application/x-www-form-urlencoded\r\n" .
                        "User-Agent: Mozilla/5.0\r\n",
            "content" => $postdata
        ]
    ];

    $context = stream_context_create($opts);
    $result = @file_get_contents("https://twdown.net/download.php", false, $context);

    if (!$result) {
        echo "<script>alert('Dış servis bağlantı hatası!');window.history.back();</script>";
        exit;
    }

    // MP4 linkleri çek
    preg_match_all('/href="(https:\/\/[^"]+\.mp4[^"]*)"/', $result, $matches);

    if (!empty($matches[1])) {
        $video_url = $matches[1][0];
        $filename = 'twitter_video_' . time() . '.mp4';

        // Tarayıcıya dosya indirme başlat
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        // Uzaktaki MP4 dosyasını oku ve sun
        readfile($video_url);
        exit;
    } else {
        echo "<script>alert('Video bağlantısı bulunamadı. Link geçersiz veya korumalı olabilir.');window.history.back();</script>";
        exit;
    }
}
?>
