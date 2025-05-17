<?php

use PHPUnit\Framework\TestCase;

require_once 'model/Livro.php';
require_once 'repository/LivroRepository.php';
require_once 'service/LivroService.php';

class LivroServiceTest extends TestCase
{
    private LivroService $service;
    private $mockRepo;

    protected function setUp(): void
    {
        // Cria o mock do repositório
        $this->mockRepo = $this->createMock(LivroRepository::class);

        // Injeta o mock no service
        $this->service = new LivroService($this->mockRepo);
    }

    public function testListarComMock()
    {
        $livrosMock = [
            ['id' => 1, 'titulo' => 'Livro Mockado', 'autor' => 'Autor Fake', 'descricao' => 'Desc fake']
        ];

        $this->mockRepo->expects($this->once())
                       ->method('findAll')
                       ->willReturn($livrosMock);

        $resultados = $this->service->listarLivros();

        $this->assertCount(1, $resultados);
        $this->assertEquals("Livro Mockado", $resultados[0]['titulo']);
    }

    public function testInserirComMock()
    {
        $dados = [
            'titulo' => 'PHP Unit',
            'autor' => 'Autor Teste',
            'descricao' => 'Descrição do livro teste'
        ];

        $this->mockRepo->expects($this->once())
                       ->method('save')
                       ->with($this->callback(function ($livro) use ($dados) {
                           return $livro instanceof Livro &&
                                  $livro->titulo === $dados['titulo'] &&
                                  $livro->autor === $dados['autor'] &&
                                  $livro->descricao === $dados['descricao'];
                       }))
                       ->willReturn(true);

        $resultado = $this->service->salvarLivro($dados);
        $this->assertTrue($resultado);
    }

    public function testBuscarPorIdComMock()
    {
        $livroMock = ['id' => 1, 'titulo' => 'Livro Mockado', 'autor' => 'Autor Fake', 'descricao' => 'Fake desc'];

        $this->mockRepo->expects($this->once())
                       ->method('find')
                       ->with(1)
                       ->willReturn($livroMock);

        $resultado = $this->service->obterLivro(1);
        $this->assertEquals($livroMock, $resultado);
    }

    public function testEditarComMock()
    {
        $dados = [
            'id' => 1,
            'titulo' => 'Novo Título',
            'autor' => 'Novo Autor',
            'descricao' => 'Nova descrição'
        ];

        $this->mockRepo->expects($this->once())
                       ->method('update')
                       ->with($this->callback(function ($livro) use ($dados) {
                           return $livro instanceof Livro &&
                                  $livro->id === $dados['id'] &&
                                  $livro->titulo === $dados['titulo'] &&
                                  $livro->autor === $dados['autor'] &&
                                  $livro->descricao === $dados['descricao'];
                       }))
                       ->willReturn(true);

        $resultado = $this->service->atualizarLivro($dados);
        $this->assertTrue($resultado);
    }

    public function testDeletarComMock()
    {
        $this->mockRepo->expects($this->once())
                       ->method('delete')
                       ->with(1)
                       ->willReturn(true);

        $resultado = $this->service->excluirLivro(1);
        $this->assertTrue($resultado);
    }
}
