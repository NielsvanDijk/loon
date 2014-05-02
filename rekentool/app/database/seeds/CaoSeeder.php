<?
class CaoSeeder extends Seeder
{
	public function run()
	{
		DB::table('cao')->truncate();

		Cao::create(array(
			'name' 			=> 'Glas en Tuinbouw',
			'duration' 		=> '38'
		));
		
	}
}

?>