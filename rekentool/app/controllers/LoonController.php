<?php

class LoonController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$caos = Caos::lists('name', 'id');
		$salaries = Salaries::all();

		return View::make('glastuin.index')
			->with('salaries', $salaries)
			->with('caos', $caos);
	}


	public function calculate()
	{
		$input = Input::all();

		$birthDay      	= $input['birthday'];
		$birthDate     	= strtotime( $birthDay );
		$currentSalary 	= (float)$input['salary'];
		$age           	= date( 'Y' ) - date( 'Y', $birthDate );
		$cao 			= $input['cao'];

		if( date( 'md', date( 'U', $birthDate ) ) > date( 'md' ) )
			$age = $age - 1;

		$result = DB::table('salaries')->where('age', $age)->where('cao_id', $cao)->first();

		if( !empty($result) ){
			$minimumSalary = (float)$result->value;
			return Response::JSON( [
				'success'		=> true,
				'age'			=> $age,
				'difference' 	=> $currentSalary - $minimumSalary,
				'cao'			=> $cao
			] );
		} else{
			return Response::JSON( [
				'success'	=> false,
				'errors' 	=> 'No results found'
			] );
		}
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


}
