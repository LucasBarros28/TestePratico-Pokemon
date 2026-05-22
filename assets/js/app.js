$(window).on("load", function () {

    // Controla quantas linhas estão visíveis no momento
    const LINHAS_POR_PAGINA = 10;
    let linhasVisiveis = LINHAS_POR_PAGINA;

    const tabela = $('#tabelaPokemon').DataTable({
        searching:    false,  
        lengthChange: false,  
        paging:       false,  
        info:         false,  
        language: {
            url: 'https://cdn.datatables.net/plug-ins/1.13.6/i18n/pt-BR.json'
        },
        columnDefs: [
            { orderable: false, targets: [0,1,2,3,4] }
        ]
    });


   //Execulta a janela flutuante de controle 
   // secção de controle da janela 
    $('#btnAbrirModal').on('click', function () {
        $('#camposIds').empty();
        adicionarCampo(1);
        const modal = new bootstrap.Modal(document.getElementById('modalInserirCodigo'));
        modal.show();
    });


    //adicionar linha

    $('#btnAdicionarCampo').on('click', function () {
        const total = $('#camposIds .campo-id-grupo').length + 1;
        adicionarCampo(total);
    });


    //controle estetico de ordem numerica

    function adicionarCampo(numero) {
        const html = `
            <div class="campo-id-grupo mb-3">
                <label class="form-label fw-semibold">Código ${numero}</label>
                <input 
                    type="number" 
                    class="form-control input-pokemon-id" 
                    placeholder="Código"
                    min="1"
                >
            </div>
        `;
        $('#camposIds').append(html);
    }


   //salva e envia

    $('#btnSalvar').on('click', function () {

        const ids = [];
        $('.input-pokemon-id').each(function () {
            const valor = $(this).val().trim();
            if (valor !== '') ids.push(valor);
        });

        if (ids.length === 0) {
            alert('Por favor, insira ao menos um código de Pokémon.');
            return;
        }

        $('#btnSalvar').prop('disabled', true).html(
            '<i class="fa-solid fa-spinner fa-spin me-1"></i> Buscando...'
        );

        $.ajax({
            url: 'pokemon.php',
            method: 'POST',
            dataType: 'json',
            data: { ids: ids },

            success: function (resposta) {
                if (resposta.sucesso) {
                    resposta.pokemons.forEach(function (pokemon) {
                        inserirNaTabela(pokemon);
                    });

                    // Após inserir, aplica a visibilidade correta
                    atualizarVisibilidade();

                    bootstrap.Modal.getInstance(
                        document.getElementById('modalInserirCodigo')
                    ).hide();

                } else {
                    alert('Erro: ' + resposta.mensagem);
                }
            },

            error: function () {
                alert('Erro ao comunicar com o servidor. Verifique o console.');
            },

            complete: function () {
                $('#btnSalvar').prop('disabled', false).html('Salvar');
            }
        });
    });


    //inserir linha para mais pokemon
    function inserirNaTabela(pokemon) {

        const badges = pokemon.tipos.map(function (tipo) {
            return `<span class="badge-tipo tipo-${tipo}">${tipo}</span>`;
        }).join('');

        const imagem = `<img src="${pokemon.imagem}" alt="${pokemon.nome}" class="pokemon-img">`;

        const btnExcluir = `<div class="text-center"> <button class="btn-excluir" title="Remover">
            <i class="fa-solid fa-trash"></i>
        </button>`;

        tabela.row.add([
            pokemon.id,
            pokemon.nome.charAt(0).toUpperCase() + pokemon.nome.slice(1),
            badges,
            imagem,
            btnExcluir
        ]).draw(false);
    }


    // botão de carregar mais
    function atualizarVisibilidade() {
        const linhas = $('#tabelaPokemon tbody tr');
        const total  = linhas.length;

        linhas.each(function (index) {
            if (index < linhasVisiveis) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });

         $('#btnCarregarMais').show();
        
    }

    
    $('#btnCarregarMais').on('click', function () {
        linhasVisiveis += LINHAS_POR_PAGINA;
        atualizarVisibilidade();
    });


    //excluindo linha da tabela

    $('#tabelaPokemon tbody').on('click', '.btn-excluir', function () {
        tabela.row($(this).closest('tr')).remove().draw(false);
        atualizarVisibilidade();
    });

});