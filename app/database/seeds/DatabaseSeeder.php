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

        $this->call('ConfigurationsTableSeeder');
        $this->call('PermissionsTableSeeder');
        $this->call('CompaniesTableSeeder');

		$this->call('DepartmentsTableSeeder');
		$this->call('UsersTableSeeder');
		$this->call('ProfilesTableSeeder');
        $this->call('PermissionUserTableSeeder');

        $this->call('BanksTableSeeder');
        $this->call('ChequesTableSeeder');

		$this->call('ProvidersTableSeeder');
		$this->call('ProviderContactsTableSeeder');
		$this->call('ProviderPhonesTableSeeder');
		$this->call('ProviderBanksTableSeeder');

		$this->call('CategoriesTableSeeder');
		$this->call('MarksTableSeeder');
		$this->call('ProductsTableSeeder');
		$this->call('ProductDescriptionsTableSeeder');
		$this->call('InventoryMovementsTableSeeder');
		$this->call('SeriesTableSeeder');

		$this->call('PurchasesTableSeeder');
		$this->call('PurchasePaymentsTableSeeder');

		$this->call('CustomersTableSeeder');

		//$this->call('SalesTableSeeder');
	}

}
