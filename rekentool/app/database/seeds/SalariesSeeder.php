<?
class SalariesSeeder extends Seeder
{
	public function run()
	{
		DB::table('salaries')->truncate();
		
		Salaries::create(array(
			'cao_id' 		=> '1',
			'age' 			=> '15',
			'catagory' 		=> 'B',
			'value' 		=> '3.536'
		));

		Salaries::create(array(
			'cao_id' 		=> '1',
			'age' 			=> '16',
			'catagory' 		=> 'B',
			'value' 		=> '4.42'
		));

		Salaries::create(array(
			'cao_id' 		=> '1',
			'age' 			=> '17',
			'catagory' 		=> 'B',
			'value' 		=> '5.304'
		));

		Salaries::create(array(
			'cao_id' 		=> '1',
			'age' 			=> '18',
			'catagory' 		=> 'B',
			'value' 		=> '7.072'
		));

		Salaries::create(array(
			'cao_id' 		=> '1',
			'age' 			=> '19',
			'catagory' 		=> 'B',
			'value' 		=> '3.536'
		));

		Salaries::create(array(
			'cao_id' 		=> '1',
			'age' 			=> '20',
			'catagory' 		=> 'B',
			'value' 		=> '4.42'
		));

		Salaries::create(array(
			'cao_id' 		=> '1',
			'age' 			=> '21',
			'catagory' 		=> 'B',
			'value' 		=> '5.304'
		));

		Salaries::create(array(
			'cao_id' 		=> '1',
			'age' 			=> '22',
			'catagory' 		=> 'B',
			'value' 		=> '7.072'
		));
	}
}

?>