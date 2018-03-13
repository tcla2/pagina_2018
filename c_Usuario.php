<?php

  class Usuario
  {
    public $nombre;
    public $apellido;
    public $tipo_id;
    public $id;
    public $fecha_nacimiento;
    public $genero;
    public $estado_civil;
    public $tipo_telefono;
    public $telefono;
    public $email;
    public $tiempo_docencia; 
	public $profile_img; 
    public $estudios_superiores;
	public $especializacion; 
	public $descripcion; 
   
	
	
	

    function __construct($nombre, $apellido, $tipo_id, $id, $fecha_nacimiento, $genero, $estado_civil, $tipo_telefono, $telefono,$email,$tiempo_docencia,$estudios_superiores,$especializacion,$descripcion){
      $this->nombre = $nombre;
      $this->apellido = $apellido;
      $this->tipo_id = $tipo_id;
      $this->id = $id;
      $this->fecha_nacimiento = $fecha_nacimiento;
      $this->genero = $genero;
      $this->estado_civil = $estado_civil;
      $this->tipo_telefono = $tipo_telefono;
      $this->telefono = $telefono;
	  $this->email = $email;
      $this->tiempo_docencia = $tiempo_docencia;
      $this->estudios_superiores = $estudios_superiores;
      $this->especializacion = $especializacion;
      $this->descripcion = $descripcion;
   
   
    }

    function getData(){
      $array['nombre'] = $this->nombre;
      $array['apellido'] = $this->apellido;
      $array['tipo_id'] = $this->tipo_id;
      $array['id'] = $this->id;
      $array['fecha_nacimiento'] = $this->fecha_nacimiento;
      $array['genero'] = $this->genero;
      $array['estado_civil'] = $this->estado_civil;
      $array['tipo_telefono'] = $this->tipo_telefono;
      $array['telefono'] = $this->telefono;
	  $array['email'] = $this->email;
      $array['tiempo_docencia'] = $this->tiempo_docencia;
      $array['estudios_superiores'] = $this->estudios_superiores;
      $array['especializacion'] = $this->especializacion;
      $array['descripcion'] = $this->descripcion;
	  
      return $array;
    }
    
  }


 ?>
