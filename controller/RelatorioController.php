<?php

namespace App\Controller;

use Dompdf\Dompdf;
use Dompdf\Options;
use App\Repository\LivroRepository;

class RelatorioController
{
    public function gerarPdf()
    {
        $repo = new LivroRepository();
        $livros = $repo->findAll();

        // HTML que será renderizado
        $html = '<h1>Relatório de Livros</h1><table border="1" cellpadding="5" cellspacing="0">';
        $html .= '<tr><th>ID</th><th>Título</th><th>Autor</th><th>Descrição</th></tr>';

        foreach ($livros as $livro) {
            $html .= "<tr>
                        <td>{$livro->id}</td>
                        <td>{$livro->titulo}</td>
                        <td>{$livro->autor}</td>
                        <td>{$livro->descricao}</td>
                      </tr>";
        }

        $html .= '</table>';

        // Configurações do Dompdf
        $options = new Options();
        $options->set('defaultFont', 'Arial');

        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Envia para o navegador
        $dompdf->stream('relatorio_livros.pdf', ['Attachment' => false]);
    }
}
