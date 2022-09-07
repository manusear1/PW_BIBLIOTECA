<?php
header ("Access-Control-Allow-Origin:*");
include('biblioteca.php');
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no">
    <meta http-equiv="Content-Security-Policy" content="default-src * data: gap: https://ssl.gstatic.com; style-src * 'unsafe-inline'; script-src * 'unsafe-inline' 'unsafe-eval'">
    <link rel="stylesheet" href="style2.css">
</head>
<body>
           <div class="row">
          <div class="col mt-3">
              <h1 id="texto2"> Cadastros <h1>
                    <div class="vermelho">
                        <p> </p>
                    </div>
                    <div class="preto">
                        <p> </p>
                    </div>
                     <h2>Bem Vindo! <?php echo $_SESSION['nome']; ?> </h2>
                    </div>
              </div>
         </div>
      </div>
    </div>

<form id="novoGenero" method="post">
    <fieldset>
        <legend>Novo Gênero</legend>
        Nome: <input type="text" name="genero"> <br>
        <br> <button class="btn btn-primary mt-3" id="buscar"> Cadastrar </button>
    </fieldset>
</form>

<div>
<h3>Gêneros Cadastrados</h3>
<table>
    <tr>
        <td>Nome</td>
        <td>#</td>
    </tr>
    <?php
        if(isset($_GET['excluir_gen'])){
            ExcluirGenero($_GET['excluir_gen']);
        }
        $todos = ListarGenero("");
        while($gen = $todos->fetch_object()){
            echo '<tr>
                    <td>'.$gen->genero.'</td>
                    <td>
                        <a href="?excluir_gen='.$gen->cd.'">Excluir</a>
                    </td>
                </tr>';        }
    ?>
    </table>
    </div>


<hr>
<br><br>
<form id="novoAutor" method="post">
    <fieldset>
        <legend>Novo Autor</legend>
        Nome: <input type="text" name="autor"><br>
        <br><button class="btn btn-primary mt-3" id="buscar"> Cadastrar </button>
    </fieldset>
</form>

<div>
    <h31>Autores Cadastrados</h3>
<table>
    <tr>
        <td>Nome</td>
        <td>#</td>
    </tr>
    <?php
        if(isset($_GET['excluir_aut'])){
            ExcluirAutor($_GET['excluir_aut']);
        }
        $todos = ListarAutor("");
        while($aut = $todos->fetch_object()){
            echo '<tr>
                    <td>'.$aut->nome.'</td>
                    <td>
                        <a href="?excluir_aut='.$aut->cd.'">Excluir</a>
                    </td>
                </tr>';        }
    ?>
    </table>
    </div>


<hr>
<br><br>
<form id="novaEditora" method="post">
    <fieldset>
        <legend>Nova Editora</legend>
        Nome: <input type="text" name="editora"><br>
        <br><button class="btn btn-primary mt-3" id="buscar"> Cadastrar </button>
    </fieldset>
</form>

<div>
    <h3>Editoras Cadastradas</h3>
<table>
    <tr>
        <td>Nome</td>
        <td>#</td>
    </tr>
    <?php
        if(isset($_GET['excluir_edi'])){
            ExcluirEditora($_GET['excluir_edi']);
        }
        $todos = ListarEditora("");
        while($edi = $todos->fetch_object()){
            echo '<tr>
                    <td>'.$edi->nome.'</td>
                    <td>
                        <a href="?excluir_edi='.$edi->cd.'">Excluir</a>
                    </td>
                </tr>';        }
    ?>
    </table>
    </div>
<hr>



<?php
    if(isset($_POST['genero'])){
        CadastrarGenero($_POST['genero']);
    }
    if(isset($_POST['autor'])){
        CadastrarAutor($_POST['autor']);
    }
    if(isset($_POST['editora'])){
        CadastrarEditora($_POST['editora']);
    }
?>


    
    <h3>Cadastrar Livro</h3>
    <form id="novoLivro" method="post">
    <fieldset>
        <legend>Novo Livro</legend>
        Titulo do livro: <input type="text" name="titulo">
        <br> Ano do livro: <input type="date" name="ano">
        <br> Quantidades de livros: <input type="number" name="qtd">
        <br> Sinopse do livro: <input type="text" name="sinopse">
        <br> Capa do livro: <input type="file" name="capa">
        <br> Classificação Indicativa do livro: <input type="number" name="classificação">
        <br> Estado: <input type="text" name="estado">
        <br> Editora <select name="editora">
            <?php
                $todos = ListarEditora(0);
                    while($e = $todas->fetch_object()){
                        echo '<option value="'.$e->cd.'">'.$e->nome.'</option>';
                    }
            ?>
        </select><br>
        Gênero <select name="genero">
            <?php
                $todos = ListarGenero(0);
                    while($e = $todas->fetch_object()){
                        echo '<option value="'.$e->cd.'">'.$e->nome.'</option>';
                    }
            ?>
        </select><br>
        <button class="btn btn-primary mt-3" id="buscar"> Cadastrar </button>
    </fieldset>
    <table>
        <tr>
            <td>cód<</td>
            <td>capa</td>
            <td>título</td>
            <td>#</td>
        </tr>
    <?php
        $acervo = ListarLivro(0);
        while($livro = $acervo->fetch_object()){
            $capa = ($livro->capa != "") ? $livro->capa : 'imgs/sem_capa.png';
            echo '<tr>
                <td>'.$livro->cd.'</td>
                <td><img src="'.$livro->capa.'" height="80px"></td>
                <td>'.$livro->titulo.'</td>
                <td>Ver | Editar | Excluir | Emprestar</td>
            </tr>';
        }
    ?>
    
    </table>
</form>
</body>
</html>