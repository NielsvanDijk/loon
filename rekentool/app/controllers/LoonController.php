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


	public function calculate()
	{
		$input = Input::all();

		$rules = array(
			'salary'	=> 'required|integer',
			'birthday'	=> 'required|date'
		);

		$validation = Validator::make($input, $rules);

		if($validation->passes()){
			$birthDay      = $input['birthday'];
			$birthDate     = strtotime( $birthDay );
			$currentSalary = (float)$input['salary'];
			$age           = date( 'Y' ) - date( 'Y', $birthDate );

			if( date( 'md', date( 'U', $birthDate ) ) > date( 'md' ) )
				$age = $age - 1;

			$result = DB::table('salaries')->where('age', $age)->first();

			if( !empty($result) ){
				$minimumSalary = (float)$result->value;
				return Response::JSON( [
					'success'		=> true,
					'age'			=> $age,
					'difference' 	=> $currentSalary - $minimumSalary
				] );
			} else{
				return Response::JSON( [
					'success'	=> false,
					'errors' 	=> 'no results found'
				] );
			}
		} else{ 
			return Response::JSON( [
				'success'	=> false,
				'errors' 	=> $validation->getMessageBag()->toArray()
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
