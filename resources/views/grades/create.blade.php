<!DOCTYPE html> 
<html lang="fr"> 
<head> 
    <meta charset="UTF-8"> 
    <title>Saisir une note</title> 
    <style> 
        .form-group { margin-bottom: 15px; } 
        label { display: block; margin-bottom: 5px; font-weight: bold; } 
        input, select { width: 100%; padding: 8px; box-sizing: border-box; } 
        .btn { padding: 10px 15px; color: white; border: none; cursor: pointer; text-decoration: none; border-radius: 3px; } 
        .btn-submit { background-color: green; } 
        .btn-back { background-color: gray; } 
    </style> 
</head> 
<body> 
    <h1>Saisir une nouvelle note</h1> 
    
    <form action="{{ route('grades.store') }}" method="POST"> 
        @csrf 
        
        <div class="form-group"> 
            <label for="student_id">Élève</label> 
            <select name="student_id" id="student_id" required> 
                <option value="">-- Choisir un élève --</option> 
                @foreach($students as $student) 
                    <!-- Ajout de l'identifiant de la classe en attribut de données -->
                    <option value="{{ $student->id }}" data-classroom="{{ $student->classroom_id }}">
                        {{ $student->first_name }} {{ $student->last_name }} ({{ $student->classroom->name ?? 'Sans classe' }})
                    </option> 
                @endforeach 
            </select> 
        </div> 
        
        <div class="form-group"> 
            <label for="subject_id">Matière</label> 
            <select name="subject_id" id="subject_id" required> 
                <option value="">-- Choisir une matière --</option> 
                @foreach($subjects as $subject) 
                    <!-- Ajout de l'identifiant de la classe pour le filtrage -->
                    <option value="{{ $subject->id }}" data-classroom="{{ $subject->classroom_id }}">
                        {{ $subject->name }}
                    </option> 
                @endforeach 
            </select> 
        </div> 
        
        <div class="form-group"> 
            <label for="quarter">Trimestre</label> 
            <select name="quarter" id="quarter" required> 
                <option value="1">Trimestre 1</option> 
                <option value="2">Trimestre 2</option> 
                <option value="3">Trimestre 3</option> 
            </select> 
        </div> 
        
        <div class="form-group"> 
            <label for="score">Note (Sur 20)</label> 
            <input type="number" name="score" id="score" min="0" max="20" step="0.25" required> 
        </div> 
        
        <button type="submit" class="btn btn-submit">Enregistrer la note</button> 
        <a href="{{ route('grades.index') }}" class="btn btn-back">Retour</a> 
    </form> 

    <!-- Script JavaScript pour filtrer dynamiquement les matières -->
    <script>
    document.getElementById('student_id').addEventListener('change', function() {
        var selectedStudent = this.options[this.selectedIndex];
        var classroomId = selectedStudent.getAttribute('data-classroom');
        
        var subjectSelect = document.getElementById('subject_id');
        var subjectOptions = subjectSelect.options;
        
        // Réinitialise la sélection de la matière
        subjectSelect.value = "";
        
        for (var i = 0; i < subjectOptions.length; i++) {
            if (subjectOptions[i].value === "") continue;
            
            var subjectClassroomId = subjectOptions[i].getAttribute('data-classroom');
            
            // Si la matière appartient à la classe de l'élève, on l'affiche, sinon on la masque
            if (subjectClassroomId === classroomId) {
                subjectOptions[i].style.display = 'block';
                subjectOptions[i].disabled = false;
            } else {
                subjectOptions[i].style.display = 'none';
                subjectOptions[i].disabled = true;
            }
        }
    });
    </script>
</body> 
</html>
