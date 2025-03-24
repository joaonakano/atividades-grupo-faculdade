<?php

class Jogo {
    private $jogoNome;
    private $jogoCapa;
    private $jogoRelease;
    private $jogoPublisher;
    private $jogoRating;

    public function __construct($nome, $capa, $release, $publisher, $rating) {
        $this->jogoNome = $nome;
        $this->jogoCapa = $capa;
        $this->jogoRelease = $release;
        $this->jogoPublisher = $publisher;
        $this->jogoRating = $rating;
    }

    public function getNome(){
        return $this->jogoNome;
    }
    
    public function setNome($novoNome){
        $this->jogoNome = $novoNome;
    }
    
    public function getCapa(){
        return $this->jogoCapa;
    }
    
    public function setCapa($novaCapa){
        $this->jogoCapa = $novaCapa;
    }
    
    public function getRelease(){
        return $this->jogoRelease;
    }
    
    public function setRelease($novaRelease){
        $this->jogoRelease = $novaRelease;
    }
    
    public function getPublisher(){
        return $this->jogoPublisher;
    }
    
    public function setPublisher($novaPublisher){
        $this->jogoPublisher = $novaPublisher;
    }
    
    public function getRating(){
        return $this->jogoRating;
    }

    public function setRating($novaRating){
        $this->jogoRating = $novaRating;
    }
}