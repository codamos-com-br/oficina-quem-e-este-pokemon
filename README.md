Quem é este Pokémon?
---

Este é o projeto base da oficina "Desenvolvimento guiado por testes",
elaborada por Níckolas Da Silva ([@nawarian](https://twitter.com/nawarian))
numa colaboração entre o site [Codamos](https://codamos.com.br) e o
[PHP Community Summit](https://php.locaweb.com.br/) da [Locaweb](https://www.locaweb.com.br/).

## Ambiente e requisitos

* `php >= 7.4` [Site oficial](http://php.net/)
* `composer` [Guia de instalação](https://getcomposer.org/download/)
* `symfony` [Guia de instalação](https://symfony.com/download)

As versões são importantes apenas por questão de compatibilidade.

## Instalação

### 1 – Clone o repositório

```
$ git clone git@github.com:codamos-com-br/quem-e-este-pokemon.git
$ cd quem-e-este-pokemon/
```

### 2 – Instale as dependências com Composer

```
$ composer install
```

### 3 – Inicialize o banco de dados

O projeto utiliza um banco de dados SQLite. Para inicializar o banco
rode o comando:

```
$ php bin/console doctrine:schema:update --force
```

### 4 – Sincronize com a PokéAPI

Nós dependemos da base de Pokémons que a [PokéAPI](https://github.com/PokeAPI/pokeapi) oferece.
Rode o seguinte comando:

```
$ php bin/console pokeapi:sync
```

### 5 – Rode os testes

```
$ php bin/phpunit
```

Se os testes estão verdes, você tem tudo o que precisa para
começar a desenvolver!

## Servidor

Vamos utilizar o servidor que a ferramenta `symfony` nos oferece.

Para iniciar o servidor, digite o seguinte comando:

```
$ symfony local:server:start -d
```

A partir daí você poderá acessar o projeto no link [https://localhost:8000](https://localhost:8000).

## Participação

O projeto possui uma build automatizada utilizando _Github Actions_.
Para manter a organização, crie um _branch_ seu e faça um _Pull Request_.

Cada `git push` deverá enviar código a este branch e rodar os testes
automatizados no _Github Actions_. Em caso de dúvidas ou problemas, faremos um
_code review_ ao vivo 😉.

## Código de conduta

Adotamos o mesmo código de conduta que a comunidade PHPSP.

Para saber mais, leia o [código de conduta na íntegra](https://phpsp.org.br/codigo-de-conduta/).

## Agradecimentos

Agradeço imensamente à [Locaweb](https://lcoaweb.com.br) por oferecer o
espaço e organização para o evento.

Agradeço também aà comunidade [PHPSP](https://phpsp.org.br/) pela
curadoria – menções honrosas ao [PokémãoBR](https://pokemaobr.dev/),
ao [Zé](https://twitter.com/jose_filho_dev) e [Marcel dos Santos](https://twitter.com/marcelgsantos) pelo trabalho
incrível que fazem desde sempre com a comunidade e este evento não
foi diferente.

## Contribuições

Este projeto não pretende receber contribuições que implementem as
funcionalidades propostas aqui. Caso encontre algum bug ou problema,
abra um _Pull Request_ como você normalmente faria.
