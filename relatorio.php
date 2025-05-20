<?php

require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\RelatorioController;

$relatorio = new RelatorioController();
$relatorio->gerarPdf();
