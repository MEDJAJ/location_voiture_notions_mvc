

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Véhicule</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center">

<div class="bg-white w-full max-w-3xl p-8 rounded-2xl shadow-lg">

    <h2 class="text-2xl font-bold mb-6 text-slate-800">
        Modifier le véhicule
    </h2>

    <form action="/location_voiture_mvc/public/modifier_vehicule?id=<?= $vehicule['id_vehicule'] ?>" method="POST" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">

  
        <div>
            <label class="text-sm font-semibold">Modèle</label>
            <input name="modele" value="<?= htmlspecialchars($vehicule['modele']) ?>"
                   class="w-full border p-3 rounded-xl">
        </div>

     
        <div>
            <label class="text-sm font-semibold">Marque</label>
            <input name="marque" value="<?= htmlspecialchars($vehicule['marque']) ?>"
                   class="w-full border p-3 rounded-xl">
        </div>

    
        <div>
            <label class="text-sm font-semibold">Prix journalier (€)</label>
            <input name="prix" type="number" value="<?= $vehicule['prix'] ?>"
                   class="w-full border p-3 rounded-xl">
        </div>

      
        <div>
            <label class="text-sm font-semibold">Disponibilité</label>
            <select name="disponible" class="w-full border p-3 rounded-xl">
                <option value="1" <?= $disponibilite['disponibilite'] == 1 ? 'selected' : '' ?>>
                    Disponible
                </option>
                <option value="0" <?= $disponibilite['disponibilite'] == 0 ? 'selected' : '' ?>>
                    Indisponible
                </option>
            </select>
        </div>

      
        <div>
            <label class="text-sm font-semibold">Catégorie</label>
            <select name="categorie" class="w-full border p-3 rounded-xl">
                <?php foreach ($categories as $cat): ?>
                    <option value="<?= $cat['id_categorie'] ?>"
                        <?= $cat['id_categorie'] == $vehicule['id_categorie'] ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['nom']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

   
        <div>
            <label class="text-sm font-semibold">Image</label>
            <input type="file" name="image" class="w-full border p-2 rounded-xl">
        </div>

       
        <div class="md:col-span-2 flex justify-between mt-6">
            <a href="vehicules.php"
               class="bg-slate-200 text-slate-700 px-6 py-3 rounded-xl font-bold">
                Annuler
            </a>

            <button type="submit" class="bg-indigo-600 text-white px-8 py-3 rounded-xl font-bold hover:bg-indigo-700">
                Enregistrer
            </button>
        </div>

    </form>
</div>

</body>
</html>
