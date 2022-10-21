<?php

class profissionalModel {
    
    private $id_pro;
	private $id_login_pro;
	private $id_serv_pro;
    private $nome_pro;
	private $cpf_pro;
	private $data_nascimento_pro;
	private $data_cadastro_pro;
	private $escolaridade_pro;
	private $endereco_pro;
	private $cep_pro;
	private $bairro_pro;
	private $cidade_pro;
	private $estado_pro;
	private $resumo_experiencia_pro;
	private $telefone_pro;
	private $email_pro;
   
            
    function getId_pro() {
        return $this->id_pro;
    }
	
	function getId_login_pro() {
        return $this->id_login_pro;
    }
	
	function getId_serv_pro() {
        return $this->id_serv_pro;
    }

    function getNome_pro() {
        return $this->nome_pro;
    }
	
	function getCpf_pro() {
        return $this->cpf_pro;
    }
	
	function getData_nascimento_pro() {
        return $this->data_nascimento_pro;
    }
	
	 function getData_cadastro_pro() {
        return $this->data_cadastro_pro;
    }
	
		function getEscolaridade_pro() {
        return $this->escolaridade_pro;
    }
	
		function getEndereco_pro() {
        return $this->endereco_pro;
    }
	
	function getCep_pro() {
        return $this->cep_pro;
    }
	
	function getBairro_pro() {
        return $this->bairro_pro;
    }
	
	function getCidade_pro() {
        return $this->cidade_pro;
    }
	
	function getEstado_pro() {
        return $this->estado_pro;
    }
	
	function getResumo_experiencia_pro() {
        return $this->resumo_experiencia_pro;
    }
	
	function getTelefone_pro() {
        return $this->telefone_pro;
    }
	
	function getEmail_pro() {
        return $this->email_pro;
    }
	
	



    function setId_pro($id_pro) {
        $this->id_pro = $id_pro;
    }
	
	function setId_login_pro($id_login_pro) {
        $this->id_login_pro = $id_login_pro;
    }
	
	function setId_serv_pro($id_serv_pro) {
        $this->id_serv_pro = $id_serv_pro;
    }

    function setNome_pro($nome_pro) {
        $this->nome_pro = $nome_pro;
    }
	
	function setCpf_pro($cpf_pro) {
        $this->cpf_pro = $cpf_pro;
    }
	
	function setData_nascimento_pro($data_nascimento_pro) {
        $this->data_nascimento_pro = $data_nascimento_pro;
    }
	
	function setData_cadastro_pro($data_cadastro_pro) {
        $this->data_cadastro_pro = $data_cadastro_pro;
    }
	
	function setEscolaridade_pro($escolaridade_pro) {
        $this->escolaridade_pro = $escolaridade_pro;
    }
	
	function setEndereco_pro($endereco_pro) {
        $this->endereco_pro = $endereco_pro;
    }
	
	function setCep_pro($cep_pro) {
        $this->cep_pro = $cep_pro;
    }
	
	function setBairro_pro($bairro_pro) {
        $this->bairro_pro = $bairro_pro;
    }
	
	function setCidade_pro($cidade_pro) {
        $this->cidade_pro = $cidade_pro;
    }
	
	function setEstado_pro($estado_pro) {
        $this->estado_pro = $estado_pro;
    }
	
	function setResumo_experiencia_pro($resumo_experiencia_pro) {
        $this->resumo_experiencia_pro = $resumo_experiencia_pro;
    }
	
	function setTelefone_pro($telefone_pro) {
        $this->telefone_pro = $telefone_pro;
    }
	
	function setEmail_pro($email_pro) {
        $this->email_pro = $email_pro;
    }
}
