<?php
    include_once("Contato.php");
    include_once("ContatoDao.php");
    include_once("PdoConexao.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <?php
    error_reporting(0);
        if(isset($_GET['id_up']) && isset($_POST['Atualizar']))
        {
            $persistenciaDadosPessoa = new ContatoDAO();
            $id_update = addslashes($_GET['id_up']);
            $res = $persistenciaDadosPessoa->read($id_update);
            $nome = $res->getNome();
            $email = $res->getEmail();
            $telefone = $res->getTelefone();
            $res->setNome($_POST['nome']);
            $res->setEmail($_POST['email']);
            $res->setTelefone($_POST['telefone']);
            //--------------UPDATE-------------------
            $persistenciaDadosPessoa->update($res);
            header("location: Teste.php");
        }
    ?>
    <div class="form">
            <form method="post">
                <h2>Atualizar</h2>
                <label for="nome">Nome:</label>
                <br>
                <input type="text" name="nome" id="nome" value="<?php echo isset($nome) ? $nome : ''; ?>">
                <br>
                <label for="email">Email:</label>
                <br>
                <input type="text" name="email" id="email" value="<?php echo isset($email) ? $email : ''; ?>">
                <br>
                <label for="telefone">Telefone:</label>
                <br>
                <input type="text" name="telefone" id="telefone" value="<?php echo isset($telefone) ? $telefone : ''; ?>">
                <br>
                <input type="submit" name="Atualizar" value="Atualizar">
            </form>
        </div>
</body>
</html>