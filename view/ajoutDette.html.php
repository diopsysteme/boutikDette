
    <div class="container mx-auto mt-10 p-6 bg-white shadow-lg rounded-md">
        <h1 class="text-2xl font-bold mb-6">Nouvelle Dette</h1>

        <?php
        // Simuler la récupération des informations du client
        // Remplacez ceci par votre propre logique pour récupérer les données du client
        $client = [
            'nom' => 'Doe',
            'prenom' => 'John',
            'telephone' => '123456789'
        ];
        ?>

        <!-- Vérifiez si les informations du client sont disponibles -->
        <?php if (!empty($client)): ?>
            <!-- Afficher les informations du client -->
            <div id="client-info" class="bg-white shadow-md rounded p-4 mb-4">
                <p><strong>Nom:</strong> <?= htmlspecialchars($client['nom']) ?></p>
                <p><strong>Prénom:</strong> <?= htmlspecialchars($client['prenom']) ?></p>
                <p><strong>Téléphone:</strong> <?= htmlspecialchars($client['telephone']) ?></p>
            </div>
        <?php else: ?>
            <!-- Afficher le formulaire de recherche de client si les informations ne sont pas disponibles -->
            <div class="mb-4">
                <label for="client-search" class="block text-sm font-medium text-gray-700">Rechercher Client</label>
                <div class="flex">
                    <form action="?add" method="post">
                        <input type="text" id="client-search" name="client_search" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Rechercher...">
                        <button  class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">+</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>

        <!-- Recherche d'Articles -->
        <div class="mb-4">
            <label for="article-search" class="block text-sm font-medium text-gray-700">Rechercher Articles</label>
            <form action="?search" method="post">
                <div class="flex">
                    <input type="text" id="article-search" name="article_search" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Rechercher...">
                    <button  name="searchProd" type="submit" class="ml-2 px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">Rechercher</button>
                </div>
            </form>
        </div>
        <div id="article-info">
            <!-- Les résultats de la recherche d'articles apparaîtront ici -->
        </div>

        <!-- Quantité et Prix Unitaire -->
        <div class="mb-4">
            <div class="grid grid-cols-2 gap-4">
                <div>
                    <label for="quantity" class="block text-sm font-medium text-gray-700">Quantité</label>
                    <input type="number" id="quantity" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Quantité">
                </div>
                <div>
                    <label for="unit-price" class="block text-sm font-medium text-gray-700">Prix Unitaire</label>
                    <input type="number" id="unit-price" class="block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" placeholder="Prix Unitaire">
                </div>
            </div>
        </div>

        <!-- Bouton Ajouter -->
        <div class="mb-4">
            <button id="addToCart" class="px-4 py-2 bg-green-500 text-white rounded-md hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Ajouter au Panier</button>
        </div>

        <!-- Panier -->
        <div class="mb-4">
            <h2 class="text-xl font-semibold mb-2">Panier</h2>
            <div id="cart" class="bg-gray-50 p-4 rounded-md shadow-inner">
                <!-- Les articles ajoutés au panier apparaîtront ici -->
            </div>
        </div>

        <!-- Bouton Enregistrer Dette -->
        <div class="mt-6">
            <button id="registerDebt" class="w-full px-4 py-2 bg-indigo-600 text-white rounded-md hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Enregistrer Dette</button>
        </div>
    </div>
</body>
</html>
