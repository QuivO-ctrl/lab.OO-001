<?php
// Descarrega o arquivo Calculadora.php e TrataeMostra.php,
// que contêm as classes Calculadora e TrataeMostra.
require_once 'Calculadora.php';
require_once 'TrataeMostra.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recebendo os valores e a operação
    $valor1 = $_POST["valor1"] ?? "";
    $valor2 = $_POST["valor2"] ?? "";
    $operacao = $_POST["operacao"] ?? "";

    // 1. Converte os valores para número usando a classe TrataeMostra
    $val1 = TrataeMostra::parse_num($valor1);
    $val2 = TrataeMostra::parse_num($valor2);

    $resultado = null;
    $erro = null;

    // Verifica se há erro de entrada
    if ($val1 === null || $val2 === null) {
        $erro = 'Entrada inválida. Certifique-se de informar números válidos.';
    } else {
        // 2. Executa a operação com base na classe Calculadora
        switch ($operacao) {
            case 'somar':
                $resultado = Calculadora::somar($val1, $val2);
                break;

            case 'subtrair':
                $resultado = Calculadora::subtrair($val1, $val2);
                break;

            case 'multiplicar':
                $resultado = Calculadora::multiplicar($val1, $val2);
                break;

            case 'dividir':
                if ($val2 == 0) {
                    $erro = 'Divisão por zero não permitida.';
                } else {
                    $resultado = Calculadora::dividir($val1, $val2);
                }
                break;

            default:
                $erro = 'Operação desconhecida.';
        }
    }

    // 3. Exibe o resultado chamando método da classe TrataeMostra
    TrataeMostra::exibirResultado($erro, $operacao, $val1, $val2, $resultado);
}
?>
