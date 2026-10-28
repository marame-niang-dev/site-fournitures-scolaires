<?php
// controllers/HomeController.php
require_once __DIR__ . '/../models/ProductModels.php';

class HomeController {
    public function index() {
        $productModel = new ProductModel();
        $produits = $productModel->getAllProducts();

        // On inclut la vue en lui passant les produits
        require_once __DIR__ . '/../views/catalog.php';
    }
}