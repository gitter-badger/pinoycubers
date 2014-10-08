<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

        DB::table('user_roles')->delete();

        DB::table('user_roles')->insert(
            array(
                array('name' => 'admin'),
                array('name' => 'user'),
            ));

        $this->command->info('User roles table seeded');

        // Using the eloquent model User to create a user row
        User::create(array(
            'email' => 'aivan@pinoycubers.org',
            'password' => Hash::make('password'),
            'first_name'  => 'Aivan',
            'last_name' => 'Monceller',
            'role_id' => UserRole::$ADMIN));
	}

}