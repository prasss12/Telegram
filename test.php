<?php
$botToken = "8879076677:AAEb1IDudiK7STDCBdfSZj3LiEWnVSrKkn8";
$chatId   = "8238270594";

$message = "✅ BOT SIAP! Testing dari localhost/server - " . date('H:i:s');

$url = "https://api.telegram.org/bot$botToken/sendMessage?chat_id=$chatId&text=" . urlencode($message);
$result = file_get_contents($url);

if ($result !== false) {
    echo "✅ Berhasil! Cek Telegram Anda (pras).";
} else {
    echo "❌ Gagal. Cek koneksi internet.";
}
?>