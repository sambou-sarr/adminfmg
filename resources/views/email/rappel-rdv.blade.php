<p>Bonjour {{ $rdv->user->prenom }} {{ $rdv->user->name }},</p>

<p>Ceci est un rappel pour votre rendez-vous :</p>

<ul>
    <li><strong>Objet :</strong> {{ $rdv->sujet  }}</li>
    <li><strong>Date :</strong> {{ $rdv->created_at }}</li>
    <li><strong>Description :</strong> {{ $rdv->description }}</li>
</ul>

<p>Merci,<br>L'équipe FMG</p>
