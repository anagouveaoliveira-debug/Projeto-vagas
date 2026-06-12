# 🗂️ Dash Vagas — Sistema Administrativo de Gerenciamento de Vagas

Painel administrativo completo desenvolvido em **PHP** com banco de dados **PostgreSQL**,
aplicando conceitos de **Programação Orientada a Objetos (POO)** e boas práticas de desenvolvimento Back-End.

---

## 📋 Sobre o Projeto

O **Dash Vagas** é um sistema CRUD completo para gerenciamento de vagas de emprego,
permitindo o controle total do ciclo de vida de cada registro — desde o cadastro até o arquivamento.

---

## ⚙️ Funcionalidades

- ✅ **Cadastrar** novas vagas com título, descrição e status
- ✅ **Editar** informações de vagas existentes
- ✅ **Inativar** vagas sem excluí-las do sistema
- ✅ **Arquivar** vagas encerradas
- ✅ **Filtrar** vagas por título do cargo
- ✅ **Controle de status** — Ativo / Inativo

---

## 🚀 Tecnologias Utilizadas

| Tecnologia | Função |
|---|---|
| PHP 8 (POO) | Lógica Back-End e regras de negócio |
| PostgreSQL | Banco de dados relacional |
| Composer | Gerenciamento de dependências e autoload |
| HTML5 + CSS3 | Estrutura e estilo das páginas |
| Bootstrap 4 | Interface responsiva |
| Git + GitHub | Versionamento de código |

---

## 📁 Estrutura do Projeto

dash-vagas/
├── app/
│   ├── Db/
│   │   └── Database.php       # Conexão com o banco de dados
│   └── Entity/
│       └── Vaga.php           # Entidade principal (POO)
├── includes/
│   ├── header.php             # Cabeçalho
│   ├── footer.php             # Rodapé
│   ├── formulario.php         # Formulário de cadastro/edição
│   └── listagem.php           # Listagem de vagas
├── index.php                  # Página principal
├── cadastrar.php              # Cadastro de vagas
├── editar.php                 # Edição de vagas
├── inativar.php               # Inativação de vagas
├── arquivar.php               # Arquivamento de vagas
└── excluir.php                # Exclusão de vagas

---

## 👩‍💻 Autora

**Ana Flávia Gouvea de Oliveira**
Desenvolvedora PHP Back-End | São José do Rio Preto, SP

[![LinkedIn](https://img.shields.io/badge/LinkedIn-0077B5?style=for-the-badge&logo=linkedin&logoColor=white)](https://www.linkedin.com/in/angoliveira/)
[![Gmail](https://img.shields.io/badge/Gmail-D14836?style=for-the-badge&logo=gmail&logoColor=white)](mailto:ago.flavia@hotmail.com)
