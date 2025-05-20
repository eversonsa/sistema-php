<?php
require_once __DIR__ . '/vendor/autoload.php';

use App\Controller\ExportController;

$controller = new ExportController();
$controller->exportarLivrosExcel();
