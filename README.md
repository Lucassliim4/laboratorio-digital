# Laboratório Digital de Qualidade da Água & Biofiltro

OBJETIVO: 
Desenvolver, em PHP, uma aplicação web que simule um laboratório digital de testes de qualidade da água, calculando indicadores a partir de dados inseridos pelo usuário (medidos manualmente em campo/laboratório ou fornecidos como dataset simulado), classificando a água segundo padrões de potabilidade, e modelando o efeito de um biofiltro experimental sobre esses indicadores, validando toda a lógica de cálculo por meio de unitários automatizados com PHPUnit.

OBJETIVOS ESPECÍFICOS
Implementar algoritmos que calculem e classifiquem parâmetros de qualidade da água (pH, turbidez, cloro residual, dureza, temperatura, etc.).
Modelar matematicamente o efeito de um biofiltro (percentual de remoção/melhora por camada ou por parâmetro).
Criar uma interface web para entrada dos dados coletados (antes/depois do filtro) e visualização dos resultados.
Escrever testes unitários que comprovem a corretude das classificações e dos cálculos, incluindo casos-limite.
Relacionar os resultados do sistema com os conceitos de Química/Biologia trabalhados em sala (padrões de potabilidade)

## Ferramentas e Tecnologias
- **Linguagem:** PHP 8.4
- **Interface:** HTML5, CSS3, Bootstrap 5
- **Testes Automatizados:** PHPUnit
- **Servidor Local:** Laravel Herd

## Algoritmos Implementados
1. **Classificação do pH:** Valida a faixa ideal entre 6.0 e 9.5 (Portaria GM/MS nº 888).
2. **Classificação da Turbidez:** Limite de potabilidade $\le 5.0\text{ uT}$.
3. **Classificação do Cloro Residual:** Faixa ideal entre 0.2 e 5.0 mg/L.
4. **Classificação da Dureza Total:** Limite tolerado $\le 500\text{ mg/L}$.
5. **Cálculo da Eficiência do Biofiltro:** Cálculo percentual da remoção de impurezas:
   $$\text{Eficiência (\%)} = \left(\frac{\text{Valor Inic} - \text{Valor Fin}}{\text{Valor Inic}}\right) \times 100$$

## Como Executar o Projeto

   cd ~/Herd
   git clone <URL_DO_REPOSITORIO> TRABALHO_FISICA