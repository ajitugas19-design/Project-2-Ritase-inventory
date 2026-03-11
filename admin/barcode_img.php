<?php
/**
 * Generate Barcode using Pure PHP (Code128) - SVG Output
 * Replaces deprecated Google Charts API
 * Works with any PHP version - no extensions required
 */

// Get barcode text from query string
$text = isset($_GET['text']) ? $_GET['text'] : '12345';

// Generate Code128 barcode as SVG
generateCode128SVG($text);

/**
 * Generate Code128 barcode as SVG
 */
function generateCode128SVG($text) {
    // Code 128 B character patterns (including start, checksum, stop)
    $patterns = [
        '212222', '222122', '222221', '121223', '121322', '131222', '122213',
        '122312', '132212', '221213', '221312', '231212', '112232', '122132',
        '122231', '113222', '123122', '123221', '223211', '221132', '221231',
        '213212', '223112', '312131', '311222', '321122', '321221', '312212',
        '322112', '322211', '212123', '212321', '232121', '111323', '131123',
        '131321', '112313', '132113', '132311', '211313', '231113', '231311',
        '112133', '112331', '132131', '113123', '113321', '133121', '313121',
        '211331', '231131', '213113', '213311', '213131', '311123', '311321',
        '331121', '312113', '312311', '332111', '314111', '221411', '431111',
        '111224', '111422', '121124', '121421', '141122', '141221', '112214',
        '112412', '122114', '122411', '142112', '142211', '241211', '221114',
        '413111', '241112', '134111', '111242', '121142', '121241', '114212',
        '124112', '124211', '411212', '421112', '421211', '212141', '214121',
        '412121', '111143', '111341', '131141', '114113', '114311', '411113',
        '411311', '113141', '114131', '311141', '411131', '211412', '211214',
        '211232', '2331112'
    ];
    
    $startB = 104;
    $stop = 106;
    
    // Convert text to ASCII values
    $codes = [];
    $checksum = $startB;
    
    $codes[] = $startB;
    
    for ($i = 0; $i < strlen($text); $i++) {
        $val = ord($text[$i]) - 32;
        if ($val < 0 || $val > 95) {
            $val = 0; // Default to space for invalid chars
        }
        $codes[] = $val;
        $checksum += $val * ($i + 1);
    }
    
    $checksum = $checksum % 103;
    $codes[] = $checksum;
    $codes[] = $stop;
    
    // Calculate dimensions
    $barWidth = 2;
    $height = 60;
    $padding = 10;
    $totalWidth = 0;
    
    foreach ($codes as $code) {
        if (isset($patterns[$code])) {
            $pattern = $patterns[$code];
            for ($i = 0; $i < strlen($pattern); $i++) {
                $totalWidth += $barWidth * intval($pattern[$i]);
            }
        }
    }
    
    $totalWidth += $padding * 2;
    
    // Build SVG
    $svg = '<?xml version="1.0" encoding="UTF-8"?>
<svg xmlns="http://www.w3.org/2000/svg" width="' . $totalWidth . '" height="' . $height . '" viewBox="0 0 ' . $totalWidth . ' ' . $height . '">
<rect width="100%" height="100%" fill="white"/>
<g fill="black">';
    
    $x = $padding;
    foreach ($codes as $code) {
        if (isset($patterns[$code])) {
            $pattern = $patterns[$code];
            for ($i = 0; $i < strlen($pattern); $i++) {
                $w = $barWidth * intval($pattern[$i]);
                if ($pattern[$i] % 2 == 1) {
                    $svg .= '<rect x="' . $x . '" y="' . $padding . '" width="' . $w . '" height="' . ($height - $padding - 15) . '"/>';
                }
                $x += $w;
            }
        }
    }
    
    $svg .= '</g>
<text x="' . ($totalWidth / 2) . '" y="' . ($height - 2) . '" text-anchor="middle" font-family="monospace" font-size="12">' . htmlspecialchars($text) . '</text>
</svg>';
    
    // Output SVG
    header('Content-Type: image/svg+xml');
    echo $svg;
}

