<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenue - École La Grâce</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background: linear-gradient(135deg, #04AA6D 0%, #0056b3 100%); min-height: 100vh; display: flex; justify-content: center; align-items: center; color: white; text-align: center; padding: 20px 0; }
        .container { background: rgba(255, 255, 255, 0.1); padding: 50px; border-radius: 15px; backdrop-filter: blur(10px); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.2); max-width: 750px; width: 90%; }
        h1 { font-size: 3rem; margin-bottom: 10px; text-transform: uppercase; letter-spacing: 2px; text-shadow: 2px 2px 4px rgba(0,0,0,0.3); }
        h2 { font-size: 1.5rem; font-weight: 400; margin-bottom: 25px; color: #e3f2fd; }
        p { font-size: 1.1rem; margin-bottom: 35px; opacity: 0.9; line-height: 1.6; }
        .btn-enter { background-color: #ffffff; color: #0056b3; padding: 15px 40px; font-size: 1.2rem; font-weight: bold; text-decoration: none; border-radius: 50px; transition: all 0.3s ease; box-shadow: 0 4px 15px rgba(0,0,0,0.2); display: inline-block; margin-bottom: 40px; }
        .btn-enter:hover { background-color: #333; color: white; transform: translateY(-3px); box-shadow: 0 6px 20px rgba(0,0,0,0.4); }
        .icon { font-size: 4rem; margin-bottom: 20px; display: inline-block; }
        
        .features-divider { border-top: 1px solid rgba(255, 255, 255, 0.2); margin-bottom: 30px; }
        .features-title { font-size: 1.3rem; font-weight: 600; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 1px; color: #e3f2fd; }
        .features-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; text-align: left; }
        .feature-card { background: rgba(255, 255, 255, 0.08); padding: 20px; border-radius: 10px; border: 1px solid rgba(255, 255, 255, 0.1); }
        .feature-icon { font-size: 1.8rem; margin-bottom: 10px; }
        .feature-card h3 { font-size: 1rem; margin-bottom: 8px; color: white; }
        .feature-card p { font-size: 0.85rem; opacity: 0.75; margin-bottom: 0; line-height: 1.4; }
    </style>
</head>
<body>

    <div class="container">
        <div class="icon">🏫</div>
        <h1>École La Grâce</h1>
        <h2>Système de Gestion Scolaire</h2>
        <p>Bienvenue sur votre plateforme de gestion. Suivez facilement les inscriptions des élèves, la scolarité, les matières ainsi que les notes de l'établissement.</p>
        
        <!-- Ce bouton envoie vers la page de Connexion -->
        <a href="{{ route('login') }}" class="btn-enter">Accéder à l'application</a>

        <div class="features-divider"></div>
        <div class="features-title">Fonctionnalités Clés</div>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon">💳</div>
                <h3>Gestion Financière</h3>
                <p>Suivi complet des frais de scolarité, enregistrement des versements et impression des reçus officiels en format PDF.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📝</div>
                <h3>Suivi Pédagogique</h3>
                <p>Saisie sécurisée des notes par matière, calcul automatique des moyennes trimestrielles et classement des élèves.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon">📊</div>
                <h3>Tableau de Bord</h3>
                <p>Vue d'ensemble sur l'état des recouvrements des frais et liste instantanée des élèves en retard de paiement.</p>
            </div>
        </div>
    </div>

</body>
</html>
