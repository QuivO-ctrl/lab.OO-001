<?php
// Descarrega o arquivo Calculadora.php e TrataeMostra.php,
// que contêm as classes Calculadora e TrataeMostra.
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

    // Verifica se há erro de entrada
    if ($val1 === null || $val2 === null) {
        $erro = 'Entrada inválida. Certifique-se de informar números válidos.';
    } else {
        // 2. Executa a operação com base na classe Calculadora
        switch ($operacao) {
            case 'somar':
                $soma = new Soma();
                $soma->setNum1($val1);
                $soma->setNum2($valor2);
                $result = $soma->calculaSoma();
                break;

            case 'subtrair':
                $subtracao = new Subtracao();
                $subtracao->setNum1($val1);
                $subtracao->setNum2($valor2);
                $result = $subtracao->calculaSubtracao();
                break;

            case 'multiplicar':
                $multiplicacao = new Multiplicacao();
                $multiplicacao->setNum1($val1);
                $multiplicacao->setNum2($valor2);
                $result = $multiplicacao->calculaMultiplicacao();
                break;

            case 'dividir':
                $divisao = new Divisao();
                $divisao->setNum1($val1);
                $divisao->setNum2($valor2);
                
                if ($valor2 == 0) {
                    $erro = 'Divisão por zero não permitida.';
                } else {
                    $result = $divisao->calculaDivisao();
                }
                break;

            default:
                $erro = 'Operação desconhecida.';
        }
    }

    // 3. Exibe o resultado chamando método da classe estática
    TrataeMostra::exibirResultado($erro, $operacao, $val1, $val2, $result);
}
?>
