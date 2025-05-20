<?php

namespace App\Model;

class Usuario
{
    public int $id;
    public string $nome;
    public string $email;
    public string $senha;
    public string $role;
    public string $criado_em; 
}