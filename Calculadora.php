<?php

// Classe final para evitar herança — representa a lógica da calculadora
final class Calculadora {

    // Soma dois números
    public function somar(float $a, float $b): float {
        return $a + $b;
    }

    // Subtrai dois números
    public function subtrair(float $a, float $b): float {
        return $a - $b;
    }

    // Multiplica dois números
    public function multiplicar(float $a, float $b): float {
        return $a * $b;
    }

    // Divide dois números com verificação de divisão por zero
    public function dividir(float $a, float $b): float|string {
        if ($b == 0.0) {
            return "Erro: divisão por zero não permitida.";
        }
        return $a / $b;
    }
}
?>
