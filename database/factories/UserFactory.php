<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => "admin",
            'email' => "admin@gmail.com",
            'email_verified_at' => now(),
            'password' => '$2a$12$eYqLOKd8hosiMFpOm/yUa.v6K/GAFfbRXflcj6JLQHIX3wB8j.1.q', // password
            'remember_token' => Str::random(10),
            'role' => 'admin',
            'prenom' => "",
            'annee' => "",
            'npi' => "",
            'identifiant' => "",
            'matricule' => "",
            'date_naiss' => now(),
            'lieu_naiss' => "",
            'nationality' => "",
            'entite' => "",
            'specialite' => "",
            'status' => "",
            'mention' => "",
            'reference' => "",
            'num_transaction' => "",
            'date_paiement' =>  now(),
            'montant' => "",
            'fiche_preinscri' => "",
            'recu_paiement' => "",
            'piece_identite' => "",
            'phone' => "",
            'wphone' => "",
            'paiement_status' =>  "",
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => "",
            ];
        });
    }
}