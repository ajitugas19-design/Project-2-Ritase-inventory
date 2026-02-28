<?php
require 'barcode/BarcodeGeneratorPNG.php';

use Picqer\Barcode\BarcodeGeneratorPNG;

$kode = $_GET['kode'];

$generator = new BarcodeGeneratorPNG();

header('Content-Type: image/png');

echo $generator->getBarcode($kode, $generator::TYPE_CODE_128, 2, 60);
