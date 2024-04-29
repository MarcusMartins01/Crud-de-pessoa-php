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
    <title>CRUD</title>
    <link rel="stylesheet" href="style.css">
</head>

<?php
    error_reporting(0);
    //Pegar dados da pessoa via url pelo método post
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];

    $dadosPessoa = new Contato($nome, $email, $telefone);//Objeto com os dados informados

    $persistenciaDadosPessoa = new ContatoDAO();//Objeto DAO

    //--------------------CREATE----------------------
    
    if(isset($_POST['nome']))
    {
        $persistenciaDadosPessoa->create($dadosPessoa);
    }

?>
<body>
    <div class="esquerda">
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
            <input type="submit" name="Cadastrar" value="Cadastrar">
        </form>
    </div>

    <div class="direita">
        <?php
            //-------------------READ--------------------
            $dados = $persistenciaDadosPessoa->readAll();//Objeto com os dados passados pelo metodo readAll()

            //Tabela com os dados inseridos
            echo '<table border="1">';
            echo '<tr><th>NOME</th><th>EMAIL</th><th colspan="3">TELEFONE</th></tr>';

            //Laço foreach para percorrer o objeto
            foreach ($dados as $linha) {
                echo '<tr>';
                echo "<td>" . $linha['NOME'] . " </td>";
                echo "<td>" . $linha['EMAIL'] . " </td>";
                echo "<td>" . $linha['TELEFONE'] . " </td>";
        ?>
                <td><a href="Editar.php?id_up=<?php echo $linha['ID']; ?>">Editar</a></td>
                <td><a href="Teste.php?id=<?php echo $linha['ID']; ?>">Excluir</a></td>
        <?php
                echo '</tr>';
            }
            echo '</table>';

            // Verificação para poder excluir cadastros
            if (isset($_GET['id'])) {
                $id_pessoa = addslashes($_GET['id']);
                //-----------------DELETE-------------------
                $persistenciaDadosPessoa->delete($id_pessoa);
                header("location: Teste.php");
            }
        ?>
    </div>
</body>
</html>