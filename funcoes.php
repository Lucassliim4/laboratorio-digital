<?php

// Validação e Classificação do pH (6.0 a 9.5)
function classificarPh(?float $ph): string {
    if ($ph === null) {
        throw new InvalidArgumentException("O campo pH é de preenchimento obrigatório.");
    }
    if ($ph < 0.0 || $ph > 14.0) {
        throw new InvalidArgumentException("Valor de pH fora da escala física (0 a 14).");
    }
    return ($ph >= 6.0 && $ph <= 9.5) ? "Adequado" : "Fora do Padrão";
}

// Validação e Classificação da Turbidez (<= 5.0 uT)
function classificarTurbidez(?float $turbidez): string {
    if ($turbidez === null) {
        throw new InvalidArgumentException("O campo turbidez é de preenchimento obrigatório.");
    }
    if ($turbidez < 0.0) {
        throw new InvalidArgumentException("A turbidez não pode ser negativa.");
    }
    return ($turbidez <= 5.0) ? "Conforme" : "Inconforme/Fora do Padrão";
}

// Validação e Classificação do Cloro Residual (0.2 a 5.0 mg/L)
function classificarCloro(?float $cloro): string {
    if ($cloro === null) {
        throw new InvalidArgumentException("O campo cloro residual é de preenchimento obrigatório.");
    }
    if ($cloro < 0.0) {
        throw new InvalidArgumentException("O teor de cloro não pode ser negativo.");
    }
    return ($cloro >= 0.2 && $cloro <= 5.0) ? "Adequado" : "Fora do Padrão";
}

// Validação e Classificação da Dureza (<= 500 mg/L)
function classificarDureza(?float $dureza): string {
    if ($dureza === null) {
        throw new InvalidArgumentException("O campo dureza é de preenchimento obrigatório.");
    }
    if ($dureza < 0.0) {
        throw new InvalidArgumentException("A dureza não pode ser negativa.");
    }
    return ($dureza <= 500.0) ? "Adequada" : "Fora do Padrão";
}

// Cálculo da Eficiência do Biofiltro (%)
function calcularEficienciaBiofiltro(float $valorInicial, float $valorFinal): float {
    if ($valorInicial == 0.0) {
        throw new InvalidArgumentException("O valor inicial não pode ser zero.");
    }
    if ($valorInicial < 0.0 || $valorFinal < 0.0) {
        throw new InvalidArgumentException("Os valores medidos não podem ser negativos.");
    }
    
    $eficiencia = (($valorInicial - $valorFinal) / $valorInicial) * 100;
    return round($eficiencia, 2);
}

// Diagnóstico Global
function gerarDiagnosticoGlobal(?float $ph, ?float $turbidez, ?float $cloro, ?float $dureza): string {
    if (
        classificarPh($ph) === "Adequado" &&
        classificarTurbidez($turbidez) === "Conforme" &&
        classificarCloro($cloro) === "Adequado" &&
        classificarDureza($dureza) === "Adequada"
    ) {
        return "Aprovado/Adequado";
    }

    return "Reprovado/Inadequado";
}