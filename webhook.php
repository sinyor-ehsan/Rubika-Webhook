<?php

$token = "token_bot";
$url_webhook = "https://yourdomain.com/bot.php";

echo "fix endpoint Rubika\n";
$endpoints = [
    "ReceiveUpdate",
    "ReceiveInlineMessage",
    "ReceiveQuery",
    "GetSelectionItem",
    "SearchSelectionItems"
];
foreach ($endpoints as $endpoint) {
    $data = [
        "url" => $url_webhook,
        "type" => $endpoint
    ];

    try {
        $url = "https://botapi.rubika.ir/v3/" . $token . "/" . "updateBotEndpoints";
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $raw = curl_exec($ch);
        $response = json_decode($raw);

        echo $endpoint . ":\n";

        if (isset($response->status) && $response->status === "OK") {
            $statusText = isset($response->data->status) ? $response->data->status : "unknown";
            echo "   ✅ done - status: " . $statusText . "\n";
        } else {
            echo "   ❌ error - response: " . json_encode($response) . "\n";
        }

    } catch (\Exception $e) {
        echo $endpoint . ":\n";
        echo "   ❌ error Network: " . $e->getMessage() . PHP_EOL . "\n";
    }

    usleep(500000);
}

echo "the end!";

?>