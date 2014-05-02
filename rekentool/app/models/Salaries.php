<?php

//use Illuminate\Auth\UserInterface;
//use Illuminate\Auth\Reminders\RemindableInterface;

class Salaries extends Eloquent{

	protected $table = 'salaries';
	
	function caos(){
		return $this->belongsTo('caos');
	}

}