function validaFormulario(){

    const v1 = document.getElementById('valor1').value;
    const v2 = document.getElementById('valor2').value;

    // Regex para número (inteiro ou decimal, com sinal opcional)
    const numRegex = /^\s*[+-]?\d+(?:[.,]\d+)?\s*$/;

    if (!numRegex.test(v1) || !numRegex.test(v2)) {
        alert('Por favor, insira números válidos (ex: 12, -3.5).');
        return false;
    }

    return true;
}
