@component('mail::message')
# Demande de {{ $data['category'] }}

<h5>Monsieur le Directeur,</h5>
<p>J'ai l'honneur de soliciter auprès de votre haute bienveillance l'établissement de mon {{ $data['category'] }}</p>
<p>A cet effet, je fournis les renseignements ci-après:</p>
<h6>Nom: {{ $data['name'] }}</h6>
<h6>Prénom(s): {{ $data['prenom'] }}</h6>
<h6>Date et lieu de naissance: {{ $data['date_naiss'] }} à {{ $data['lieu_naiss'] }}</h6>
<h6>Matricule: {{ $data['matricule'] }}</h6>
<h6>Année académique: {{ $data['annee_ac'] }}</h6>
<h6>Année d'études: {{ $data['annee_etude'] }}</h6>
<h6>Date de Soutenance: {{ $data['date_soutenance'] }}</h6>
<h6>Promotion: {{ $data['promotion'] }}</h6>
<h6>Type de formation: {{ $data['formation'] }}</h6>
<p>Dans l'espoir d'une suite favorable à ma requête, je vous prie d'agreér, Monsieur le Directeur, l'expression de mes
    salutations distinguées.</p>
Merci,<br>
{{ config('app.name') }}
@endcomponent
