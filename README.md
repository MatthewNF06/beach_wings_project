# Beach Wings Network
*Projeto inicialmente desenvolvido de forma acadêmica para a disciplina de Desenvolvimento Web no IFES - Serra em 2026/1, e posteriormente ampliado para um modelo real de negócios.*

**O 1º Marketplace Exclusivo da Orla**

Bem-vindo ao repositório do **Beach Wings Network**, uma plataforma web (SaaS) desenvolvida para digitalizar e otimizar as vendas diretas de quiosques litorâneos. Este projeto nasceu para resolver uma dor real do mercado gastronômico de praia: a altíssima dependência de aplicativos de entrega terceirizados (que cobram até 27% de taxa) e a dificuldade de logística de atendimento diretamente na areia.

---

## O Problema e a Solução

**A Dor do Lojista (B2B):** 
Refém de grandes apps de entrega que corroem a margem de lucro com taxas que chegam a 26,5% por pedido. Além disso, a logística de atender dezenas de guarda-sóis simultaneamente gera atrasos e perda de vendas.

**A Dor do Banhista (B2C):**
Enfrenta filas, demora para ser atendido por garçons e tem dificuldade em pagar debaixo de sol.

**A Solução (Beach Wings):**
Uma plataforma web responsiva e centralizada onde o cliente pode visualizar todos os quiosques abertos na sua região, montar um carrinho unificado (pedindo itens de locais diferentes), realizar reservas de mesas e acompanhar o seu histórico de pedidos. Tudo isto com uma interface moderna, sem a necessidade de baixar aplicativos, e com taxas de comissão muito mais justas para o lojista.

---

## Modelo de Negócios e Viabilidade Comercial

Desenvolver uma plataforma de marketplace com esta arquitetura sob medida (MVC, Banco Relacional, Carrinho e Checkouts seguros) tem um custo estimado no mercado atual (2026) entre **R$ 15.000,00 e R$ 25.000,00** (aprox. 150 a 250 horas de desenvolvimento pleno).

Para contornar este alto custo para os lojistas, o sistema foi arquitetado para operar no modelo **SaaS (Software as a Service) / White-label**:
*   **Taxa de Adesão:** R$ 800,00 (Setup, cadastro do cardápio e treinamento da equipe do quiosque).
*   **Mensalidade Fixa:** R$ 149,90 (Acesso, hospedagem e suporte).
*   **Comissão Justa:** Apenas **2% por pedido online**.

> *Com apenas 10 quiosques parceiros na orla, o projeto já se torna altamente lucrativo, garantindo economia massiva para o lojista (que antes perdia milhares de reais em taxas) e receita recorrente para a plataforma.*

---

## Arquitetura do Software (Padrão MVC)

O projeto foi rigorosamente construído utilizando o padrão de arquitetura de software **MVC (Model-View-Controller)**, garantindo separação de responsabilidades, alta manutenibilidade e adequação a normas de qualidade (como a ISO 25010).

*   **Ponto de Entrada Único (Front Controller):** Todas as requisições passam exclusivamente pelo `index.php`, que analisa a URL e aciona o Controlador correto.
*   **Views (A Interface):** Totalmente limpas de lógicas complexas de negócio ou banco de dados. Utilizam o princípio **DRY (Don't Repeat Yourself)** através de inclusão dinâmica de `header.php` e `footer.php`.
*   **Controllers (Os Orquestradores):** Interceptam a ação do usuário, chamam os Models necessários, controlam as variáveis de Sessão (Carrinho dinâmico e Alertas) e decidem qual View apresentar.
*   **Models (O Cérebro):** Centralizam as regras de negócio e detêm o monopólio da comunicação com o banco de dados MySQL.

---

## Banco de Dados Relacional e Segurança

O sistema opera com um banco de dados **MySQL** robusto, gerido nativamente pelo PHP através da biblioteca **PDO (PHP Data Objects)**.

### Estrutura Relacional (1:N)
O sistema evoluiu de um restaurante único para um Marketplace. A tabela mestre é a `Quiosques`. A plataforma sabe sempre a qual estabelecimento pertencem os `Produtos`, as `Reservas` e os `Itens_Pedido` através de Foreign Keys.

### Transações ACID no Checkout (Confiabilidade Máxima)
Para garantir que a lógica do "Carrinho Inteligente" não corrompa dados em caso de falhas de conexão, a finalização do pedido utiliza transações ACID nativas do banco de dados (`$conn->beginTransaction()`). 
*   O cabeçalho da compra grava na tabela `Pedidos` (total e cliente), e cada prato/bebida grava na tabela `Itens_Pedido`. 
*   **Garantia:** Se um erro ocorrer a meio da inserção de qualquer item, é executado um `$conn->rollBack()`. Se for 100% bem-sucedido, o `$conn->commit()` regista tudo. Ninguém é cobrado sem o pedido ser gerado perfeitamente.

### Blindagem e Segurança
*   **Prevenção de SQL Injection:** Utilização estrita de **Prepared Statements** e vinculação de parâmetros (`bindParam` / `execute([$array])`) em absolutamente todas as interações de CRUD.
*   **Criptografia:** Senhas de usuários armazenadas no banco com hashes seguros via `password_hash()` (Algoritmo BCRYPT).
*   **Validação Inteligente:** O Model barra transações vazias ou maliciosas antes que cheguem ao banco.

---

## UI/UX e Tecnologias Front-end

A interface foi desenhada para a melhor experiência "mobile-first", respeitando as normas de Usabilidade para clientes que estão num ambiente de lazer.

*   **Framework Base:** **Bootstrap 5**, complementado por CSS customizado.
*   **Identidade Visual (Dark Mode Imersivo):** Paleta inspirada na costa (Azul Oceano Profundo, Amarelo Areia e Laranja Pôr do Sol), garantindo alto contraste sob a luz do sol e um visual moderno.
*   **Feedback Dinâmico sem recarregar:** Utilização intensiva de variáveis de Sessão (`$_SESSION`) para exibir Alertas Visuais (Verde para sucesso, Vermelho para erro) mantendo o utilizador no fluxo de compras sem mostrar erros de servidor.
*   **Carrinho Inteligente:** Contador dinâmico no Header e possibilidade de adicionar itens permanecendo na tela do Cardápio para estimular o aumento do ticket médio.

---

## Próximos Passos (Visão de Futuro)

O MVP (Produto Mínimo Viável) já cumpre todos os requisitos de segurança, escalabilidade e design. As próximas evoluções (Fase 2) incluem:
*   [ ] **Painel Administrativo do Lojista:** Área restrita para os donos de quiosques gerirem o cardápio e alterarem o status dos pedidos para "Entregue".
*   [ ] **Integração de Pagamentos:** Conexão com APIs de Gateway (Pix e Cartão de Crédito) para cobrar o cliente diretamente na finalização do carrinho.
*   [ ] **Login de Usuário Avançado:** Transformar a simulação de ID na sessão atual num sistema completo de autenticação JWT ou Session-based com recuperação de senha.

---
*Projeto desenvolvido por Matheus Abreu de Campos para a disciplina de Desenvolvimento Web.*
