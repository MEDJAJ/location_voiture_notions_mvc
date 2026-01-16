
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MaBagnole </title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700&display=swap');
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .sidebar-gradient {
            background: linear-gradient(180deg, #0f172a 0%, #1e1b4b 100%);
        }
    </style>
</head>

<body class="bg-[#f8fafc] flex min-h-screen text-slate-900">

<aside class="w-72 sidebar-gradient text-white flex flex-col shadow-2xl overflow-hidden sticky top-0 h-screen">
    <div class="p-8">
        <div class="flex items-center gap-3 mb-10">
            <div class="bg-indigo-500 p-2 rounded-xl shadow-lg shadow-indigo-500/50">
                <i class="fas fa-car-side text-2xl"></i>
            </div>
            <span class="text-xl font-bold tracking-tight">MaBagnole <span class="text-indigo-400">Pro</span></span>
        </div>

        <nav class="space-y-2">
            <a href="/location_voiture_mvc/public/statistique" class="flex items-center gap-4 p-3 rounded-xl transition-all duration-200 hover:bg-white/10 group">
                <i class="fas fa-chart-pie text-slate-400 group-hover:text-indigo-400"></i>
                <span class="font-medium">Statistiques</span>
            </a>
            <a href="/location_voiture_mvc/public/vehicule_categorie_admin" class="flex items-center gap-4 p-3 rounded-xl transition-all duration-200 hover:bg-white/10 group">
                <i class="fas fa-car text-slate-400 group-hover:text-indigo-400"></i>
                <span class="font-medium">Véhicules</span>
            </a>
            <a href="/location_voiture_mvc/public/categorie" class="flex items-center gap-4 p-3 rounded-xl transition-all duration-200 hover:bg-white/10 group">
                <i class="fas fa-tags text-slate-400 group-hover:text-indigo-400"></i>
                <span class="font-medium">Catégories</span>
            </a>
            <a href="/location_voiture_mvc/public/reservations" class="flex items-center gap-4 p-3 rounded-xl transition-all duration-200 hover:bg-white/10 group">
                <i class="fas fa-calendar-check text-slate-400 group-hover:text-indigo-400"></i>
                <span class="font-medium">Réservations</span>
            </a>
            <a href="/location_voiture_mvc/public/afficher_avis" class="flex items-center gap-4 p-3 rounded-xl bg-indigo-600 shadow-lg shadow-indigo-600/30 font-semibold">
                <i class="fas fa-star text-white"></i>
                <span>Avis Clients</span>
            </a>
        </nav>
    </div>

    <div class="mt-auto p-6 border-t border-white/10">
        <a href="/location_voiture_mvc/public/logout">
               <button class="flex items-center gap-4 w-full p-3 rounded-xl bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white transition-all duration-300">
            <i class="fas fa-sign-out-alt"></i>
            <span class="font-bold uppercase text-xs tracking-widest">Déconnexion</span>
        </button>
        </a>
     
    </div>
</aside>

<main class="flex-1 p-10 overflow-y-auto">

    <header class="flex justify-between items-center mb-10">
        <div>
            <h2 class="text-3xl font-extrabold text-slate-800 tracking-tight">Réputation & Avis</h2>
            <p class="text-slate-500 mt-1">Modérez les retours clients et analysez la satisfaction.</p>
        </div>
        <div class="flex items-center gap-4">
            <div class="flex flex-col items-end">
                <span class="text-xs font-bold text-slate-400 uppercase">Note Moyenne</span>
                <div class="flex text-yellow-400 text-sm">
                    <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                    <span class="ml-2 text-slate-800 font-bold">4.8/5</span>
                </div>
            </div>
              <button class="w-10 h-10 rounded-full bg-indigo-100 text-indigo-600 font-bold"><?= $nom[0].$nom[1]  ?></button>
        </div>
    </header>


    <h3 class="text-2xl font-bold text-slate-800 mb-8">Flux des Avis</h3>

    <div class="grid grid-cols-1 gap-6">


<?php
if(count($avis)>0){

foreach($avis as $avi){


if($avi['deleted_at']==1){



?>



        <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100 hover:shadow-xl transition-all duration-300 flex flex-wrap md:flex-nowrap gap-6 items-center group">
            <div class="flex-shrink-0">
                <div class="w-16 h-16 rounded-2xl bg-indigo-50 flex items-center justify-center text-indigo-600 text-2xl font-black shadow-inner">
                    <?=  $avi['nom'][0]   ?>
                </div>
            </div>
            
            <div class="flex-1">
                <div class="flex items-center gap-3 mb-1">
                    <h4 class="font-bold text-lg text-slate-800"><?= $avi['nom'] ?></h4>
                    <span class="bg-emerald-50 text-emerald-600 text-[10px] font-black px-2 py-1 rounded-md border border-emerald-100">VISIBLE</span>
                </div>
                <p class="text-xs font-bold text-indigo-500 uppercase tracking-tighter mb-2">Loué : <?= $avi['modele']."  -- ".$avi['marque'] ?></p>
                <div class="flex text-yellow-400 text-xs mb-3">
                    <?php
if($avi['note']==1){
echo "⭐";
}elseif($avi['note']==2){
    echo "⭐⭐";
}elseif($avi['note']==3){
    echo "⭐⭐⭐";
}elseif($avi['note']==4){
    echo "⭐⭐⭐⭐";
}else{
     echo "⭐⭐⭐⭐⭐";
}

?>
                </div>
                <p class="text-slate-600 text-sm italic leading-relaxed">
                    <?=  $avi['content'] ?>
                </p>
            </div>

            <div class="flex md:flex-col gap-2 opacity-0 group-hover:opacity-100 transition-all">
                <a href="/location_voiture_mvc/public/modifier_avi?id=<?=  $avi['id_avis'] ?>">
                    <button title="Modifier" class="w-10 h-10 flex items-center justify-center bg-slate-50 text-slate-400 rounded-xl hover:bg-indigo-600 hover:text-white transition-all">
                    <i class="fas fa-edit text-sm"></i>
                </button>
                </a>

                <a href="/location_voiture_mvc/public/supprimer_avi?id=<?=  $avi['id_avis'] ?>">
                    <button title="Supprimer" class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-400 rounded-xl hover:bg-red-500 hover:text-white transition-all">
                    <i class="fas fa-trash-alt text-sm"></i>
                </button>
                </a>
                
            </div>
        </div>

        <?php   }else{

        ?>




 <div class="bg-gray-200 text-gray-400 p-6 rounded-[2rem] shadow-sm border border-gray-300 flex flex-wrap md:flex-nowrap gap-6 items-center pointer-events-none">
    <div class="flex-shrink-0">
        <div class="w-16 h-16 rounded-2xl bg-gray-300 flex items-center justify-center text-gray-500 text-2xl font-black shadow-inner">
            <?= $avi['nom'][0] ?>
        </div>
    </div>

    <div class="flex-1">
        <div class="flex items-center gap-3 mb-1">
            <h4 class="font-bold text-gray-500 text-lg"><?= $avi['nom'] ?></h4>
            <span class="bg-gray-400 text-white text-[10px] font-black px-2 py-1 rounded-md border border-gray-300">MASQUÉ</span>
        </div>
        <p class="text-xs font-bold text-gray-500 uppercase tracking-tighter mb-2">
            Loué : <?= $avi['modele']."  --  ".$avi['marque'] ?>
        </p>
        <div class="flex text-yellow-300 text-xs mb-3">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
        </div>
        <p class="text-gray-500 text-sm italic leading-relaxed">
            <?= $avi['content'] ?>
        </p>
    </div>

    <div class="flex md:flex-col gap-2 opacity-100 pointer-events-auto">
        <a href="/location_voiture_mvc/public/restaurer_avi?id=<?=  $avi['id_avis'] ?>">
               <button title="Voir" class="w-10 h-10 flex items-center justify-center bg-red-50 text-red-400 rounded-xl hover:bg-red-500 hover:text-white transition-all">
            <i class="fas fa-eye text-lg"></i>
        </button>
        </a>
     
    </div>
</div>





<?php  }}  }  ?>

     



    </div>
</main>

</body>
</html>