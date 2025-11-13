<?php

final class TrataeMostra {

    // Exibir resultado — método estático.
    // Recebe o resultado (float|string) e retorna um HTML seguro.
    public static function exibirResultado(?string $er, string $oper, ?float $v1, ?float $v2, float|string $resultado): void {

        echo "<h1>Resultado</h1>";

        if (!empty($er)) {
            echo "<p class='erro'><strong>" . htmlspecialchars($er, ENT_QUOTES, 'UTF-8') . "</strong></p>";
        } else {
            echo "<p><strong>Operação:</strong> " . htmlspecialchars($oper, ENT_QUOTES, 'UTF-8') . "</p>";
            echo "<p><strong>Expressão:</strong> " . htmlspecialchars($v1, ENT_QUOTES, 'UTF-8') . ' ';

            switch ($oper) {
                case 'somar':
                    echo '+';
                    break;
                case 'subtrair':
                    echo '-';
                    break;
                case 'multiplicar':
                    echo '×';
                    break;
                case 'dividir':
                    echo '÷';
                    break;
                default:
                    echo '?';
            }

            echo ' ' . htmlspecialchars($v2, ENT_QUOTES, 'UTF-8') . "</p>";
            echo "<p><strong>Resultado:</strong> " . htmlspecialchars($resultado, ENT_QUOTES, 'UTF-8') . "</p>";
        }

        echo "<p><a href='index.html'>Voltar</a></p>";
    }

    // Método estático que limpa/valida os dados de entrada
    public static function parse_num($val): ?float {
        // Remove espaços
        $s = trim($val);
        // Troca vírgula por ponto (aceitar 1,5)
        $s = str_replace(',', '.', $s);
        // Verifica se o valor é um número válido simples (positivo/negativo com decimal)
        if (!preg_match('/^[+-]?\d+(\.\d+)?$/', $s)) {
            return null;
        }
        return floatval($s);
    }
}
?>
