@extends('layouts.app')

@section('content')
<div class="max-w-5xl mx-auto">

    <h2 class="text-2xl font-bold mb-6">Checkout</h2>

    <form action="{{ route('checkout.process') }}" method="POST">
        @csrf

        <!-- ================== ALAMAT ================== -->
        <div class="bg-white p-5 rounded shadow mb-6">
            <h3 class="font-bold text-lg mb-2">Alamat Pengiriman</h3>

            @if ($addresses->count() == 0)
                <p class="text-gray-500">Belum ada alamat. Tambahkan dulu di menu pengaturan.</p>
            @else
                <select name="address_id" class="w-full border rounded p-2">
                    @foreach ($addresses as $addr)
                        <option value="{{ $addr->id }}">
                            {{ $addr->label }} - {{ $addr->detail }}
                        </option>
                    @endforeach
                </select>
            @endif
        </div>

        <!-- ================== PRODUK ================== -->
        <div class="bg-white p-5 rounded shadow mb-6">
            <h3 class="font-bold text-lg mb-3">Produk Dipesan</h3>

            @php $subtotal = 0; @endphp

            @foreach ($cart as $item)
                @php
                    $subtotal += $item->qty * $item->product->price;
                @endphp

                <div class="flex justify-between py-2 border-b">
                    <div>
                        <p class="font-semibold">{{ $item->product->title }}</p>
                        <p class="text-sm text-gray-600">x{{ $item->qty }}</p>
                    </div>
                    <p class="font-bold">Rp{{ number_format($item->product->price, 0, ',', '.') }}</p>
                </div>
            @endforeach
        </div>

        <!-- ================== PILIH KURIR ================== -->
        <div class="bg-white p-5 rounded shadow mb-6">
            <h3 class="font-bold text-lg mb-3">Pilih Kurir</h3>

            <select id="shipping_method" name="shipping_method"
                    class="w-full border rounded p-2" onchange="updateShipping()">

                <option value="">Pilih Pengiriman</option>

                @foreach ($shippingMethods as $method)
                    <option value="{{ $method->id }}" data-cost="{{ $method->cost }}">
                        {{ $method->name }} - Rp{{ number_format($method->cost, 0, ',', '.') }}
                    </option>
                @endforeach

            </select>

            <input type="hidden" name="shipping_cost" id="shipping_cost" value="0">
        </div>

        <!-- ================== METODE PEMBAYARAN ================== -->
        <div class="bg-white p-5 rounded shadow mb-6">
            <h3 class="font-bold text-lg mb-3">Metode Pembayaran</h3>

            <select name="payment_method" class="w-full border rounded p-2">
                <option value="transfer">Transfer Bank</option>
                <option value="cod">COD (Bayar di Tempat)</option>
                <option value="qris">QRIS</option>
            </select>
        </div>

        <!-- ================== RINGKASAN TOTAL ================== -->
        <div class="bg-white p-5 rounded shadow">
            <h3 class="font-bold text-lg mb-3">Ringkasan Belanja</h3>

            <div class="flex justify-between mb-2">
                <p>Subtotal</p>
                <p class="font-bold">Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
            </div>

            <div class="flex justify-between mb-2">
                <p>Ongkir</p>
                <p class="font-bold" id="ongkir_text">Rp0</p>
            </div>

            <hr class="my-3">

            <div class="flex justify-between text-xl font-bold">
                <p>Total</p>
                <p id="total_text">Rp{{ number_format($subtotal, 0, ',', '.') }}</p>
            </div>

            <input type="hidden" name="total" id="total_input" value="{{ $subtotal }}">

            <button class="w-full bg-green-600 text-white py-3 rounded mt-4 font-bold">
                Buat Pesanan
            </button>
        </div>

    </form>
</div>

<script>
function updateShipping() {
    let select = document.getElementById("shipping_method");
    let cost = parseInt(select.options[select.selectedIndex].dataset.cost || 0);

    let ongkirText = document.getElementById("ongkir_text");
    let shippingCostInput = document.getElementById("shipping_cost");

    ongkirText.textContent = "Rp" + cost.toLocaleString("id-ID");
    shippingCostInput.value = cost;

    updateTotal();
}

function updateTotal() {
    let subtotal = {{ $subtotal }};
    let shipping = parseInt(document.getElementById("shipping_cost").value);

    let total = subtotal + shipping;

    document.getElementById("total_text").textContent =
        "Rp" + total.toLocaleString("id-ID");

    document.getElementById("total_input").value = total;
}
</script>

@endsection
