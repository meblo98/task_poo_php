<?php

class Utilisateur {
    // Attributs
    private $connexion;
    private $nom;
    private $prenom;
    private $motDePasse;
    private $email;

    // Constructeur
    public function __construct($connexion,$nom, $prenom, $motDePasse, $email) {
        $this->connexion=$connexion;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->motDePasse = $motDePasse;
        $this->email = $email;
    }

    
    // Getters et Setters
   
    // Getters

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function getEmail() {
        return $this->email;
    }

    // Setters
    public function setNom($nom) {
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        $this->prenom = $prenom;
    }

    public function setMotDePasse($motDePasse) {
        $this->motDePasse = $motDePasse;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function modifierMotDePasse($nouveauMotDePasse) {
        $this->motDePasse = $nouveauMotDePasse;
        
    }

    public function modifierEmail($nouvelEmail) {
        $this->email = $nouvelEmail;
       
    }

    // Méthode pour ajouter un client dans la base de données
    public function addUser($nom, $prenom, $email, $mot_de_passe) {
        try {
            // Préparation de la requête SQL
            $sql = "INSERT INTO Utilisateur (nom, prenom, email,  mot_de_passe) VALUES (:nom, :prenom, :email,  :mot_de_passe)";
            $stmt = $this->connexion->prepare($sql);
            
            // Liaison des valeurs avec les paramètres de la requête
            $stmt->bindParam(':nom', $nom);
            $stmt->bindParam(':prenom', $prenom);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':mot_de_passe', $mot_de_passe);

            // Exécution de la requête
            $stmt->execute();


        } catch(PDOException $e) {
            // Gérer les erreurs de requête SQL
            echo "Erreur : " . $e->getMessage();
            return false; // Ou une autre gestion d'erreur selon vos besoins
        }
    }

    
    
}

