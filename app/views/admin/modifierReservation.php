<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Modifier Réservation</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-100 min-h-screen flex items-center justify-center">

    <form method="POST" action="/location_voiture_mvc/public/modifier_reservation?id=<?= $id ?>" class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md">

        <h2 class="text-2xl font-extrabold text-center mb-6 text-slate-800">
            Modifier la réservation
        </h2>

   
        <div class="mb-4">
            <label class="block text-sm font-bold text-slate-600 mb-1">
                Date de début
            </label>
            <input type="date" name="date_debut"
                   value="<?= $reservation['dateDebut'] ?>"
                   class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   required>
        </div>

 
        <div class="mb-4">
            <label class="block text-sm font-bold text-slate-600 mb-1">
                Date de fin
            </label>
            <input type="date" name="date_fin"
                   value="<?= $reservation['dateFin'] ?>"
                   class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   required>
        </div>

  
        <div class="mb-4">
            <label class="block text-sm font-bold text-slate-600 mb-1">
                Lieu de prise
            </label>
            <input type="text" name="lieu_prise"
                   value="<?= $reservation['lieuPrise'] ?>"
                   class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500"
                   required>
        </div>

    
        <div class="mb-6">
            <label class="block text-sm font-bold text-slate-600 mb-1">
                Statut
            </label>
            <select name="status"
                    class="w-full border border-slate-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500">
                <option value="en attente"
                    <?= $reservation['status'] === 'en attente' ? 'selected' : '' ?>>
                    En attente
                </option>
                <option value="confirmée"
                    <?= $reservation['status'] === 'confirmée' ? 'selected' : '' ?>>
                    Confirmée
                </option>
            </select>
        </div>
        <input type="text" name="id_vehicule" value="<?=$reservation['id_vehicule'] ?>" class="hidden"/>

   
        <div class="flex gap-3">
            <a href="reservations.php"
               class="w-1/2 text-center bg-slate-200 text-slate-700 py-2 rounded-lg font-semibold hover:bg-slate-300">
                Annuler
            </a>
            <button type="submit" name="modifier"
                class="w-1/2 bg-indigo-600 text-white py-2 rounded-lg font-semibold hover:bg-indigo-700">
                Enregistrer
            </button>
        </div>

    </form>

</body>
</html>
