<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

		$this->call('UsersTableSeeder');
		$this->call('SuppliersTableSeeder');
		$this->call('BillsTableSeeder');
		$this->call('PaymentsTableSeeder');
        $this->call('PaymentMethodsTableSeeder');

        Model::reguard();
	}

}



class UsersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		DB::table('users')->insert([
            'username' => str_random(10),
            'useremail' => 'admin@tastymixbakery.com',
            'userpassword' => bcrypt('password'),
        ]);

        DB::table('users')->insert([
            'username' => str_random(10),
            'useremail' => 'user@tastymixbakery.com',
            'userpassword' => bcrypt('password'),
        ]);
	}

}


class SuppliersTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		DB::table('suppliers')->insert([
            'suppliername' => str_random(10),
            'supplieremail' => str_random(8).'@gmail.com',
            'suppliermobile' => str_random(10),
            'supplierpassword' => bcrypt('password'),
        ]);

        DB::table('suppliers')->insert([
            'suppliername' => str_random(10),
            'supplieremail' => str_random(8).'@gmail.com',
            'suppliermobile' => str_random(10),
            'supplierpassword' => bcrypt('password'),
        ]);

        DB::table('suppliers')->insert([
            'suppliername' => str_random(10),
            'supplieremail' => str_random(8).'@gmail.com',
            'suppliermobile' => str_random(10),
            'supplierpassword' => bcrypt('password'),
        ]);

        DB::table('suppliers')->insert([
            'suppliername' => str_random(10),
            'supplieremail' => str_random(8).'@gmail.com',
            'suppliermobile' => str_random(10),
            'supplierpassword' => bcrypt('password'),
        ]);

        DB::table('suppliers')->insert([
            'suppliername' => str_random(10),
            'supplieremail' => str_random(8).'@gmail.com',
            'suppliermobile' => str_random(10),
            'supplierpassword' => bcrypt('password'),
        ]);
	}

}

class BillsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		DB::table('bills')->insert([
            'description' => str_random(10),
            'billamount' => rand(50000,200000),
            //'paidamount' => 0,
            'supplierid' => rand(1,5),
            'createdbyuserid' => rand(1,2),
            //'status' => 'unpaid',
        ]);

        DB::table('bills')->insert([
            'description' => str_random(10),
            'billamount' => rand(50000,200000),
            //'paidamount' => 0,
            'supplierid' => rand(1,5),
            'createdbyuserid' => rand(1,2),
            //'status' => 'unpaid',
        ]);

        DB::table('bills')->insert([
            'description' => str_random(10),
            'billamount' => rand(50000,200000),
            //'paidamount' => 0,
            'supplierid' => rand(1,5),
            'createdbyuserid' => rand(1,2),
            //'status' => 'unpaid',
        ]);

        DB::table('bills')->insert([
            'description' => str_random(10),
            'billamount' => rand(50000,200000),
            //'paidamount' => 0,
            'supplierid' => rand(1,5),
            'createdbyuserid' => rand(1,2),
            //'status' => 'unpaid',
        ]);

        DB::table('bills')->insert([
            'description' => str_random(10),
            'billamount' => rand(50000,200000),
            //'paidamount' => 0,
            'supplierid' => rand(1,5),
            'createdbyuserid' => rand(1,2),
            //'status' => 'unpaid',
        ]);

        DB::table('bills')->insert([
            'description' => str_random(10),
            'billamount' => rand(50000,200000),
            //'paidamount' => 0,
            'supplierid' => rand(1,5),
            'createdbyuserid' => rand(1,2),
            //'status' => 'unpaid',
        ]);

        DB::table('bills')->insert([
            'description' => str_random(10),
            'billamount' => rand(50000,200000),
            //'paidamount' => 0,
            'supplierid' => rand(1,5),
            'createdbyuserid' => rand(1,2),
            //'status' => 'unpaid',
        ]);

        DB::table('bills')->insert([
            'description' => str_random(10),
            'billamount' => rand(50000,200000),
            //'paidamount' => 0,
            'supplierid' => rand(1,5),
            'createdbyuserid' => rand(1,2),
            //'status' => 'unpaid',
        ]);

        DB::table('bills')->insert([
            'description' => str_random(10),
            'billamount' => rand(50000,200000),
            //'paidamount' => 0,
            'supplierid' => rand(1,5),
            'createdbyuserid' => rand(1,2),
            //'status' => 'unpaid',
        ]);

        DB::table('bills')->insert([
            'description' => str_random(10),
            'billamount' => rand(50000,200000),
            //'paidamount' => 0,
            'supplierid' => rand(1,5),
            'createdbyuserid' => rand(1,2),
            //'status' => 'unpaid',
        ]);

        DB::table('bills')->insert([
            'description' => str_random(10),
            'billamount' => rand(50000,200000),
            //'paidamount' => 0,
            'supplierid' => rand(1,5),
            'createdbyuserid' => rand(1,2),
            //'status' => 'unpaid',
        ]);

        DB::table('bills')->insert([
            'description' => str_random(10),
            'billamount' => rand(50000,200000),
            //'paidamount' => 0,
            'supplierid' => rand(1,5),
            'createdbyuserid' => rand(1,2),
            //'status' => 'unpaid',
        ]);
	}

}

class PaymentsTableSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{

		DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '408 408 408 408 408 1',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '408 408 408 408 408 1',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '408 408 408 408 408 1',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '408 408 408 408 408 1',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '408 408 408 408 408 1',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '408 408 408 408 408 1',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '408 408 408 408 408 1',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '408 408 408 408 408 1',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '408 408 408 408 408 1',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '5060 6666 6666 6666 666',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '5060 6666 6666 6666 666',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '5060 6666 6666 6666 666',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '5060 6666 6666 6666 666',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '5060 6666 6666 6666 666',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '5060 6666 6666 6666 666',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '5060 6666 6666 6666 666',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '5060 6666 6666 6666 666',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '5060 6666 6666 6666 666',
        ]);

        DB::table('payments')->insert([
            'billno' => rand(1,10),
            'paymentamount' => rand(1000,5000),
            'paymentref' => str_random(10),
            'status' => rand(0,2),
            'paymentcardno' => '5060 6666 6666 6666 666',
        ]);
	}

}

class PaymentMethodsTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('paymentmethods')->insert([
            'paymentmethodtype' => 'MASTERCARD',
            'paymentcardno' => '408 408 408 408 408 1',
            'cvv' => '408',
            'cardexpiry' => '2020-12-12 00:00:00',
            'description' => 'No Validation',
        ]);

        DB::table('paymentmethods')->insert([
            'paymentmethodtype' => 'VREVE',
            'paymentcardno' => '5060 6666 6666 6666 666',
            'cvv' => '123',
            'pin' => '1234',
            'cardexpiry' => '2020-12-12 00:00:00',
            'description' => 'PIN+OTP validation',
        ]);

    }

}
