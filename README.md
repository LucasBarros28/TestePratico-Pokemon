# Teste Técnico — Lista de Pokémons

Sistema web dinâmico desenvolvido em PHP e JavaScript/jQuery que consome a [PokeAPI](https://pokeapi.co/) e exibe informações de Pokémons em uma tabela interativa, sem necessidade de recarregar a página.

---

## Tecnologias utilizadas

- **PHP 8.5** — back-end e consumo da PokeAPI
- **JavaScript / jQuery 3.7** — manipulação do DOM e requisições AJAX
- **Bootstrap 5** — estilização e componentes (modal, tabela, botões)
- **DataTables 1.13** — tabela dinâmica e interativa
- **Font Awesome 6** — ícones
- **PokeAPI** — API pública de dados de Pokémons

---

## Funcionalidades

- Adicionar um ou mais Pokémons pelo ID via modal
- Busca assíncrona na PokeAPI via AJAX (sem recarregar a página)
- Exibição de ID, nome, tipo(s) e foto de cada Pokémon
- Badges coloridos por tipo (Fire, Water, Grass, etc.)
- Exclusão de registros individualmente
- Exibição progressiva de 10 em 10 registros com botão "Carregar mais"

---

## Estrutura do projeto

```
pokemon-app/
├── index.php            # Página principal (front-end)
├── pokemon.php          # Controller PHP (back-end)
├── README.md
└── assets/
    ├── css/
    │   └── style.css    # Estilos customizados
    └── js/
        └── app.js       # Lógica jQuery/AJAX
```

---

## Como rodar localmente

### Pré-requisitos
- PHP 8.0 ou superior
- Extensões PHP habilitadas: `openssl`, `curl`

### Passo a passo

1. Clone o repositório:
```bash
git clone https://github.com/SEU_USUARIO/TestePratico-Pokemon.git
```

2. Acesse a pasta do projeto:
```bash
cd TestePratico-Pokemon
```

3. Inicie o servidor embutido do PHP:
```bash
php -S localhost:8000
```

4. Acesse no navegador:
```
http://localhost:8000
```

---

## Como usar

1. Clique no botão **+** no cabeçalho da tabela
2. Digite o ID de um ou mais Pokémons no modal
   - Clique em **Adicionar nova linha** para inserir mais IDs
3. Clique em **Salvar** — os dados serão buscados automaticamente
4. Para remover um Pokémon, clique no ícone de lixeira na linha correspondente
5. Clique em **Carregar mais +** para exibir mais registros

### IDs para teste

| ID | Pokémon |
|----|---------|
| 1 | Bulbasaur |
| 4 | Charmander |
| 6 | Charizard |
| 25 | Pikachu |
| 150 | Mewtwo |

---

## Fluxo da aplicação

```
Usuário digita IDs no modal
        ↓
JavaScript envia IDs via AJAX (POST)
        ↓
PHP recebe os IDs e consulta a PokeAPI
        ↓
PokeAPI retorna os dados do Pokémon
        ↓
PHP processa e retorna JSON otimizado
        ↓
JavaScript insere os dados na tabela
```

---

## Configuração PHP necessária

No arquivo `php.ini`, certifique-se que as seguintes extensões estão habilitadas:

```ini
extension=openssl
extension=curl
extension_dir = "C:\php\ext"
```
