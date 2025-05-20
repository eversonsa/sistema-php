<?php

namespace App\Controller;

use App\Repository\LivroRepository;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportController {
    public function exportarLivrosExcel() {
        $repo = new LivroRepository();
        $livros = $repo->findAll();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Livros');

        // Cabeçalhos
        $sheet->setCellValue('A1', 'ID');
        $sheet->setCellValue('B1', 'Título');
        $sheet->setCellValue('C1', 'Autor');
        $sheet->setCellValue('D1', 'Descrição');

        // Conteúdo
        $linha = 2;
        foreach ($livros as $livro) {
            $sheet->setCellValue("A{$linha}", $livro->id);
            $sheet->setCellValue("B{$linha}", $livro->titulo);
            $sheet->setCellValue("C{$linha}", $livro->autor);
            $sheet->setCellValue("D{$linha}", $livro->descricao);
            $linha++;
        }

        // Enviar para download
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="relatorio_livros.xlsx"');
        header('Cache-Control: max-age=0');

        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}
