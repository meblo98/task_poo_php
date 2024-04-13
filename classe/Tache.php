<?php

class Tache {
    // Attributs
    private $connexion;
    private $libelle;
    private $description;
    private $dateEcheance;
    private $priorite; 
    private $etat; 
    private $idUtilisateur;

    // Constructeur
    public function __construct($connexion, $libelle, $description, $dateEcheance, $priorite, $etat, $idUtilisateur) {
        $this->connexion=$connexion;
        $this->libelle = $libelle;
        $this->description = $description;
        $this->dateEcheance = $dateEcheance;
        $this->priorite = $priorite;
        $this->etat = $etat;
        $this->idUtilisateur = $idUtilisateur;
    }

    // Méthodes

    // Getters
   
    public function getLibelle() {
        return $this->libelle;
    }

    public function getDescription() {
        return $this->description;
    }

    public function getDateEcheance() {
        return $this->dateEcheance;
    }

    public function getPriorite() {
        return $this->priorite;
    }

    public function getEtat() {
        return $this->etat;
    }

    public function getIdUtilisateur() {
        return $this->idUtilisateur;
    }

    // Setters
    public function setLibelle($libelle) {
        $this->libelle = $libelle;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function setDateEcheance($dateEcheance) {
        $this->dateEcheance = $dateEcheance;
    }

    public function setPriorite($priorite) {
        $this->priorite = $priorite;
    }

    public function setEtat($etat) {
        $this->etat = $etat;
    }

    public function setIdUtilisateur($idUtilisateur) {
        $this->idUtilisateur = $idUtilisateur;
    }

    //methode pour créer une tache 
    public function creerTache($libelle, $description, $dateEcheance, $priorite,$etat, $idUtilisateur) {
        try {
            // Requête SQL pour insérer une nouvelle tâche dans la base de données
            $sql = "INSERT INTO Tache (libelle, description, date_echeance, priorite,etat, id_utilisateur) VALUES (?, ?, ?, ?, ?,?)";
            
            // Préparation de la requête
            $stmt = $this->connexion->prepare($sql);
    
            // Liaison des paramètres
            $stmt->bindParam(1, $libelle);
            $stmt->bindParam(2, $description);
            $stmt->bindParam(3, $dateEcheance);
            $stmt->bindParam(4, $priorite);
            $stmt->bindParam(5, $etat);
            $stmt->bindParam(6, $idUtilisateur);
    
            // Exécution de la requête
            $stmt->execute();
    
        } catch (PDOException $e) {
            // En cas d'erreur, affiche le message d'erreur
            echo "Erreur lors de la création de la tâche : " . $e->getMessage();
            return false;
        }
    }

    // //liste des taches à faire

    public function afficherTachesEnAttente($idUtilisateur) {
        try {
            // Requête SQL pour sélectionner les tâches à faire de l'utilisateur actuel
            $sql = "SELECT * FROM Tache WHERE etat = 'à faire' AND id_utilisateur = ?";
            $stmt = $this->connexion->prepare($sql);
            $stmt->execute([$idUtilisateur]);
            $taches_todo = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $taches_todo;

        } catch (PDOException $e) {
            // En cas d'erreur, affichez le message d'erreur
            echo "Erreur lors de la récupération des tâches à faire : " . $e->getMessage();
        }
    }
    
    public function afficherTachesEnCours($idUtilisateur) {
        try {
            // Requête SQL pour sélectionner les tâches en cours de l'utilisateur actuel
            $sql = "SELECT * FROM Tache WHERE etat = 'en cours' AND id_utilisateur = ?";
            $stmt = $this->connexion->prepare($sql);
            $stmt->execute([$idUtilisateur]);
            $taches_en_cours = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $taches_en_cours;
    
        } catch (PDOException $e) {
            // En cas d'erreur, affichez le message d'erreur
            echo "Erreur lors de la récupération des tâches en cours : " . $e->getMessage();
        }
    }
    public function afficherTachesTerminees($idUtilisateur) {
        try {
            // Requête SQL pour sélectionner les tâches terminées de l'utilisateur actuel
            $sql = "SELECT * FROM Tache WHERE etat = 'terminée' AND id_utilisateur = ?";
            $stmt = $this->connexion->prepare($sql);
            $stmt->execute([$idUtilisateur]);
            $taches_terminees = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $taches_terminees;
    
        } catch (PDOException $e) {
            // En cas d'erreur, affichez le message d'erreur
            echo "Erreur lors de la récupération des tâches terminées : " . $e->getMessage();
        }
    }
   
         // Méthode pour mettre à jour une tâche
    public function mettreAJourTache($taskId, $libelle, $description, $dateEcheance, $priorite, $etat) {
        try {
            $sql = "UPDATE Tache SET libelle=:libelle, description=:description, date_echeance=:date_echeance, priorite=:priorite, etat=:etat WHERE id=:id";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(':libelle', $libelle);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':date_echeance', $dateEcheance);
            $stmt->bindParam(':priorite', $priorite);
            $stmt->bindParam(':etat', $etat);
            $stmt->bindParam(':id', $taskId);
            $stmt->execute();
            
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la mise à jour de la tâche : " . $e->getMessage());
        }
    }
    

    //supprimer une tache

    public function supprimerTache($idTache) {
        try {
            // Requête SQL pour supprimer une tâche
            $sql = "DELETE FROM Tache WHERE id = ?";
            
            // Préparation de la requête
            $stmt = $this->connexion->prepare($sql);
    
            // Liaison du paramètre
            $stmt->bindParam(1, $idTache);
    
            // Exécution de la requête
            $stmt->execute();
        } catch (PDOException $e) {
            // En cas d'erreur, affiche le message d'erreur
            echo "Erreur lors de la suppression de la tâche : " . $e->getMessage();
        }
    }
    // Méthode pour récupérer les détails d'une tâche par son ID
    public function TacheParId($taskId) {
        try {
            $sql = "SELECT * FROM Tache WHERE id = ?";
            $stmt = $this->connexion->prepare($sql);
            $stmt->bindParam(1, $taskId, PDO::PARAM_INT);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result;
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération des détails de la tâche : " . $e->getMessage());
        }
}


    
}

