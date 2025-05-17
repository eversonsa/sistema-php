# Sistema PHP - Bookwise

[![PHP Unit Tests](https://github.com/eversonsa/sistema-php/actions/workflows/phpunit.yml/badge.svg)](https://github.com/eversonsa/sistema-php/actions/workflows/phpunit.yml)

---

## Descrição

Projeto simples em PHP para gerenciar livros com um CRUD básico utilizando arquitetura MVC dividida em camadas (model, view, controller, service, repository, infra).  

O objetivo é treinar PHP moderno na versao 8.4, organização de código, testes unitários com PHPUnit e integração contínua com GitHub Actions.

---

## Estrutura de Pastas

- **infra/** - Configurações de banco de dados e conexão.
- **model/** - Classes que representam as entidades do sistema (ex: Livro).
- **repository/** - Acesso ao banco de dados (querys SQL, CRUD).
- **service/** - Regras de negócio e lógica de aplicação.
- **controller/** - Recebe as requisições, chama os serviços e retorna as views.
- **view/** - Templates e arquivos HTML/PHP que exibem as páginas para o usuário.
- **tests/** - Testes unitários usando PHPUnit para validar os métodos da aplicação.

---

## Testes Unitários

Os testes estão localizados na pasta `tests/` e cobrem as principais funcionalidades do serviço de livros (`LivroService`).  

Os testes são executados usando o PHPUnit e garantem o funcionamento correto das operações CRUD através de mocks do banco de dados.

Para rodar os testes localmente, execute:

```bash
vendor/bin/phpunit --configuration phpunit.xml