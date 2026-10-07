# Laboratório Digital de Qualidade da Água & Biofiltro

Aplicação Web desenvolvida em PHP 8.4 para simulação de análises físico-químicas de potabilidade da água, avaliação da eficiência de biofiltros e validação automatizada de regras de negócio.

## 🚀 Ferramentas e Tecnologias
- **Linguagem:** PHP 8.4
- **Interface:** HTML5, CSS3, Bootstrap 5
- **Testes Automatizados:** PHPUnit
- **Servidor Local:** Laravel Herd

## 🧪 Algoritmos Implementados
1. **Classificação do pH:** Valida a faixa ideal entre 6.0 e 9.5 (Portaria GM/MS nº 888).
2. **Classificação da Turbidez:** Limite de potabilidade $\le 5.0\text{ uT}$.
3. **Classificação do Cloro Residual:** Faixa ideal entre 0.2 e 5.0 mg/L.
4. **Classificação da Dureza Total:** Limite tolerado $\le 500\text{ mg/L}$.
5. **Cálculo da Eficiência do Biofiltro:** Cálculo percentual da remoção de impurezas:
   $$\text{Eficiência (\%)} = \left(\frac{\text{Valor Inic} - \text{Valor Fin}}{\text{Valor Inic}}\right) \times 100$$

## 🛠️ Como Executar o Projeto

1. Clone o repositório para a pasta do Laravel Herd:
   ```bash
   cd ~/Herd
   git clone <URL_DO_REPOSITORIO> TRABALHO_FISICA