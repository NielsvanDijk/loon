<?php

class LoonController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$caos = Caos::all();
		$salaries = Salaries::all();

		return View::make('glastuin.index')
			->with('salaries', $salaries)
			->with('caos', $caos);
	}


	function calculate()
	{
		$birthDay      = Input::get( 'birthday' );
		$birthDate     = strtotime( $birthDay );
		$currentSalary = (float) Input::get( 'salary' );
		$age           = date( 'Y' ) - date( 'Y', $birthDate );

		if( date( 'md', date( 'U', $birthDate ) ) > date( 'md' ) )
			$age = $age - 1;

		$minimumSalary = (float) Salaries::where( 'age', '=', $age )->firstOrFail()->value;

		return Response::JSON( [
			'age'        => $age,
			'difference' => $currentSalary - $minimumSalary
		] );
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
