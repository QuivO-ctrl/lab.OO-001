<?php
require_once 'Operacoes.php';
require_once 'Soma.php';
require_once 'Subtracao.php';
require_once 'Multiplicacao.php';
require_once 'Divisao.php';
require_once 'TrataeMostra.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Recebendo os valores e a operação
    $valor1 = $_POST["valor1"] ?? "";
    $valor2 = $_POST["valor2"] ?? "";
    $operacao = $_POST["operacao"] ?? "";

    // 1. Converte os valores para número usando a classe TrataeMostra
    $val1 = TrataeMostra::parse_num($valor1);
    $val2 = TrataeMostra::parse_num($valor2);

    $resultado = null;
    $erro = null;
    $oper = null;

    // Verifica se há erro de entrada
    if ($val1 === null || $val2 === null) {
        $erro = 'Entrada inválida. Certifique-se de informar números válidos.';
    } else {
        
        switch ($operacao) {
            case 'somar':
                $oper = new Soma();
                break;

            case 'subtrair':
                $oper = new Subtracao();
                break;

            case 'multiplicar':
                $oper = new Multiplicacao();
                break;

            case 'dividir':
                $oper = new Divisao();
                break;
                  
            default:
            $erro = 'Operação desconhecida.';
        }
        $oper->setNum1($val1);
        $oper->setNum2($val2);
        $result = $oper->calcula();
    }

    // 3. Exibe o resultado chamando método da classe estática
    TrataeMostra::exibirResultado($erro, $operacao, $val1, $val2, $result);
}
?>
