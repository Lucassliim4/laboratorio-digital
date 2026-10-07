<?php
require_once __DIR__ . '/Controller/LabAguaController.php';

$controller = new LabAguaController();
$dados = $controller->processarFormulario();

$resultado = $dados['resultado'];
$erro = $dados['erro'];
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laboratório Digital - Qualidade da Água</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold text-primary">Laboratório Digital de Qualidade da Água</h1>
            <p class="text-muted">Simulador de Análise Físico-Química e Eficiência de Biofiltro</p>
        </div>

        <?php if ($erro): ?>
            <div class="alert alert-danger shadow-sm mb-4" role="alert">
                <strong>Erro de Validação:</strong> <?= htmlspecialchars($erro) ?>
            </div>
        <?php endif; ?>

        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body p-4">
                <h4 class="card-title mb-4">Entrada de Dados da Amostra</h4>
                <form method="POST">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label font-weight-bold">pH (6,0 - 9,5)</label>
                            <input type="number" step="0.1" name="ph" class="form-control" placeholder="Ex: 7.2" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Turbidez Bruta (uT)</label>
                            <input type="number" step="0.1" name="turbidez" class="form-control" placeholder="Ex: 8.5" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Cloro Residual (mg/L)</label>
                            <input type="number" step="0.1" name="cloro" class="form-control" placeholder="Ex: 1.5" required>
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Dureza Total (mg/L)</label>
                            <input type="number" step="0.1" name="dureza" class="form-control" placeholder="Ex: 120.0" required>
                        </div>
                        <div class="col-md-12 mt-3">
                            <hr>
                            <label class="form-label fw-bold">Biofiltro Experimental (Pós-Tratamento)</label>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Turbidez Pós-Filtro (uT)</label>
                            <input type="number" step="0.1" name="turbidez_pos" class="form-control" placeholder="Ex: 1.2">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary mt-4 w-100 fw-bold">Processar Análise</button>
                </form>
            </div>
        </div>

        <?php if ($resultado): ?>
            <div class="card shadow-sm border-0 bg-white p-4">
                <h4 class="mb-3">Laudo Técnico da Água</h4>
                
                <div class="alert alert-<?= $resultado['diagnostico'] === 'Aprovado/Adequado' ? 'success' : 'danger' ?> fs-5 text-center fw-bold">
                    Diagnóstico Final: <?= $resultado['diagnostico'] ?>
                </div>

                <div class="table-responsive mt-3">
                    <table class="table table-bordered">
                        <thead class="table-dark">
                            <tr>
                                <th>Parâmetro</th>
                                <th>Valor Inserido</th>
                                <th>Classificação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>pH</td>
                                <td><?= $resultado['ph']['valor'] ?></td>
                                <td><span class="badge bg-<?= $resultado['ph']['status'] === 'Adequado' ? 'success' : 'danger' ?>"><?= $resultado['ph']['status'] ?></span></td>
                            </tr>
                            <tr>
                                <td>Turbidez Bruta</td>
                                <td><?= $resultado['turbidez']['valor'] ?> uT</td>
                                <td><span class="badge bg-<?= $resultado['turbidez']['status'] === 'Conforme' ? 'success' : 'danger' ?>"><?= $resultado['turbidez']['status'] ?></span></td>
                            </tr>
                            <tr>
                                <td>Cloro Residual</td>
                                <td><?= $resultado['cloro']['valor'] ?> mg/L</td>
                                <td><span class="badge bg-<?= $resultado['cloro']['status'] === 'Adequado' ? 'success' : 'danger' ?>"><?= $resultado['cloro']['status'] ?></span></td>
                            </tr>
                            <tr>
                                <td>Dureza Total</td>
                                <td><?= $resultado['dureza']['valor'] ?> mg/L</td>
                                <td><span class="badge bg-<?= $resultado['dureza']['status'] === 'Adequada' ? 'success' : 'danger' ?>"><?= $resultado['dureza']['status'] ?></span></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <?php if (isset($resultado['eficiencia_turbidez'])): ?>
                    <div class="p-3 bg-light rounded mt-3">
                        <h5 class="text-primary mb-1">Rendimento do Biofiltro</h5>
                        <p class="mb-0">Taxa de Remoção de Turbidez: <strong><?= $resultado['eficiencia_turbidez'] ?>%</strong></p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>