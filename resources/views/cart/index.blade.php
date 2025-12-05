@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto bg-white p-6 rounded-xl shadow-md">

    <h1 class="text-black-600 font-bold mb-4">Keranjang Belanja</h1>

    @if($items->isEmpty())
        <p class="text-gray-600">Keranjang belanja Anda masih kosong.</p>

        <a href="/" class="mt-4 inline-block bg-green-600 text-white px-4 py-2 rounded-lg">
            Belanja Sekarang
        </a>
    @else
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="text-gray-600 border-b">
                    <th class="py-2">Produk</th>
                    <th class="py-2">Qty</th>
                    <th class="py-2">Harga</th>
                    <th class="py-2">Total</th>
                </tr>
            </thead>

            <tbody>
                @foreach($items as $item)
                    <tr class="border-b">
                        <td class="py-2">
                            {{ $item->product->name ?? 'Produk tidak ditemukan' }}
                        </td>

                        <td class="py-2">
                            {{ $item->quantity }}
                        </td>

                        <td class="py-2">
                            Rp {{ number_format($item->product->price ?? 0, 0, ',', '.') }}
                        </td>

                        <td class="py-2 font-semibold">
                            Rp {{ number_format(($item->product->price ?? 0) * $item->quantity, 0, ',', '.') }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-6 text-right">
            <a href="#" class="bg-green-600 text-white px-4 py-2 rounded-lg">
                Checkout
            </a>
        </div>

    @endif

</div>
@endsection
