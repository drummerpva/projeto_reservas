<?php
require './config.php';
require './classes/carros.class.php';
require './classes/reservas.class.php';

$reservas = new Reservas($pdo);
$carros = new Carros($pdo);
?>
<h1>Reservas</h1>
<a href="reservar.php">Adicionar Reserva</a><br><br/>
<form method="POST">
    <select name="ano">

        <?php for ($q = date("Y"); $q >= 2000; $q--) { ?>
            <option value="<?php echo $q; ?>"><?php echo $q; ?></option>
        <?php } ?>
    </select>
    <select name="mes">
        <option value="1">01</option>
        <option value="2">02</option>
        <option value="3">03</option>
        <option value="4">04</option>
        <option value="5">05</option>
        <option value="6">06</option>
        <option value="7">07</option>
        <option value="8">08</option>
        <option value="9">09</option>
        <option value="10">10</option>
        <option value="11">11</option>
        <option value="12">12</option>
    </select>
    <input type="submit" value="Mostrar"/></br>
</form>
<?php
if (empty($_POST['ano'])) {

    exit();
}
$data = $_POST['ano'] . "-" . $_POST['mes'] . "-01";
$dia1 = date('w', strtotime($data));
$dias = date('t', strtotime($data));
$linhas = ceil(($dia1 + $dias) / 7);
$dia1 = -$dia1;
$dataInicio = date("Y-m-d", strtotime("$dia1 days", strtotime($data)));
$dataFim = date("Y-m-d", strtotime(($dia1 + ($linhas * 7) - 1) . " days", strtotime($data)));
$lista = $reservas->getReservas($dataInicio,$dataFim);
/*
foreach ($lista as $item) {
    $data1 = date("d/m/Y", strtotime($item['data_inicio']));
    $data2 = date("d/m/Y", strtotime($item['data_fim']));
    echo $item['pessoa'] . " reservou o/a " . $carros->getCarro($item['id_carro']) . " Entre " . $data1 . " e " . $data2 . "<br/>";
}
*/
?>
<hr/>
<?php
require 'calendario.php';
?>