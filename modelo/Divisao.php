<?php 
final class Divisao extends Operacoes {

    public function calcula(): float {
        if ($this->num2 == 0) {
            throw new Exception("Divisão por zero não é permitida.");
        }
        return $this->num1 / $this->num2;
    }
}
?>
