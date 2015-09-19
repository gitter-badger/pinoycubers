<?php

use App\Profile;
use App\User;
use App\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

        DB::table('user_roles')->delete();

        DB::table('user_roles')->insert(array(
            array('name' => 'admin'),
            array('name' => 'user'),
        ));

        $this->command->info('User roles table seeded');

        // Using the eloquent model User to create a user row
        $user = array(
            'aivan' => User::create(array(
                    'email' => 'aivan@pinoycubers.org',
                    'password' => Hash::make('password'),
                    'first_name'  => 'Aivan',
                    'last_name' => 'Monceller',
                    'role_id' => UserRole::$ADMIN
                )),
            'dan' => User::create(array(
                    'email' => 'dan@pinoycubers.org',
                    'password' => Hash::make('password'),
                    'first_name'  => 'Dan',
                    'last_name' => 'Belza',
                    'role_id' => UserRole::$ADMIN
                )),
            'omar' => User::create(array(
                    'email' => 'omar@pinoycubers.org',
                    'password' => Hash::make('password'),
                    'first_name' => 'Omar',
                    'last_name' => 'Lozada',
                    'role_id' => UserRole::$ADMIN
                ))
        );

        $this->command->info('User table seeded');

        // Using the eloquent model Profile to create a profile row
        Profile::create(array(
            'user_id' => $user['aivan']->id,
            'username' => 'geocine'
        ));

        Profile::create(array(
            'user_id' => $user['dan']->id,
            'username' => 'dlndn'
        ));

        Profile::create(array(
            'user_id' => $user['omar']->id,
            'username' => 'omar'
        ));

        $this->command->info('Profile table seeded');

        Model::reguard();
	}

}