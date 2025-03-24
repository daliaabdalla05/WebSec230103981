<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    public function editCredit($id)
    {
        $customer = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->findOrFail($id);

        return view('customers.credit', compact('customer'));
    }

    public function updateCredit(Request $request, $id)
    {
        $request->validate([
            'credit' => 'required|numeric|min:0',
        ]);

        $customer = User::whereHas('roles', function ($query) {
            $query->where('name', 'customer');
        })->findOrFail($id);

        $customer->store_credit += $request->credit;
        $customer->save();

        return redirect()->route('customers.credit.edit', $customer->id)
            ->with('success', 'Store credit added successfully.');
    }
}
