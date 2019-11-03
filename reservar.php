<?php
require './config.php';
require './classes/carros.class.php';
require './classes/reservas.class.php';

$reservas = new Reservas($pdo);
$carros = new Carros($pdo);
if (!empty($_POST['carro'])) {
    $carro = $_POST['carro'];
    $dataInicio = $_POST['data_inicio'];
    $dataFim = $_POST['data_fim'];
    $pessoa = addslashes($_POST['pessoa']);
    if($reservas->verificarDisponibilidade($carro, $dataInicio, $dataFim)){
        if ($reservas->reservar($carro, $dataInicio, $dataFim, $pessoa)) {
            header("Location: ./");
        } else {
            echo "Não foi possivel reservar!";
        }
    }else{
        echo "<p>Este carro já está reservado nesse período!</p>";
    }
}
?>
<h2>Adicionar Reserva</h2>
<form method="POST">
    Carro:<br/>
    <select name="carro" required>
        <option></option>
        <?php
        $lista = $carros->listarCarros();
        foreach ($lista as $carro) {
        ?>
            <option value="<?php echo $carro['id']; ?>"><?php echo $carro['nome']; ?></option>    
        <?php
        }
        ?>
    </select><br/><br/>
    Data de início:<br/>
    <input type="date" name="data_inicio" required /><br/><br/>
    Data do Término:<br/>
    <input type="date" name="data_fim" required/><br/><br/>
    Solicitante:<br/>
    <input type="text" name="pessoa" required /><br/><br/>
    <input type="submit" value="Reservar"/>
</form>
