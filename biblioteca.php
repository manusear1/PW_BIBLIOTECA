<?php
header("Acess-Control-Allow-Origin: *");
session_start();

//conexão
$user = 'igndibau_nunu';
$pass = 'NauIva17';
$banco = 'igndibau_biblioteca';
$server = 'localhost';
$conn = new mysqli($server,$user,$pass,$banco);
if(!$conn){
	echo 'Erro de conexão: '.$conn->error;
}
/*Métodos do CRUD do Administrador */
  function Login($email, $senha){
      echo $email;
      echo $senha;
      $sql = 'SELECT * FROM usuario WHERE email = "'.$email.'" AND senha = "'.$senha.'"';
      $res  = $GLOBALS['conn']->query($sql);
      if($res->num_rows > 0){
          $retorno['erro'] = false;
          $user = $res->fetch_object();
          $retorno['dados'] = $user;
      } else{
          $retorno ['erro'] = true;
      }
      if($tipo == 'json'){
        return json_encode($retorno);
      }else {
        return $retorno;
      }
      }
function CadastrarUsuario($rm,$nome,$email,$senha,$userstatus,$adm){
        $sql = 'INSERT INTO usuario(rm, nome, email, senha, user_status, adm) VALUES ('.$rm.',"'.$nome.'","'.$email.'","'.$senha.'","'.$userstatus.'","'.$adm.'")';
        $destino = 'usuario/fotos/'.$rm;
        if (is_dir($destino)){
            mkdir($destino, 0777);
        }
        $res = $GLOBALS['conn']->query($sql);
        if($res){
          echo "Usuário cadastrado com sucesso!";
        }else{
          echo "Erro ao cadastrar ADM";
        }
        }
function ExcluirUsuario($rm){
$sql = 'DELETE FROM usuario WHERE rm = '.$rm;
    $res = $GLOBALS['conn']->query($sql);

    if($res)
      echo "Excluído com sucesso!";
    else 
      echo "Erro ao excluir";
  }
function AtualizarUsuario($rm,$nome,$nasc,$gen,$tel){
$sql = 'UPDATE usuario SET nome = "'.$nome.'",dt_nascimento = "'.$nasc.'", genero = "'.$gen.'", telefone = "'.tel.'" WHERE rm ='.$rm;
    $res = GLOBALS ['conn']-> query($sql);
    if($res)
      echo "Atualizado com sucesso!";
    else
      echo "Erro ao atualizar";
  }
function TrocarFoto($rm,$foto){
	$destino = 'usuario/fotos/'.$rm.'/'.$foto['name'];
    if(move_uploaded_file($foto['tmp_name'], $destino)){
      $sql = 'SELECT * FROM usuario WHERE rm = '.$rm;
      $res = $GLOBALS['conn']->query($sql);
      $user = $res->fetch_array();
      unlink($user['perfil']);
      $sql = 'UPDATE usuario SET perfil "'.$destino.'" WHERE rm = '.$rm;
      $res = $GLOBALS['conn']->query($sql);
      if($res){
        echo "Atualizado com sucesso";
      }
      else{
        echo "Erro ao atualizar foto";
      }
    }
  }
function TrocarSenha($rm){
	$nova_senha = ""; //fazer método
    $sql = 'UPDATE usuario SET senha ="'.$nova_senha.'" WHERE rm = '.$rm;
    $res = GLOBALS['conn']->query($sql);
    $user = $res->fetch_array();
    if(mail($user['email'], "Biblioteca [nova senha]",$msg)){
      $sql = 'UPDATE usuario SET senha = "'.$nova_senha.'" WHERE rm = '.$rm;
      $res = $GLOBALS['conn']->query($sql);
      if($res){
        echo "Nova senha encaminhada para seu email!";
      } else{
        echo "Erro ao trocar a senha. Tente novamente";
      }
    }
  }
function CadastrarGenero($nome){
	 $sql = 'INSERT INTO genero VALUES (null, "'.$nome.'")';
    $res  = $GLOBALS['conn']->query($sql);
    if($res){
      echo "Gênero cadastrado :p";
    } else {
      echo "Erro ao cadastrar gênero ;-;"; 
    }
  }
function ExcluirGenero($cd){
	 $sql = 'DELETE FROM genero WHERE cd ='.$cd;
    $res = $GLOBALS['conn']->query($sql);
    if($res){
      echo "Gênero excluído";
    } else {
      echo "Erro ao excluir, verifique se há livros utilizando.";
    }
  }
function ListarGenero($cd){
	$sql = 'SELECT * FROM genero';
	$result = $GLOBALS['conn']->query($query);
	if($gen !=""){
		$sql.='WHERE cd = '.$cd;
	}
	$res = $GLOBALS['conn']->query($sql);
	return $res;
}
function CadastrarEditora($nome){
	$sql = 'INSERT INTO editora VALUES (null, "'.$nome.'")';
    $res  = $GLOBALS['conn']->query($sql);
    if($res){
      echo "Editora cadastrada";
    } else {
      echo "Erro ao cadastrar"; 
    }
  }
function ExcluirEditora($cd){
	$sql = 'DELETE FROM editora WHERE cd= '.$cd;
    $res  = $GLOBALS['conn']->query($sql);
    if($res){
      echo "Editora excluída";
    } else {
      echo "Erro ao excluir, verifique se há livros usando"; 
    }
  }
function ListarEditora($cd){
	$sql = 'SELECT * FROM editora';
	$result = $GLOBALS['conn']->query($query);
	if($edit !=""){
		$sql.='WHERE cd = '.$cd;
	}
	$res = $GLOBALS['conn']->query($sql);
	return $res;
}
function CadastrarAutor($nome){
	  $sql = 'INSERT INTO autor VALUES (null, "'.$nome.'")';
    $res  = $GLOBALS['conn']->query($sql);
    if($res){
      echo "Autor cadastrado";
    } else {
      echo "Erro ao cadastrar"; 
    }
  }
function ExcluirAutor($cd){
	$sql = 'DELETE FROM autor WHERE cd= '.$cd;
    $res  = $GLOBALS['conn']->query($sql);
    if($res){
      echo "Autor excluído";
    } else {
      echo "Erro ao excluir, verifique se há livros usando"; 
    }
  }
function ListarAutor($cd){
	$sql = 'SELECT * FROM autor';
	$result = $GLOBALS['conn']->query($query);
	if($aut !=""){
		$sql.='WHERE cd = '.$cd;
	}
	$res = $GLOBALS['conn']->query($sql);
	return $res;
}
function ListarLivro($cd){
    $sql = 'SELECT * FROM livro';
    if($cd>0){
        $sql.='WHERE cd='.$id;
    }
    $res = $GLOBALS['conn']->query($sql);
    return $res;
}
function CadastrarLivro($isbn,$titulo,$ano,$qtd,$sinopse,$capa,$classificacao,$editora,$genero,$estado){
    
    $sql = 'INSERT INTO livro VALUES (null,
    "'.$isbn.'",
    "'.$titulo.'",
    '.$ano.',
    '.$qtd.',
    "'.$sinopse.'",
    "'.$capa.'",
    "'.$classificacao.'",
    '.$editora.',
    '.$genero.',
    "'.$estado.'")';
  $res = $GLOBALS['conn']->query($sql);
  
  if($res){
      echo $res->insert_id;
      $destino = 'imgs/'.$res->insert_id.'/'.$capa['name'];
      if(move_uploaded_file($capa['tmp_name'],$destino)){
          echo "Livro Cadastro com sucesso!";
      }else{
          echo "Erro ao salvar foto do livro";
      }
      }else
      {
          echo "Erro ao cadastrar";
  }
}

