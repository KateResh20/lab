<?php

function encryptCaesar($plainText, $shift) {
    $encryptedText = "";
    $length = strlen($plainText);

    for ($i = 0; $i < $length; $i++) {
        $char = $plainText[$i];

        if (ctype_alpha($char)) {
            $isUpperCase = ctype_upper($char);
            $char = $isUpperCase ? chr((ord($char) - ord('A') + $shift + 26) % 26 + ord('A')) :
                chr((ord($char) - ord('a') + $shift + 26) % 26 + ord('a'));
            $encryptedText .= $char;
        } else {
            $encryptedText .= $char;
        }
    }

    return $encryptedText;
}

function decryptCaesar($encryptedText, $shift) {
    return encryptCaesar($encryptedText, -$shift);
}

function breakCaesarCipher($encryptedText) {
    $possibleDecryptions = [];

    // Перебор сдвигов (от 1 до 25)
    for ($shift = 1; $shift <= 25; $shift++) {
        $decryptedText = decryptCaesar($encryptedText, $shift);

        $possibleDecryptions[] = $decryptedText;
    }

    return $possibleDecryptions;
}

// Пример
$textToEncrypt = "Hello, World!";
$shiftValue = 7;

// Шифрование
$encryptedText = encryptCaesar($textToEncrypt, $shiftValue);
echo "Encrypted Text: $encryptedText\n";

// Расшифрование
$decryptedText = decryptCaesar($encryptedText, $shiftValue);
echo "Decrypted Text: $decryptedText\n";

// Расшифровка взломом
$possibleDecryptions = breakCaesarCipher($encryptedText);

// Вывод всех вариантов с разными сдвигами
echo "Decrypted text (brute force):\n";
foreach ($possibleDecryptions as $i => $decryption) {
    echo "    Variant " . ($i + 1) . ": $decryption\n";
}

?>
