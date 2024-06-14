<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ZohoService;
use Illuminate\Validation\ValidationException;
use Exception;

class ZohoController extends Controller
{
    protected $zohoService;

    public function __construct(ZohoService $zohoService)
    {
        $this->zohoService = $zohoService;
    }

    public function createDealAndAccount(Request $request)
    {
        try {
            $validated = $request->validate([
                'deal_name' => 'required|string',
                'stage' => 'required|string',
                'account_name' => 'required|string',
                'website' => 'required|string',
                'phone' => 'required|string',
            ]);

            $dealData = [
                'Deal_Name' => $validated['deal_name'],
                'Stage' => $validated['stage'],
            ];

            $accountData = [
                'Account_Name' => $validated['account_name'],
                'Website' => $validated['website'],
                'Phone' => $validated['phone'],
            ];

            $deal = $this->zohoService->createDeal($dealData);
            $account = $this->zohoService->createAccount($accountData);

            return response()->json(['deal' => $deal, 'account' => $account], 200);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 422);
        } catch (Exception $e) {
            return response()->json(['error' => 'An error occurred while creating records.'], 500);
        }
    }
}
