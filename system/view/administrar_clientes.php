<?php 
    include_once('../control/ClienteControl.php');
    $reloadPageScript = '<script type="text/javascript">reloadPage();</script>'
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administrar Contatos</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/administrar_clientes.css">
</head>
<body>
    <table id="table-principal">
        <thead>
            <tr>
                <th>Nome</th>
                <th>E-mail</th>
                <th>Endereço</th>
                <th>Data de Nascimento</th>
                <th>Deletar</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $pencilIcon = '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
              </svg>';
                $trashIcon = '<svg xmlns="http://www.w3.org/2000/svg" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
              </svg>';

                $clientes = ClienteControl::select();

                foreach ($clientes as $cliente) {
                    echo "<tr>";

                    echo "<td>{$cliente['nome']} <a href='?acao=update&campo=nome&id={$cliente['id']}'>$pencilIcon</a> </td>";
                    echo "<td>{$cliente['email']} <a href='?acao=update&campo=email&id={$cliente['id']}'>$pencilIcon</a> </td>";
                    echo "<td>{$cliente['endereco']} <a href='?acao=update&campo=endereco&id={$cliente['id']}'>$pencilIcon</a> </td>";
                    echo "<td>{$cliente['dataNascimento']} <a href='?acao=update&campo=dataNascimento&id={$cliente['id']}'>$pencilIcon</a> </td>";
                    echo "<td><a href='?acao=deletar&id={$cliente['id']}'>$trashIcon</a></td>";

                    echo "</tr>";
                }
            ?>
        </tbody>
    </table>
    
    <script src="../assets/script/administrar_clientes.js"></script>
</body>
</html>

    
<?php 
    if (isset($_GET['acao']) && $_GET['acao'] === 'update') {
        if (isset($_GET['campo']) && isset($_GET['id'])) {
            $campo = $_GET['campo'];
            $id = $_GET['id'];

            if (isset($_GET['novoValor']) && !empty($_GET['novoValor'])) {
                $novoValor = $_GET['novoValor'];
                
                ClienteControl::update($campo, $novoValor, $id);
    
                // header("Location: {$_SERVER['PHP_SELF']}");
                echo $reloadPageScript;
            } else {
                $campos = array(
                    'nome' => 'nome',
                    'email' => 'e-mail',
                    'dataNascimento' => 'data de nascimento',
                    'endereco' => 'endereço'
                );

                $type = '';
    
                if ($campo === 'email') {
                    $type = 'email';
                } else if ($campo === 'dataNascimento') {
                    $type = 'date';
                } else {
                    $type = 'text';
                }
    
                echo "
                    <div id='div-valor'>
                        <form method='get'>
                            <div id='div-form'>
                                <h1>Alterar {$campos[$campo]}</h1>
                                <input type='hidden' name='acao' value='update'>
                                <input type='hidden' name='campo' value='$campo'>
                                <input type='hidden' name='id' value='$id'>
                                <input type='$type' name='novoValor'>
                                <button type='submit'>Update</button>
                            </div>
                        </form>
                    </div>
                ";
    
            }
        }
    }

    if (isset($_GET['acao']) && $_GET['acao'] === 'deletar') {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];

            ClienteControl::delete($id);
            echo $reloadPageScript;
        }
    }
?>