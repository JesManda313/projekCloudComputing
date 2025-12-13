<?php

function publishToSNS(array $payload)
{
    // ====== CONFIG (sesuaikan) ======
    $region   = "us-east-1";
    $service  = "sns";

    $topicArn = "arn:aws:sns:us-east-1:851725543086:flynow-reset-password-topic"; // contoh: arn:aws:sns:us-east-1:xxxx:flynow-email-topic

    // Learner Lab Credentials (ganti tiap lab restart)
    $accessKey = /*getenv("AWS_ACCESS_KEY_ID") ?:*/ "ASIA4MTWMM2XEQOIAE47";
    $secretKey = /*getenv("AWS_SECRET_ACCESS_KEY") ?:*/ "Pm7kM4n3D/nzCUsVBI8EVfxGaCWj34DcXLqd2pmh";
    $sessionToken = /*getenv("AWS_SESSION_TOKEN") ?:*/ "IQoJb3JpZ2luX2VjEEoaCXVzLXdlc3QtMiJIMEYCIQC9u8JBXYlAkAi551RK1K21MVKPKLs1g6+Vc1azcwN69wIhAJTgX8UVig9mjZyBi+YD4Pi1YshiaIdVXbsphQjvSJhAKqcCCBMQABoMODUxNzI1NTQzMDg2Igyv9ZuR2AWdhcqS73YqhAJg7UCz1+FlrDwubWC6YwUPq0YNpCnw2lW+kRr0pIAgbLuFk1zfFF1dOjCBm4SG8qV0fYfSyO/MvWwCPKMfEshh4Z3BqS5gQshyx+MIKjdWxaBwSRLgRezSyJfeYkS+OLHlnnTVJaRuqul2Gn5P0QYDSTlnj47P/7Jn5fdOrMazFQI1fcIb6nrBESOoLrv5gvl6Rjj0+oz4vn1vMUNsanc9VNrmY/1LyjDQzpVpzDTRy69NlDBgvO+0vLPBJzOVIqLv3p72TgE3h47vsKEDl4TJm/kplrthVyo8O1id2KfU6yp/jdC9T2RIdT1igGdptN6Cs2/GZOgyBElje9cs7lMKArdDfDDQjfPJBjqcAcWu/qKYJ+B871Dei1yxDJqqXyt83yi0gCx9Zhl/Hgkj/U/M4TEnA1k8wljqOCfcVAZhxFae9XUkylKkcgU8aNJEZ4phIck58zpQZPU/lMccHP+5McBl6kcfJAHBxI9TZ3FwD9Y6SKo1qhR6pJjPMA1oy7ZYpmemzHI+eD1MUOcWGykmI38gr+5b0s9Ci3T6ht926xcqg093gpzrpw==";

    // ====== ENDPOINT ======
    $host = "sns.$region.amazonaws.com";
    $endpoint = "https://$host/";

    // ====== REQUEST PARAMS (x-www-form-urlencoded) ======
    $messageJson = json_encode($payload, JSON_UNESCAPED_SLASHES);

    $params = [
        "Action"  => "Publish",
        "TopicArn"=> $topicArn,
        "Message" => $messageJson,
        "Version" => "2010-03-31"
    ];

    // form body (sorted)
    ksort($params);
    $body = http_build_query($params);

    // ====== SIGV4 ======
    $amzDate = gmdate("Ymd\THis\Z");
    $dateStamp = gmdate("Ymd");

    $canonicalUri = "/";
    $canonicalQueryString = "";
    $canonicalHeaders =
        "content-type:application/x-www-form-urlencoded\n" .
        "host:$host\n" .
        "x-amz-date:$amzDate\n" .
        "x-amz-security-token:$sessionToken\n";

    $signedHeaders = "content-type;host;x-amz-date;x-amz-security-token";

    $payloadHash = hash("sha256", $body);

    $canonicalRequest =
        "POST\n" .
        $canonicalUri . "\n" .
        $canonicalQueryString . "\n" .
        $canonicalHeaders . "\n" .
        $signedHeaders . "\n" .
        $payloadHash;

    $algorithm = "AWS4-HMAC-SHA256";
    $credentialScope = "$dateStamp/$region/$service/aws4_request";
    $stringToSign =
        $algorithm . "\n" .
        $amzDate . "\n" .
        $credentialScope . "\n" .
        hash("sha256", $canonicalRequest);

    // signing key
    $kDate = hash_hmac("sha256", $dateStamp, "AWS4" . $secretKey, true);
    $kRegion = hash_hmac("sha256", $region, $kDate, true);
    $kService = hash_hmac("sha256", $service, $kRegion, true);
    $kSigning = hash_hmac("sha256", "aws4_request", $kService, true);

    $signature = hash_hmac("sha256", $stringToSign, $kSigning);

    $authorizationHeader =
        $algorithm . " " .
        "Credential=" . $accessKey . "/" . $credentialScope . ", " .
        "SignedHeaders=" . $signedHeaders . ", " .
        "Signature=" . $signature;

    // ====== CURL ======
    $headers = [
        "Content-Type: application/x-www-form-urlencoded",
        "Host: $host",
        "X-Amz-Date: $amzDate",
        "X-Amz-Security-Token: $sessionToken",
        "Authorization: $authorizationHeader"
    ];

    $ch = curl_init($endpoint);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $body);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    $err = curl_error($ch);
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    // Debug file biar gampang cek
    file_put_contents(__DIR__ . "/sns_publish_debug.txt",
        "HTTP: $httpCode\nERR: $err\nRESPONSE:\n$response\n\n", FILE_APPEND
    );

    if ($httpCode < 200 || $httpCode >= 300) {
        throw new Exception("SNS Publish failed. HTTP=$httpCode. Check sns_publish_debug.txt");
    }

    return $response;
}
