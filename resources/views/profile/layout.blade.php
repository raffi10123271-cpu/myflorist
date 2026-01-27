<div class="border-b mb-6 flex space-x-6 text-lg">

    <a href="{{ route('profile.tab', 'biodata') }}"
       class="{{ $tab === 'biodata' ? 'border-b-2 border-green-600 text-green-600' : '' }}">
       Biodata Diri
    </a>

    <a href="{{ route('profile.tab', 'addresses') }}"
       class="{{ $tab === 'addresses' ? 'border-b-2 border-green-600 text-green-600' : '' }}">
       Daftar Alamat
    </a>

    <a href="{{ route('profile.tab', 'payments') }}"
       class="{{ $tab === 'payments' ? 'border-b-2 border-green-600 text-green-600' : '' }}">
      Rekening Anda
    </a>


    <a href="{{ route('profile.tab', 'notifications') }}"
       class="{{ $tab === 'notifications' ? 'border-b-2 border-green-600 text-green-600' : '' }}">
       Notifikasi
    </a>

   

</div>
