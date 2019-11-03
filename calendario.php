<?php
echo "<p>Primeiro dia: " . $dia1 . " tem $dias dias e $linhas semanas <br> data Inicio: "
 . "$dataInicio - Data Fim: $dataFim</p>";
?>
<table border="1" width="100%">
    <tr>
        <th>Dom</th>
        <th>Seg</th>
        <th>Ter</th>
        <th>Qua</th>
        <th>Qui</th>
        <th>Sex</th>
        <th>Sab</th>
    </tr>
    <?php
    for ($i = 0; $i < $linhas; $i++) {
        ?>
        <tr>
            <?php
            for ($q = 0; $q < 7; $q++) {
                $t = strtotime(($q + ($i * 7)) . " days", strtotime($dataInicio));
                $w = date("Y-m-d", $t);
                ?>
                <td>
                    <?php
                    echo date("d",$t) . "<br/>";
                    $w = strtotime($w);
                    foreach ($lista as $item) {
                        $drInicio = strtotime($item['data_inicio']);
                        $drFinal = strtotime($item['data_fim']);

                        if ($w >= $drInicio && $w <= $drFinal) {
                            echo $item['pessoa']."(".$carros->getCarro($item['id_carro']).")<br/>";
                        }
                    }
                    ?>
                </td>

                <?php
            }
            ?>
        </tr>
        <?php
    }
    ?>
</table>