<?php

namespace App\Services;

use App\Models\Sales;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class SalesOrderService
{
 public function updateStatus(Sales $sales, $newStatus): Sales
 {
  $currentStatus = $sales->status;

  $allowedTransitions = [
   Sales::STATUS_QUOTATION => [Sales::STATUS_CONFIRMED, Sales::STATUS_CANCELED, Sales::STATUS_LOCKED],
  ];

  if (!isset($allowedTransitions[$currentStatus]) || !in_array($newStatus, $allowedTransitions[$currentStatus])) {
   throw ValidationException::withMessages([
    'status' => "Cannot change status from '$currentStatus' to '$newStatus'.",
   ]);
  }

  $data = ['status' => $newStatus, 'updated_at' => Carbon::now()];

  if ($newStatus === Sales::STATUS_CONFIRMED) {
   $data['confirmation_date'] = Carbon::now();
  }

  $sales->update($data);

  return $sales->fresh();
 }
}
