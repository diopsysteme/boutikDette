<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tableau de bord</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">
    <div class="flex flex-col md:flex-row">
        <nav class="bg-indigo-600 text-white w-full md:w-64">
            <div class="p-4 text-xl font-bold">
                <a href="/" class="block text-white">Tableau de bord</a>
            </div>
            <ul>
                <li class="p-4 hover:bg-indigo-500">
                    <a href="/client" class="block">Liste des clients</a>
                </li>
                <li class="p-4 hover:bg-indigo-500">
                    <a href="/dette/list/1" class="block">Liste des dettes</a>
                </li>
                <li class="p-4 hover:bg-indigo-500">
                    <a href="/ajoutDette/1" class="block">Ajouter une dette</a>
                </li>
                <li class="p-4 hover:bg-indigo-500">
                    <a href="/paiement/list/1" class="block">Liste des paiements</a>
                </li>
                <li class="p-4 hover:bg-indigo-500">
                    <a href="/paiement/pay/1" class="block">Faire un paiement</a>
                </li>
                <li class="p-4 hover:bg-indigo-500">
                    <a href="/details/article/1" class="block">Détails des articles</a>
                </li>
            </ul>
        </nav>
        <main class="flex-1 p-6">
            <!-- Ici vous pouvez inclure le contenu dynamique de chaque page -->
            <?=$content?>
        </main>
    </div>
</body>
</html>
