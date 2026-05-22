<?php
header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Método inválido.']);
    exit;
}

// Recebe os IDs
$ids = $_POST['ids'] ?? [];

if (empty($ids) || !is_array($ids)) {
    echo json_encode(['sucesso' => false, 'mensagem' => 'Nenhum ID enviado.']);
    exit;
}

$pokemons = [];
$erros    = [];

foreach ($ids as $id) {
    $id = trim($id);

    if (!is_numeric($id) || (int)$id <= 0) {
        $erros[] = "ID inválido: {$id}";
        continue;
    }

    $dados = buscarPokemon((int)$id);

    if ($dados === null) {
        $erros[] = "Pokémon com ID {$id} não encontrado.";
        continue;
    }

    $pokemons[] = $dados;
}

echo json_encode([
    'sucesso'  => true,
    'pokemons' => $pokemons,
    'erros'    => $erros
]);
exit;

// buscando os pokemons
function buscarPokemon(int $id): ?array
{
    $url = "https://pokeapi.co/api/v2/pokemon/{$id}";

    
    $contexto = stream_context_create([
        'http' => [
            'timeout'    => 10,
            'user_agent' => 'PokemonApp/1.0',
            'method'     => 'GET',
        ],
        'ssl' => [
            
            'verify_peer'      => false,
            'verify_peer_name' => false,
        ]
    ]);

    
    $resposta = @file_get_contents($url, false, $contexto);

    if ($resposta === false) {
        return null;
    }

    $dados = json_decode($resposta, true);

    if (!$dados) {
        return null;
    }

    $nome      = $dados['name'] ?? 'desconhecido';
    $pokemonId = $dados['id']   ?? $id;
    $tipos     = array_map(fn($item) => $item['type']['name'], $dados['types'] ?? []);
    $imagem    = $dados['sprites']['front_default'] ?? '';

    return [
        'id'     => $pokemonId,
        'nome'   => $nome,
        'tipos'  => $tipos,
        'imagem' => $imagem,
    ];
}