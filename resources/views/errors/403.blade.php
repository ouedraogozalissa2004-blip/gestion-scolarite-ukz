<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accès Refusé - École La Grâce</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background: linear-gradient(135deg, #04AA6D 0%, #0056b3 100%); height: 100vh; display: flex; justify-content: center; align-items: center; color: white; text-align: center; }
        .container { background: rgba(255, 255, 255, 0.1); padding: 50px; border-radius: 15px; backdrop-filter: blur(10px); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.2); max-width: 600px; width: 90%; }
        .error-code { font-size: 5rem; font-weight: bold; color: #ff4d4d; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); margin-bottom: 10px; }
        h1 { font-size: 1.8rem; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px; }
        p { font-size: 1.2rem; margin-bottom: 40px; opacity: 0.9; line-height: 1.6; }
        .btn-back { background-color: #ffffff; color: #0056b3; padding: 12px 30px; font-size: 1rem; font-weight: bold; text-decoration: none; border-radius: 50px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.2); display: inline-block; }
        .btn-back:hover { background-color: #333; color: white; transform: translateY(-2px); }
        .icon { font-size: 4rem; margin-bottom: 10px; display: inline-block; }
    </style>
</head>
<body>

    <div class="container">
        <div class="icon">🛑</div>
        <div class="error-code">403</div>
        <h1>Accès Interdit</h1>
        
        <!-- Le message personnalisé qui s'affichera pour l'enseignant ou le gestionnaire -->
        <p>Vous n'êtes pas éligible pour accéder à cette fonctionnalité.</p>
        
        <a href="/" class="btn-back">Retour à l'accueil</a>
    </div>

</body>
</html>
