<?php

class clienteModel {
    
    private $id_cli;
	private $id_login_cli;
    private $nome_cli;
	private $data_nascimento_cli;
	private $data_cadastro_cli;
	private $endereco_cli;
	private $cep_cli;
	private $bairro_cli;
	private $cidade_cli;
	private $estado_cli;
	private $telefone_cli;
	private $email_cli;
   
            
    function getId_cli() {
        return $this->id_cli;
    }
	
	function getId_login_cli() {
        return $this->id_login_cli;
    }

    function getNome_cli() {
        return $this->nome_cli;
    }
	
	function getData_nascimento_cli() {
        return $this->data_nascimento_cli;
    }
	
	 function getData_cadastro_cli() {
        return $this->data_cadastro_cli;
    }
	
	function getEndereco_cli() {
        return $this->endereco_cli;
    }
	
	function getCep_cli() {
        return $this->cep_cli;
    }
	
	function getBairro_cli() {
        return $this->bairro_cli;
    }
	
	function getCidade_cli() {
        return $this->cidade_cli;
    }
	
	function getEstado_cli() {
        return $this->estado_cli;
    }
	
	function getTelefone_cli() {
        return $this->telefone_cli;
    }
	
	function getEmail_cli() {
        return $this->email_cli;
    }
	
	



    function setId_cli($id_cli) {
        $this->id_cli = $id_cli;
    }
	
	function setId_login_cli($id_login_cli) {
        $this->id_login_cli = $id_login_cli;
    }

    function setNome_cli($nome_cli) {
        $this->nome_cli = $nome_cli;
    }
	
	function setData_nascimento_cli($data_nascimento_cli) {
        $this->data_nascimento_cli = $data_nascimento_cli;
    }
	
	function setData_cadastro_cli($data_cadastro_cli) {
        $this->data_cadastro_cli = $data_cadastro_cli;
    }
	
	function setEndereco_cli($endereco_cli) {
        $this->endereco_cli = $endereco_cli;
    }
	
	function setCep_cli($cep_cli) {
        $this->cep_cli = $cep_cli;
    }
	
	function setBairro_cli($bairro_cli) {
        $this->bairro_cli = $bairro_cli;
    }
	
	function setCidade_cli($cidade_cli) {
        $this->cidade_cli = $cidade_cli;
    }
	
	function setEstado_cli($estado_cli) {
        $this->estado_cli = $estado_cli;
    }
	
	function setTelefone_cli($telefone_cli) {
        $this->telefone_cli = $telefone_cli;
    }
	
	function setEmail_cli($email_cli) {
        $this->email_cli = $email_cli;
    }
}
