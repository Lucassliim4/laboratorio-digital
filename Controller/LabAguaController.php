<?php

require_once __DIR__ . '/../funcoes.php';

class LabAguaController
{
    public function processarFormulario()
    {
        $resultado = null;
        $erro = null;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $ph = isset($_POST['ph']) && $_POST['ph'] !== '' ? (float)$_POST['ph'] : null;
                $turbidez = isset($_POST['turbidez']) && $_POST['turbidez'] !== '' ? (float)$_POST['turbidez'] : null;
                $cloro = isset($_POST['cloro']) && $_POST['cloro'] !== '' ? (float)$_POST['cloro'] : null;
                $dureza = isset($_POST['dureza']) && $_POST['dureza'] !== '' ? (float)$_POST['dureza'] : null;

                $turbidezPos = isset($_POST['turbidez_pos']) && $_POST['turbidez_pos'] !== '' ? (float)$_POST['turbidez_pos'] : null;

                $resultado = [
                    'ph' => ['valor' => $ph, 'status' => classificarPh($ph)],
                    'turbidez' => ['valor' => $turbidez, 'status' => classificarTurbidez($turbidez)],
                    'cloro' => ['valor' => $cloro, 'status' => classificarCloro($cloro)],
                    'dureza' => ['valor' => $dureza, 'status' => classificarDureza($dureza)],
                    'diagnostico' => gerarDiagnosticoGlobal($ph, $turbidez, $cloro, $dureza)
                ];

                if ($turbidez !== null && $turbidezPos !== null) {
                    $resultado['eficiencia_turbidez'] = calcularEficienciaBiofiltro($turbidez, $turbidezPos);
                }

            } catch (Exception $e) {
                $erro = $e->getMessage();
            }
        }

        return ['resultado' => $resultado, 'erro' => $erro];
    }
}