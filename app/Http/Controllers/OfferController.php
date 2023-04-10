<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\discountType;
use App\Models\Offer;
use App\Models\Product;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $this->init();
        $offers = Offer::paginate(APP_PAGINATE);
        return $this->view(compact('offers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        $this->init();
        $products      = Product::all();
        $discountTypes = discountType::all();
        return $this->view(compact('products','discountTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  OfferRequest $request
     * @return RedirectResponse
     */
    public function store(OfferRequest $request): RedirectResponse
    {
        $this->init();
        DB::beginTransaction();
        try
        {
            $offer = Offer::createOffer($request);

            $offer->handelCreateDiscount($request);

            DB::commit();
            $this->success('success');
            return redirect()->route('offer.index');

        }catch (Exception $e)
        {
            DB::rollBack();
            $message = $this->handleException($e);
            $this->setSystemMessage($message);
            return redirect()->back();
        }
    }

}
