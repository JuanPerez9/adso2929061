<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MVC: Model | View | Controller</title>

    <link href="https://cdn.jsdelivr.net/npm/daisyui@5" rel="stylesheet" type="text/css" />
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>

<body class="bg-blue-900 min-h-[100dvh] text-white p-10">

    <h1 class="text-4xl text-center font-bold">MVC</h1>
    <small class="block text-center">Model | View | Controller</small>

    <h2 class="my-10 text-center text-xl font-bold border-b pb-2">
        List Pokemons
    </h2>

    <!-- ADD POKEMON -->
    <button
        class="btn btn-success flex mx-auto w-[200px] my-4"
        onclick="openModal('create')">
        Add Pokemon
    </button>

    <?php
    // Colores por tipo
    $typeColors = [
        'fire'     => 'border-orange-900',
        'water'    => 'border-blue-600',
        'grass'    => 'border-green-600',
        'electric' => 'border-yellow-200',
        'ice'      => 'border-cyan-400',
        'psychic'  => 'border-pink-500',
        'rock'     => 'border-stone-500',
        'ground'   => 'border-yellow-800',
        'dark'     => 'border-gray-700',
        'fairy'    => 'border-pink-300',
        'default'  => 'border-gray-600'
    ];

    // Colores del badge
    $badgeColors = [
        'fire'     => 'badge-warning',
        'water'    => 'badge-info',
        'grass'    => 'badge-success',
        'electric' => 'badge-warning',
        'ice'      => 'badge-info',
        'psychic'  => 'badge-secondary',
        'dark'     => 'badge-neutral',
        'fairy'    => 'badge-accent'
    ];
    ?>

    <!-- TABLE -->
    <div class="overflow-x-auto max-w-4xl mx-auto">
        <table class="table table-sm bg-gray-900 text-gray-200 rounded-lg">

            <thead class="bg-gray-800 text-gray-300">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Type</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($data as $pokemon): 
                    $type = strtolower($pokemon['type']);
                    $borderColor = $typeColors[$type] ?? $typeColors['default'];
                ?>
                <tr class="border-l-4 <?= $borderColor ?> hover:bg-gray-800 transition">

                    <td><?= htmlspecialchars($pokemon['id']) ?></td>

                    <td class="font-semibold">
                        <?= htmlspecialchars($pokemon['name']) ?>
                    </td>

                    <td>
                        <span class="badge <?= $badgeColors[$type] ?? 'badge-outline' ?> capitalize">
                            <?= htmlspecialchars($pokemon['type']) ?>
                        </span>
                    </td>

                    <td class="text-center">
                        <div class="flex justify-center gap-2">
                            <button
                                class="btn btn-xs btn-info"
                                onclick="openModal('edit', <?= $pokemon['id'] ?>)">
                                Edit
                            </button>

                            <a
                                href="index.php?action=delete&id=<?= $pokemon['id'] ?>"
                                onclick="return confirm('Delete this Pokémon?')"
                                class="btn btn-xs btn-error">
                                Delete
                            </a>
                        </div>
                    </td>

                </tr>
                <?php endforeach; ?>
            </tbody>

        </table>
    </div>

    <!-- Modal -->
    <dialog id="pokemonModal" class="modal">
        <div class="modal-box bg-gray-900 text-white">
            <h3 class="font-bold text-lg mb-4">Pokemon</h3>

            <div id="modalContent"></div>

            <div class="modal-action">
                <form method="dialog">
                    <button class="btn">Close</button>
                </form>
            </div>
        </div>
    </dialog>

    <script>
        function openModal(action, id = '') {
            const modal = document.getElementById('pokemonModal')
            const content = document.getElementById('modalContent')

            let url = `index.php?action=${action}`
            if (id) url += `&id=${id}`

            fetch(url)
                .then(res => res.text())
                .then(html => {
                    content.innerHTML = html
                    modal.showModal()
                })
        }
    </script>

</body>
</html>
