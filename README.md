Ler este texto por favor.
===================


Este projeto é realizado no âmbito da cadeira de Desenvolvimento para a Web.
Desenvolvido de acordo com o padrão de arquitectura [HMVC](https://www.wikiwand.com/en/Hierarchical_model%E2%80%93view%E2%80%93controller) (Hierarchical model–view–controller) e também com [REST](https://www.wikiwand.com/pt/REST) (Representational State Transfer).

Guias Seguidos
==============

[Working with RESTful Services in CodeIgniter](http://code.tutsplus.com/tutorials/working-with-restful-services-in-codeigniter-2--net-8814) - Philip Sturgeon

[HMVC: an Introduction and Application](http://code.tutsplus.com/tutorials/hmvc-an-introduction-and-application--net-11850)  - Barry Cogan

[Codeigniter with HMVC](https://www.youtube.com/playlist?list=PLdDElSubBuxrBcOBa1AYVfVy3ecLpb-_4) - John Otaalu

Como está estruturado o projeto
-------------
Este projeto é modular, ou seja, são criados módulos com blocos de código que podem ser reutilizados em futuros projetos. Isto é feito criando a pasta modules dentro da pasta application do codeigniter, depois basta criar a pasta com o nome do módulo (neste exemplo temos as pastas "common" e "login") e criar três directorias para cada uma.
nome_do_modulo/models
nome_do_modulo/views
nome_do_modulo/controllers



![Estrutura do Projeto](http://i.imgur.com/1CzpwrB.png)

Depois basta criar os ficheiros para começar a utilizar dentro das respectivas pastas.

Classes
==============

Exemplo de criação da classe Navbar

```php
<?php
class Navbar extends MY_Controller{

  function __construct() {
      parent::__construct();
  }

  function sample_navbar_get($data = NULL){
    $this->load->view('sample_navbar_view');

  }
}

```
Nesta classe simples é criado o construtor, e depois é carregada uma view.
Para chamar o método sample_navbar_get no browser é usado http://localhost/dw/index.php/Common/Navbar/sample_navbar
Note-se que não se usa o _get (Isto é devido á REST API) e é dito o nome da pasta Common !

REST API
--------

Em construção
