<?php

//use Illuminate\Auth\UserInterface;
//use Illuminate\Auth\Reminders\RemindableInterface;

class Caos extends Eloquent{

	protected $table = 'caos';
	
	function salaries(){
		return $this->hasMany('Salaries');
	}
}