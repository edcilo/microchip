<?php

use microchip\product\ProductRepo;
use microchip\inventoryMovement\InventoryMovementRepo;

class ReportStockController extends \BaseController {

    protected $productRepo;
    protected $movementRepo;

    public function __construct(
        ProductRepo           $productRepo,
        InventoryMovementRepo $movementRepo
    )
    {
        $this->productRepo  = $productRepo;
        $this->movementRepo = $movementRepo;
    }

	/**
	 * Display a listing of the resource.
	 * GET /reportstock
	 *
	 * @return Response
	 */
	public function index()
	{
        $products = $this->productRepo->getStockMin();
        $days     = Input::get('days');

        if (is_null($days)) {
            $days = 30;
        }

        //return Response::json($products);
        foreach ($products as $product) {
            $product->last_sale             = '';
            $product->last_purchase         = '';
            $product->quantity_to_purchase  = 0;

            foreach ($product->movements as $movement) {
                if ($movement->status == 'out' AND $product->last_sale=='') {
                    $product->last_sale = $movement->created_at;
                } elseif ($movement->status == 'in'AND $product->last_purchase=='') {
                    $product->last_purchase = $movement->created_at;
                }

                if ($product->last_sale!='' AND $product->last_purchase!='') {
                    break;
                }
            }

            $product->quantity_to_purchase = $product->stock_max - $product->total_stock;
            $product->quantity_sold        = $this->movementRepo->getSold($days, $product->id);
        }

		return View::make('reportStock.index', compact('products', 'days'));
	}

    public function validate($data)
    {
        $rules['date_init'] = 'date';

        if (isset($data['date_end'])) {
            $rules['date_end'] = 'date';
        } else {
            $data['date_end'] = null;
        }

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            return $validator;
        } else {
            return false;
        }
    }

}