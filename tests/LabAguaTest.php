<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../funcoes.php';

class LabAguaTest extends TestCase
{
    // --- MÓDULO A: pH (CT-01 a CT-04) ---
    public function test_ct01_ph_em_faixa_normal() {
        $this->assertEquals("Adequado", classificarPh(7.0));
    }

    public function test_ct02_ph_no_limite_operacional() {
        $this->assertEquals("Adequado", classificarPh(6.0));
        $this->assertEquals("Adequado", classificarPh(9.5));
    }

    public function test_ct03_ph_fora_da_margem() {
        $this->assertEquals("Fora do Padrão", classificarPh(3.0));
        $this->assertEquals("Fora do Padrão", classificarPh(11.0));
    }

    public function test_ct04_ph_impossivel_dispara_excecao() {
        $this->expectException(InvalidArgumentException::class);
        classificarPh(-1.0);
    }

    // --- MÓDULO B: TURBIDEZ (CT-05 a CT-08) ---
    public function test_ct05_turbidez_em_nivel_tolerado() {
        $this->assertEquals("Conforme", classificarTurbidez(2.5));
    }

    public function test_ct06_turbidez_no_limite_maximo() {
        $this->assertEquals("Conforme", classificarTurbidez(5.0));
    }

    public function test_ct07_turbidez_elevada() {
        $this->assertEquals("Inconforme/Fora do Padrão", classificarTurbidez(8.0));
    }

    public function test_ct08_turbidez_negativa_rejeitada() {
        $this->expectException(InvalidArgumentException::class);
        classificarTurbidez(-2.0);
    }

    // --- MÓDULO C: CLORO RESIDUAL (CT-09 a CT-12) ---
    public function test_ct09_cloro_valido() {
        $this->assertEquals("Adequado", classificarCloro(2.0));
    }

    public function test_ct10_cloro_no_limite() {
        $this->assertEquals("Adequado", classificarCloro(0.2));
        $this->assertEquals("Adequado", classificarCloro(5.0));
    }

    public function test_ct11_cloro_inadequado() {
        $this->assertEquals("Fora do Padrão", classificarCloro(0.1));
    }

    public function test_ct12_cloro_negativo_dispara_excecao() {
        $this->expectException(InvalidArgumentException::class);
        classificarCloro(-0.5);
    }

    // --- MÓDULO D: DUREZA (CT-13 a CT-16) ---
    public function test_ct13_dureza_aceitavel() {
        $this->assertEquals("Adequada", classificarDureza(150.0));
    }

    public function test_ct14_dureza_limitrofe() {
        $this->assertEquals("Adequada", classificarDureza(500.0));
    }

    public function test_ct15_dureza_excessiva() {
        $this->assertEquals("Fora do Padrão", classificarDureza(600.0));
    }

    public function test_ct16_dureza_negativa_rejeitada() {
        $this->expectException(InvalidArgumentException::class);
        classificarDureza(-10.0);
    }

    // --- MÓDULO E: CAMPOS NULOS (CT-17 a CT-20) ---
    public function test_ct17_omissao_ph() {
        $this->expectException(InvalidArgumentException::class);
        classificarPh(null);
    }

    public function test_ct18_omissao_turbidez() {
        $this->expectException(InvalidArgumentException::class);
        classificarTurbidez(null);
    }

    public function test_ct19_omissao_cloro() {
        $this->expectException(InvalidArgumentException::class);
        classificarCloro(null);
    }

    public function test_ct20_omissao_dureza() {
        $this->expectException(InvalidArgumentException::class);
        classificarDureza(null);
    }

    // --- EFICIÊNCIA DO BIOFILTRO ---
    public function test_calculo_eficiencia_biofiltro_sucesso() {
        $this->assertEquals(80.0, calcularEficienciaBiofiltro(10.0, 2.0));
    }

    public function test_calculo_eficiencia_divisao_por_zero() {
        $this->expectException(InvalidArgumentException::class);
        calcularEficienciaBiofiltro(0.0, 2.0);
    }
}