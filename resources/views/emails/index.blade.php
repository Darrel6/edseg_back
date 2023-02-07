<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <h1>Inscription</h1>
    <p>Bonjour , {{ $data['name'] }}</p>
    <p>Inscription réussie.
        voici vos pass de connexion
    </p>
    <h4>Email : {{ $data['email'] }}</h4>
    <h4>Mot de Passe : {{ Crypt::decrypt($data['password']) }}</h4>
</body>
</html>