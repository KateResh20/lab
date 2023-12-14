<?php

function vigenereEncrypt($plainText, $key) {
    $plainText = strtoupper($plainText);
    $key = strtoupper($key);
    $result = "";

    $keyLength = strlen($key);
    for ($i = 0, $j = 0; $i < strlen($plainText); $i++) {
        $char = $plainText[$i];
        
        if (ctype_upper($char)) {
            $result .= chr((ord($char) + ord($key[$j])) % 26 + ord('A'));
            $j = ($j + 1) % $keyLength;
        } else {
            $result .= $char;
        }
    }

    return $result;
}

function vigenereDecrypt($cipherText, $key) {
    $cipherText = strtoupper($cipherText);
    $key = strtoupper($key);
    $result = "";

    $keyLength = strlen($key);
    for ($i = 0, $j = 0; $i < strlen($cipherText); $i++) {
        $char = $cipherText[$i];

        if (ctype_upper($char)) {
            $result .= chr((ord($char) - ord($key[$j]) + 26) % 26 + ord('A'));
            $j = ($j + 1) % $keyLength;
        } else {
            $result .= $char; 
        }
    }

    return $result;
}

// Пример
$plaintext = "Information Security";
$key = "key";

$ciphertext = vigenereEncrypt($plaintext, $key);
echo "Зашифрованный текст: $ciphertext\n";

$decryptedText = vigenereDecrypt($ciphertext, $key);
echo "Расшифрованный текст: $decryptedText\n";

?>
