<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pokémons</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <h5 class="mb-3">Lista de pokemons</h5>
    <!-- Incio da tabela-->
    <div class="card shadow-sm">
        <div class="card-body p-0">
            <table id="tabelaPokemon" class="table table-hover table-bordered w-100 mb-0">
                <thead class="table-light">
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Tipo</th>
                        <th>Foto</th>
                        <th class="text-center">
                            <button class="btn btn-primary btn-sm rounded-circle" id="btnAbrirModal" title="Adicionar Pokémon">
                                <i class="fa-solid fa-plus"></i>
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
        <!-- botão de controle -->
        <div class="text-center py-2 border-top">
            <button class="btn btn-link text-muted text-decoration-none" id="btnCarregarMais">
                Carregar mais +
            </button>
        </div>

    </div>

</div>

<!-- janela flutuante de adicão de dados ou linhas -->
<div class="modal fade" id="modalInserirCodigo" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Inserir código</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
            </div>

            <div class="modal-body">
                <div id="camposIds"></div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="btnAdicionarCampo">
                    Adicionar nova linha
                </button>
                <button type="button" class="btn btn-primary" id="btnSalvar">
                    Salvar
                </button>
            </div>

        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script src="assets/js/app.js"></script>

</body>
</html>