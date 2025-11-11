<?php
// --- CLASS: Calculadora (métodos estáticos) ---
final class Calculadora {

    // Método estático: Soma
    public static function somar(float $a, float $b): float {
        return $a + $b;
    }

    // Método estático: Subtração
    public static function subtrair(float $a, float $b): float {
        return $a - $b;
    }

    // Método estático: Multiplicação
    public static function multiplicar(float $a, float $b): float {
        return $a * $b;
    }

    // Método estático: Divisão (com checagem de divisão por zero)
    public static function dividir(float $a, float $b): float|string {
        if ($b == 0.0) {
            return "Erro: divisão por zero";
        }
        return $a / $b;
    }

    // Método estático: validação e limpeza de número
    public static function parse_num($val): ?float {
        $s = trim($val);
        $s = str_replace(',', '.', $s); // troca vírgula por ponto

        // valida formato simples de número
        if (!preg_match('/^[+-]?\d+(\.\d+)?$/', $s)) {
            return null;
        }

        return floatval($s);
    }

    // Método estático: exibição do resultado
    public static function exibirResultado(string $oper, string $erro, ?float $val1, ?float $val2, float|string $resultado): void {
        echo "<h1>Resultado</h1>";

        if (!empty($erro)) {
            echo "<p class='erro'><strong>" . htmlspecialchars($erro, ENT_QUOTES, 'UTF-8') . "</strong></p>";
        } else {
            echo "<p><strong>Operação:</strong> " . htmlspecialchars($oper, ENT_QUOTES, 'UTF-8') . "</p>";
            echo "<p><strong>Expressão:</strong> " . htmlspecialchars($val1, ENT_QUOTES, 'UTF-8') . ' ';

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

            echo ' ' . htmlspecialchars($val2, ENT_QUOTES, 'UTF-8') . "</p>";
            echo "<p><strong>Resultado:</strong> " . htmlspecialchars($resultado, ENT_QUOTES, 'UTF-8') . "</p>";
        }

        echo "<p><a href='index.html'>Voltar</a></p>";
    }
}

// --- PROCESSAMENTO PRINCIPAL ---
$val1 = Calculadora::parse_num($_POST['valor1'] ?? '');
$val2 = Calculadora::parse_num($_POST['valor2'] ?? '');
$oper = $_POST['operacao'] ?? '';

$result = null;
$erro = null;

// Verifica se os valores são válidos
if ($val1 === null || $val2 === null) {
    $erro = 'Entrada inválida. Certifique-se de informar números válidos.';
} else {
    switch ($oper) {
        case 'somar':
            $result = Calculadora::somar($val1, $val2);
            break;

        case 'subtrair':
            $result = Calculadora::subtrair($val1, $val2);
            break;

        case 'multiplicar':
            $result = Calculadora::multiplicar($val1, $val2);
            break;

        case 'dividir':
            if ($val2 == 0) {
                $erro = 'Divisão por zero não permitida.';
            } else {
                $result = Calculadora::dividir($val1, $val2);
            }
            break;

        default:
            $erro = 'Operação desconhecida.';
    }
}

// Exibe resultado final
Calculadora::exibirResultado($oper, $erro ?? '', $val1, $val2, $result ?? 0);
?>
