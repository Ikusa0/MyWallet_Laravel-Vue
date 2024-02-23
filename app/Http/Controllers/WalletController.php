<?php

namespace App\Http\Controllers;

use App\Models\Wallet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WalletController extends Controller
{
    public function getWallet()
    {
        $user = Auth::user();

        $walletEntries = Wallet::where('user_id', $user->id)->get();

        $totalBalance = 0;

        foreach ($walletEntries as $entry) {
            $totalBalance += $entry->type === 'entrada' ? $entry->value : -$entry->value;
        }

        return response()->json([
            'totalBalance' => $totalBalance,
            'walletEntries' => $walletEntries,
        ], 200);
    }

    public function addWalletEntry(Request $request)
    {
        $request->validate([
            'value' => 'required|numeric|min:0',
            'description' => 'required|string',
            'type' => 'required|in:entrada,saída',
            'date' => 'required|date',
        ]);

        $user = Auth::user();
        $walletEntry = new Wallet([
            'user_id' => $user->id,
            'value' => $request->input('value'),
            'description' => $request->input('description'),
            'type' => $request->input('type'),
            'date' => $request->input('date'),
        ]);

        $walletEntry->save();

        return response()->json([
            'message' => 'Wallet entry added successfully',
            'redirect' => route('wallet.web.get')
        ], 201);
    }

    public function deleteWalletEntry(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:wallets,id,user_id,' . Auth::id(),
        ]);

        $walletEntry = Wallet::find($request->input('id'));

        if ($walletEntry->user_id !== Auth::id()) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        $walletEntry->delete();

        return response()->json([
            'message' => 'Wallet entry deleted successfully',
            'redirect' => route('wallet.web.get')
        ], 200);
    }
}
