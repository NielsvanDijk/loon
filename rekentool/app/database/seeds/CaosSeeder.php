<?
class CaosSeeder extends Seeder
{
	public function run()
	{
		DB::table('caos')->truncate();

		Caos::create(array(
			'name' 			=> 'Glas en Tuinbouw',
			'duration' 		=> '38'
		));
		
	}
}

?>