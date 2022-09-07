<!DOCTYPE HTML>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, viewport-fit=cover">
  <meta http-equiv="Content-Security-Policy" content="default-src * data: gap: https://ssl.gstatic.com; style-src * 'unsafe-inline'; script-src * 'unsafe-inline' 'unsafe-eval'">
  <link rel="stylesheet" href="arrumando.css">

</head>
<body>

<img src="Hakin.png" height="100px">
    <div class="vermelho">
        <p> </p>
    </div>
     <div class="preto">
        <p> </p>
    </div>
    <h2> LOGIN </h2>
    <div id="divLoagin">
        <form id="entrar" method="post">
            <input type="email" id="email" name="email" placeholder="Email..."/> <br> <br>
            <input type="password" id="senha" name="senha" placeholder="Senha..."/> <br>
            <br> <button class="bn632-hover bn22" id="btn"> Entrar </button>
        </form>
        <div class="link">
             <div class="link1"> <br>
                Esqueceu sua senha?
                <a href="#paralogin"> Aperte aqui </a>
        </div>
    </div>
    <?php
            header("Acess-Control-Allow-Origin: *");
            session_start();
            include('biblioteca.php');
            if($_POST) {
            	$resultado = Login($_POST['email'], $_POST['senha']);
            	if($resultado['erro']){
            		echo "Usuário e/ou senha inválido";
            	}else{
            		$user = $resultado['dados'];
            		if($user->status == 'bloqueado'){
            			echo "Usuário bloqueado";
            		}else{
            		echo "Usuário existe";
            		$user = $resultado['dados'];
            		$_SESSION['rm'] = $user->rm;
            		$_SESSION['nome'] = $user->nome;
            		$_SESSION['email'] = $user->email;
            		$_SESSION['senha'] = $user->senha;
            		$_SESSION['perfil'] = $user->perfil;
            		$_SESSION['status'] = $user->status;
            		$_SESSION['adm'] = $user->adm;
            		//redireciona o usuário para a pag adm
            		header('location: home.php');
            		}
            	}
            
            }
        ?>
</body>
</html>