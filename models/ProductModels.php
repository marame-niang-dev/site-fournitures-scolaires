<?php
// models/ProductModel.php

class ProductModel {
    private $pdo;

    public function __construct() {
        // Remplacez 'root' et le mot de passe selon votre configuration (ex: MAMP, XAMPP)
        try {
            $this->pdo = new PDO('mysql:host=localhost;dbname=boutique_scolaire;charset=utf8mb4', 'root', '');
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            die('Erreur de connexion : ' . $e->getMessage());
        }
    }

    public function getAllProducts() {
        $stmt = $this->pdo->query("SELECT * FROM produits");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}