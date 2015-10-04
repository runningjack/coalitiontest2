<?php
/**
 * Created by PhpStorm.
 * User: Amedora
 * Date: 10/4/15
 * Time: 7:59 PM
 */

class ProductsTableSeedeer  extends Seeder {

    public function run()
    {
        DB::table('products')->delete();

        Product::create(array('productname' => 'TV Set',"quantity"=>"100","price"=>"4500","created_at"=>"2015-10-04 18:42:30"));
    }

}