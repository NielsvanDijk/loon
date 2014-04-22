<?
class GlasTuinLoontabelSeeder extends Seeder
{
	public function run()
	{
		DB::table('glastuinloontabel')->delete();
		
		Glas::create(array(
			'age' 		=> '15',
			'group' 	=> 'B',
			'value' 	=> '3.536',
		));

		Glas::create(array(
			'age' 		=> '16',
			'group' 	=> 'B',
			'value' 	=> '4.42',
		));

		Glas::create(array(
			'age' 		=> '17',
			'group' 	=> 'B',
			'value' 	=> '5.304',
		));

		Glas::create(array(
			'age' 		=> '18',
			'group' 	=> 'B',
			'value' 	=> '7.072',
		));

		Glas::create(array(
			'age' 		=> '19',
			'group' 	=> 'B',
			'value' 	=> '7.956',
		));
	}
}

?>