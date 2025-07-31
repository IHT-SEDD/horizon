<!DOCTYPE html>
<html lang="id">

<head>
 <meta charset="UTF-8">
 <title>Quotation #{{ $sales->quotation_number ?? 'N/A' }}</title>
 <style>
  body {
   font-family: Arial, sans-serif;
   font-size: 12px;
   margin: 40px;
  }

  table {
   border-collapse: collapse;
   width: 100%;
   margin-top: 20px;
  }

  th,
  td {
   border: 1px solid #000;
   padding: 6px;
   text-align: left;
  }

  .header,
  .footer {
   margin-top: 20px;
  }

  .text-right {
   text-align: right;
  }

  .text-center {
   text-align: center;
  }

  .no-border td {
   border: none;
  }
 </style>
</head>

<body>

 <h2>Quotation #{{ $sales->quotation_number ?? 'N/A' }}</h2>

 <table class="no-border">
  <tr>
   <td><strong>Quotation Date:</strong> {{ $sales->created_at->format('d/m/Y H:i') }}</td>
   <td><strong>Expired Date:</strong> {{ $sales->expired_date ? $sales->expired_date->format('d/m/Y') : '-' }}</td>
  </tr>
  <tr>
   <td><strong>Seller:</strong> {{ $sales->users->name ?? 'N/A' }}</td>
   <td><strong>Payment Term:</strong> {{ $sales->payment_terms->name ?? 'N/A' }}</td>
  </tr>
 </table>

 <hr>

 <h4>Customer</h4>
 <p>
  <strong>{{ $sales->customer->name ?? 'N/A' }}</strong><br>
  {{ $sales->customer->address ?? 'N/A' }}<br>
  TIN: {{ $sales->customer->npwp ?? 'N/A' }}
 </p>

 <h4>Item</h4>
 <table>
  <thead>
   <tr>
    <th>Description</th>
    <th>Qty</th>
    <th>Price</th>
    <th>Tax</th>
    <th>Total</th>
   </tr>
  </thead>
  <tbody>
   @foreach ($sales->salesProducts as $item)
   <tr>
    <td>{{ $item->salesProducts->product->name }}</td>
    <td>{{ $item->salesProducts->quantity }} {{ $item->salesProducts->product->unit->name }}</td>
    <td>Rp {{ number_format($item->salesProducts->product->sales_price, 0, ',', '.') }}</td>
    <td>{{ $item->salesProducts->tax->name ?? 0 }}%</td>
    <td>Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
   </tr>
   @endforeach
  </tbody>
 </table>

 <div class="text-right" style="margin-top: 20px;">
  <p><strong>Subtotal:</strong> Rp {{ number_format($sales->subtotal, 0, ',', '.') }}</p>
  <p><strong>Total:</strong> Rp {{ number_format($sales->grand_total, 0, ',', '.') }}</p>
 </div>

 <hr>

 <div class="footer">
  <strong>PT Indohadetama</strong><br>
  Jln. Situtarate I No.1, Bandung 40239, Indonesia<br>
  Tel: 022 - 5211480 | Email: info@indohadetama.co.id | Web: www.indohadetama.com
 </div>

</body>

</html>