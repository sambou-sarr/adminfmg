<h2>Nouvelle tâche assignée</h2>

<p>Bonjour {{ $tache->assignee->name }},</p>

<p>Une nouvelle tâche vient de vous être assignée :</p>

<ul>
    <li><strong>Titre :</strong> {{ $tache->titre }}</li>
    <li><strong>Description :</strong> {{ $tache->description }}</li>
    <li><strong>Date limite :</strong> {{ $tache->due_date }}</li>
    <li><strong>Priorité :</strong> {{ $tache->priorite }}</li>
    <li><strong>Statut :</strong> {{ $tache->statut }}</li>
</ul>

<p>Merci.</p>
