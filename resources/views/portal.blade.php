<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace de Travail - École La Grâce</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
        body { background: linear-gradient(135deg, #04AA6D 0%, #0056b3 100%); min-height: 100vh; display: flex; justify-content: center; align-items: center; color: white; text-align: center; padding: 20px; }
        .container { background: rgba(255, 255, 255, 0.1); padding: 45px; border-radius: 15px; backdrop-filter: blur(10px); box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.3); border: 1px solid rgba(255, 255, 255, 0.2); max-width: 900px; width: 100%; }
        h1 { font-size: 2.8rem; margin-bottom: 5px; text-transform: uppercase; letter-spacing: 1px; text-shadow: 2px 2px 4px rgba(0,0,0,0.2); }
        h2 { font-size: 1.3rem; font-weight: 400; margin-bottom: 30px; color: #e3f2fd; }
        .user-badge { background: rgba(255,255,255,0.15); padding: 10px 20px; border-radius: 50px; font-size: 1rem; display: inline-block; margin-bottom: 35px; border: 1px solid rgba(255,255,255,0.1); }
        
        .menu-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px; margin-bottom: 40px; }
        .menu-card { background: white; color: #333; padding: 25px; border-radius: 12px; text-decoration: none; font-weight: bold; font-size: 1.1rem; box-shadow: 0 4px 15px rgba(0,0,0,0.15); transition: all 0.3s ease; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 12px; border: 2px solid transparent; }
        .menu-card:hover { transform: translateY(-5px); box-shadow: 0 8px 25px rgba(0,0,0,0.3); border-color: #ffeb3b; }
        .menu-icon { font-size: 3rem; }
        .menu-card span { font-size: 1.1rem; color: #2c3e50; }
        .menu-card p { font-size: 0.8rem; color: #7f8c8d; font-weight: normal; margin-top: 5px; line-height: 1.3; }
        
        .btn-logout { background-color: #ff4d4d; color: white; padding: 12px 40px; font-size: 1rem; font-weight: bold; text-decoration: none; border-radius: 50px; transition: all 0.3s ease; display: inline-block; border: none; cursor: pointer; }
        .btn-logout:hover { background-color: #cc0000; }
    </style>
</head>
<body>

    <div class="container">
        <h1>École La Grâce</h1>
        <h2>Panneau de Contrôle Centralisé</h2>

        <div class="user-badge">
            👤 Utilisateur : <strong>{{ Auth::user()->name }}</strong> 
            | Profil : <span style="color: #ffeb3b; font-weight: bold; text-transform: uppercase;">{{ Auth::user()->role }}</span>
        </div>

        <!-- TOUS LES BOUTONS VISIBLES PAR TOUT LE MONDE -->
        <div class="menu-grid">
            
            <a href="{{ route('classrooms.index') }}" class="menu-card">
                <span class="menu-icon">🏫</span>
                <span>Gestion des Classes</span>
                <p>Niveaux scolaires et frais.</p>
            </a>

            <a href="{{ route('students.index') }}" class="menu-card">
                <span class="menu-icon">👨‍🎓</span>
                <span>Gestion des Élèves</span>
                <p>Inscriptions et fiches nominatives.</p>
            </a>

            <a href="{{ route('grades.index') }}" class="menu-card">
                <span class="menu-icon">📝</span>
                <span>Saisie des Notes</span>
                <p>Notes trimestrielles et évaluations.</p>
            </a>

            <a href="{{ route('payments.index') }}" class="menu-card">
                <span class="menu-icon">💳</span>
                <span>Suivi des Paiements</span>
                <p>Versements et reçus PDF.</p>
            </a>

            <a href="{{ route('dashboard') }}" class="menu-card">
                <span class="menu-icon">📊</span>
                <span>Tableau de Bord</span>
                <p>Statistiques financières globales.</p>
            </a>

        </div>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">🚪 Se déconnecter</button>
        </form>
    </div>

</body>
</html>
