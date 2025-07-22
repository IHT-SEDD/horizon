<?php

namespace App\Services;

class ModelResolver
{
 protected array $allowed = [
  'customer',
  'payment-term',
  'product',
  'product-category',
  'product-unit',
  'sales',
  'sales-product',
  'tax',
 ];

 public function resolve(string $model): ?string
 {
  if (!in_array($model, $this->allowed)) {
   return null;
  }

  $modelName = str_replace(' ', '', ucwords(str_replace('-', ' ', $model)));

  return 'App\\Models\\' . $modelName;
 }
}
