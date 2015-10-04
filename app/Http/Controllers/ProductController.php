<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    //

    public function index()
    {
        //
        return View("products.index");
    }

    public function store(Request $request)
    {
        //
        $all_request = $request->all();
        array_forget($all_request, "_token");
        $fileJson = public_path().'/result.json';
        $create_at = date("Y-m-d H:i:s");
        $all_request['created_at'] = $create_at;


        $json = file_get_contents($fileJson);
        $json_a = json_decode($json);

        if(!$json_a){
            /*foreach($json_a as $row){
                echo $row->status;
                echo "\n";
            }*/

            $fp = fopen($fileJson, 'w');
            fwrite($fp,"[");
            fclose($fp);

            $fp = fopen($fileJson, 'a');

            fwrite($fp, json_encode($all_request));
            fclose($fp);
            $fp = fopen($fileJson, 'a');
            fwrite($fp, "]");
            fclose($fp);
        }else{
            $json = preg_replace("/]/","",$json);
            //$json_a = json_decode($json);
            $fp = fopen($fileJson, 'w');
            fwrite($fp,$json);
            fclose($fp);
            $fp = fopen($fileJson, 'a');
            fwrite($fp,",");
            fclose($fp);
            $fp = fopen($fileJson, 'a');
            fwrite($fp, json_encode($all_request));
            fclose($fp);
            $fp = fopen($fileJson, 'a');
            fwrite($fp, "]");
            fclose($fp);
            echo "<table class='table'>
                <thead><tr><th>Product</th><th>Qty</th><th>Price</th><th>Total</th><th>Date</th></tr></thead>
                <tbody>";
            $responseJson = file_get_contents($fileJson);
            $decodeResponseJson =  json_decode($responseJson);
            //$decodeResponseJson = arsort($decodeResponseJson,"created_at" );

           /* $decodeResponseJson = array_sort($decodeResponseJson, function($value)
            {
                return $value['productname'];
            });*/
            $sumTotal = 0;
            foreach($decodeResponseJson as $product){
                $total = $product->price * $product->quantity;
                $sumTotal +=$total;
                echo"<tr>
                <td>$product->pname</td><td>$product->quantity</td><td>".number_format($product->price, 2,'.',',')."</td><td>"; echo number_format($total, 2,'.',',') ; echo "</td><td>$product->created_at</td>
            </tr>";
            }

            echo "<tr>
                <td><b>TOTAL</b></td><td></td><td></td><td><b>"; echo number_format($sumTotal, 2,'.',',') ; echo "</b></td><td></td>
            </tr>";

            echo"</tbody>
            </table>";

        }

    }

}
