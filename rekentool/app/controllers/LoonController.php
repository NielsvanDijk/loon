<?php

class LoonController extends BaseController {

	public function postChangeLanguage() 
    {
        $rules = [
        'language' => 'in:nl,po,en,de' //list of supported languages of your application.
        ];

        $language = Input::get('language'); //lang is name of form select field.
		
		// var_dump($language);die;
        
        $validator = Validator::make(compact($language),$rules);

        if($validator->passes())
        {
            Session::put('language',$language);
            App::setLocale($language);
            return Redirect::back();
        }

        else
        
        { return 'test'; }
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$caos 	= array('' => 'Select One') + Caos::lists('name', 'id');

		$days = array('');
		
		for ($i = 1; $i <= 31; $i++) {
			$days[] = $i;
		}

		$months = array('', 'januari', 'februari', 'maart', 'april', 'mei', 'juni', 'juli', 'augustus', 'september', 'oktober', 'november', 'december');

		$years = array('');
		
		for ($i = 1950; $i <= date('Y'); $i++) {
			$years[] = $i;
		}

		return View::make('glastuin.index')
			->with('caos', $caos)
			->with('days', $days)
			->with('months', $months)
			->with('years', $years)
			->with('language',Session::get('language'));


	}

	public function calculate()
	{
		$input = Input::all();

		$data = array(
			'success'			=> false,
			'caoID'				=> '',
			'caoName'			=> '',
			'age'				=> '',
			'wage'				=> '',
			'wageRounded'		=> '',
			'difference'		=> '',
			'differenceRounded'	=> ''
		);

		$age = date('Y') - date('Y', strtotime($input['birthday']));

		if (!empty($input['birthday'])) {
			$data = array_merge($data, array(
				'age' => $age
			));

			$caoResult = DB::table('caos')->where('id', $input['cao'])->first();

			if (null !== $caoResult) {
				$wageResult = DB::table('caos_wage')->where('cao_id', $caoResult->id)->where('age', $age)->first();

				if (null === $wageResult) {
					$wage = (float) $caoResult->wage;
				} else {
					$wage = (float) $caoResult->wage * (float) $wageResult->percent;
				}

				$difference = (float) $wage - (float) $input['salary'];

				$data = array_merge($data, array(
					'success'			=> true,
					'caoID'				=> $caoResult->id,
					'caoName'			=> $caoResult->name,
					'wage'				=> $wage,
					'wageRounded'		=> round($wage, 2),
					'difference' 		=> $difference,
					'differenceRounded'	=> round($difference, 2)
				));
			} else {
				$data = array_merge($data, array(
					'error'	=> 'No CAO selected'
				));
			}
		} else {
			$data = array_merge($data, array(
				'error'	=> 'No birthday selected'
			));
		}

		return Response::JSON($data);

		//$birthDay      	= $input['birthday'];
		//$birthDate     	= strtotime( $birthDay );
		//$currentSalary 	= (float)$input['salary'];
		//$age           	= date( 'Y' ) - date( 'Y', $birthDate );

		// if( date( 'md', date( 'U', $birthDate ) ) > date( 'md' ) )
		// 	$age = $age - 1;

		// $result = DB::table('salaries')->where('age', $age)->where('cao_id', $input['cao'])->first();

		// if( !empty($result) ){
		// 	$minimumSalary = (float)$result->value;
		// 	return Response::JSON( [
		// 		'success'		=> true,
		// 		'age'			=> $age,
		// 		'difference' 	=> $currentSalary - $minimumSalary,
		// 		'cao'			=> $input['cao']
		// 	] );
		// } else{
		// 	return Response::JSON( [
		// 		'success'	=> false,
		// 		'errors' 	=> Lang::get('calculation.Error')
		// 	] );
		// }
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
