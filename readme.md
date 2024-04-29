<?php
include_once("Contato.php");
include_once("ContatoDAO.php");
include_once("PdoConexao.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="esquerda">
        <form method="post">
            <h2>Cadastrar</h2>
            <label for="nome">Nome:</label>
            <br>
            <input type="text" name="nome" id="nome">
            <br>
            <label for="email">Email:</label>
            <br>
            <input type="text" name="email" id="email">
            <br>
            <label for="telefone">Telefone:</label>
            <br>
            <input type="text" name="telefone" id="telefone">
            <br>
            <input type="submit" value="enviar" name="enviar">
        </form>
    </div>
    <div id="direita">



        <?php
        if (isset($_POST['enviar'])) {
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            // Nesta etapa criamos um objeto de contato e logo em seguida vamos fazer destes dados persistentes no banco de dados
            $contato1 = new Contato($nome, $email, $telefone);
            // Então primeiro criamos um novo objeto DAO
            $PersitenciaContato1 = new ContatoDAO();

            $PersitenciaContato1->create($contato1);

            $contatos = $PersitenciaContato1->readAll();
            echo '<table border="1">';
            echo '<tr><th>NOME</th><th>EMAIL</th><th colspan="3">TELEFONE</th></tr>';
            foreach ($contatos as $linha) {
                echo '<tr>';
                echo "<td>" . $linha['NOME'] . " </td>";
                echo "<td>" . $linha['EMAIL'] . " </td>";
                echo "<td>" . $linha['TELEFONE'] . " </td>";
        ?>
                <td><a href="">Editar</a></td>
                <td><a href="Teste.php?id=<?php echo $linha['ID']; ?>">Excluir</a></td>
        <?php
                echo '</tr>';
            }
            echo '</table>';

            if (isset($_GET['id'])) {
                $id_pessoa = addslashes($_GET['id']);
                $PersitenciaContato1->delete($id_pessoa);
                header("location: Teste.php");
            }
        }

        ?>
    </div>
</body>

if(isset($_POST['Atualizar']))
        {
            $res->setNome($_POST['nome']);
            $res->setEmail($_POST['email']);
            $res->setTelefone($_POST['telefone']);
            if($persistenciaDadosPessoa->update($dadosPessoa)){
                echo '<p>Contato atualizado com sucesso!</p>';
            }
            else{
                echo '<p>Falha ao atualizar contato!</p>';
            }
        }