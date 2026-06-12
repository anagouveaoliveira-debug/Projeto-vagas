 🗂️ Dash Vagas — Sistema Administrativo de Gerenciamento de Vagas

Painel administrativo completo desenvolvido em **PHP** com banco de dados **PostgreSQL**,
aplicando conceitos de **Programação Orientada a Objetos (POO)**, arquitetura em camadas
e boas práticas de segurança no desenvolvimento Back-End.

---

## 📋 Sobre o Projeto

O **Dash Vagas** é um sistema CRUD completo para gerenciamento de vagas de emprego,
permitindo o controle total do ciclo de vida de cada registro — desde o cadastro até o arquivamento.

O projeto foi desenvolvido com foco em **regras de negócio reais**, **proteção de dados**
e **experiência do usuário**, indo além de um CRUD simples.

---

## ⚙️ Funcionalidades

- ✅ **Cadastrar** novas vagas com título, descrição e status
- ✅ **Editar** informações de vagas existentes
- ✅ **Inativar** vagas com motivo obrigatório antes de arquivar
- ✅ **Arquivar** vagas com travas de negócio (só arquiva se inativa e com motivo)
- ✅ **Excluir** vagas com tela de confirmação — rota protegida, não exposta na interface
- ✅ **Filtrar** vagas por título do cargo
- ✅ **Controle de status** — Ativo / Inativo / Arquivado
- ✅ **Rascunho em sessão** — preserva dados digitados ao redirecionar entre telas
- ✅ **Proteção de URLs** — bloqueia acesso direto a rotas sensíveis sem dados válidos

---

## 🔒 Segurança Implementada

- Validação de ID via `filter_input` antes de qualquer operação
- Uso de **PDO com prepared statements** — proteção contra SQL Injection
- Verificação de existência do registro antes de qualquer ação
- Exclusão apenas via método `POST` — evita exclusão acidental por GET
- Proteção contra acesso direto a URLs sem sessão válida
- `htmlspecialchars` nos dados exibidos — proteção contra XSS

---

## 🏗️ Arquitetura do Projeto

O projeto segue uma arquitetura em camadas separando responsabilidades:
dash-vagas/
├── app/
│   ├── Db/
│   │   └── Database.php       # Camada de banco — PDO, queries, prepared statements
│   └── Entity/
│       └── Vaga.php           # Entidade — regras de negócio e métodos CRUD
├── includes/
│   ├── header.php             # Cabeçalho e navbar
│   ├── footer.php             # Rodapé e scripts
│   ├── formulario.php         # Formulário de cadastro/edição
│   ├── formulario-inativar.php        # Formulário de inativação com motivo
│   ├── formulario-motivo-cadastro.php # Formulário de motivo ao cadastrar inativa
│   ├── confirmar-exclusao.php # Tela de confirmação antes de excluir
│   └── listagem.php           # Tabela de vagas com badges e ações
├── vendor/                    # Dependências via Composer
├── index.php                  # Painel principal com listagem e filtro
├── cadastrar.php              # Cadastro de vagas com fluxo de sessão
├── cadastrar-motivo.php       # Tela exclusiva para motivo de vaga inativa
├── editar.php                 # Edição de vagas
├── inativar.php               # Inativação com motivo obrigatório
├── arquivar.php               # Arquivamento com travas de negócio
└── excluir.php                # Exclusão com confirmação via POST

---

## 🚀 Tecnologias Utilizadas

| Tecnologia | Função |
|---|---|
| PHP 8 (POO) | Lógica Back-End e regras de negócio |
| PostgreSQL | Banco de dados relacional |
| PDO | Conexão segura com prepared statements |
| Composer | Gerenciamento de dependências e autoload |
| HTML5 + CSS3 | Estrutura e estilo das páginas |
| Bootstrap 4 | Interface responsiva |
| Git + GitHub | Versionamento de código |

---

## 💡 Destaques Técnicos

- **Rascunho em sessão PHP** — ao cadastrar uma vaga já inativa, o sistema preserva
os dados digitados e redireciona para uma tela exclusiva de motivo, sem perder nenhuma informação
- **Travas de negócio no arquivamento** — uma vaga só pode ser arquivada se estiver
inativa E tiver motivo preenchido, garantindo integridade dos dados
- **Arquitetura em camadas** — separação entre banco de dados (`Database.php`) e
regras de negócio (`Vaga.php`), facilitando manutenção e escalabilidade
- **Fluxo de exclusão seguro** — exclusão só ocorre via POST após confirmação,
evitando perdas acidentais de dados

---

## 🎓 Formação e Contexto

Projeto desenvolvido durante estudos, aplicando na prática:
- Programação Orientada a Objetos (POO)
- Integração com banco de dados PostgreSQL via PDO
- Versionamento com Git e GitHub
- Desenvolvimento de sistemas administrativos reais

---

## 👩‍💻 Autora

**Ana Flávia Gouvea de Oliveira**
Desenvolvedora PHP Back-End | São José do Rio Preto, SP

[![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/angoliveira/)
[![Gmail](https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white)](mailto:ago.flavia@hotmail.com)
