<?php

namespace App\Http\Controllers\Listing;

use App\Http\Controllers\Controller;
use App\Http\Requests\Listing\CreateBnB;
use App\Models\Catalogues\Listing\BnBCheckIn;
use App\Models\Catalogues\Listing\BnBHomeType;
use App\Models\Catalogues\Listing\BnBInstantBooking;
use App\Models\Catalogues\Listing\BnBListingType;
use App\Models\Listings\Listing;
use App\Models\Listings\ListingCategory;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\View\View;

class BnBController extends Controller
{
    /**
     * @return Factory|View
     */
    public function create()
    {
        $data = [
            'listing_types' => BnBListingType::getList(),
            'home_types' => BnBHomeType::getList(),
            'check_in_types' => BnBCheckIn::getList(),
            'instant_booking_types' => BnBInstantBooking::getList(),
            'category' => ListingCategory::where('code', 'bnb')->first()
        ];

        return view('listing/bnb/create-step-two', $data);
    }

    /**
     * @param CreateBnB $request
     * @return RedirectResponse|Redirector
     */
    public function store(CreateBnB $request)
    {
        $data = $request->except('_token');
        $model = new Listing();
        $model->fill($data);
        $model->save();

        return redirect(route('listing.create.attachments', ['id' => $model->id]));
    }

    /**
     * @param $id
     * @return Factory|View
     */
    public function edit($id)
    {
        return view('', []);
    }

    /**
     * @param Request $request
     * @return RedirectResponse|Redirector
     */
    public function update(Request $request)
    {
        return redirect(route(''));
    }

    /**
     * @param $id
     * @return RedirectResponse|Redirector
     */
    public function destroy($id)
    {
        return redirect(route(''));
    }
}
