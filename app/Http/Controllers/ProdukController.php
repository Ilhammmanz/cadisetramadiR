<?php

namespace App\Http\Controllers;

use App\Http\Requests\Produk\StoreRequest;
use App\Http\Requests\Produk\UpdateRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Jenis;
use App\Models\Produk;
use App\Notifications\StockNotification;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $this->authorize('viewAny', Produk::class);

        $keyword = $request->input('search');

        $products = Produk::when($keyword, function ($query) use ($keyword) {
                $query->where('nama', 'like', '%' . $keyword . '%')
                      ->orWhere('jenis', 'like', '%' . $keyword . '%');
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('produk.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Produk::class);

        $jenisList = Jenis::all();

        return view('produk.create', compact('jenisList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $this->authorize('create', Produk::class);

        $dataReq = $request->validated();

        $data = [
            'user_id'    => Auth::id(),
            'jenis'      => $dataReq['jenis'],
            'nama'       => $dataReq['name'],
            'harga_beli' => $dataReq['purchase_price'],
            'harga_jual' => $dataReq['selling_price'],
            'stok'       => $dataReq['stock'],
        ];

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        Produk::create($data);

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Produk $produk)
    {
        $this->authorize('view', $produk);

        return view('produk.detail', compact('produk'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Produk $produk)
    {
        $this->authorize('update', $produk);

        $jenisList = Jenis::all();

        return view('produk.edit', compact('produk', 'jenisList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, Produk $produk)
    {
        $this->authorize('update', $produk);

        $dataReq = $request->validated();

        $data = [
            'user_id'    => Auth::id(),
            'jenis'      => $dataReq['jenis'],
            'nama'       => $dataReq['name'],
            'harga_beli' => $dataReq['purchase_price'],
            'harga_jual' => $dataReq['selling_price'],
            'stok'       => $dataReq['stock'],
        ];

        if ($request->hasFile('foto')) {
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            $data['foto'] = $request->file('foto')->store('products', 'public');
        }

        $produk->update($data);

        // 📬 Kirim notifikasi stok jika stok menipis (< 10)
        if ($data['stok'] < 10 && $data['stok'] > 0) {
            $users = \App\Models\User::where('stock_notifications', true)->get();
            foreach ($users as $user) {
                \Log::info('Sending stock notification to user: ' . $user->id . ' - ' . $user->name);
                $user->notify(new StockNotification($produk, $data['stok']));
            }
        }

        return redirect()
            ->route('produk.index')
            ->with('success', 'Produk berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Produk $produk)
    {
        $this->authorize('delete', $produk);

        try {
            // Hapus foto jika ada di storage
            if ($produk->foto && Storage::disk('public')->exists($produk->foto)) {
                Storage::disk('public')->delete($produk->foto);
            }

            // Coba hapus data produk
            $produk->delete();

            return redirect()
                ->route('produk.index')
                ->with('success', 'Produk berhasil dihapus.');

        } catch (QueryException $e) {
            // Tangkap error relasi foreign key constraint (SQLSTATE 23000)
            if ($e->getCode() === '23000') {
                return redirect()
                    ->route('produk.index')
                    ->with('error', 'Produk gagal dihapus karena sudah tercatat dalam riwayat penjualan.');
            }

            return redirect()
                ->route('produk.index')
                ->with('error', 'Terjadi kesalahan saat menghapus produk.');
        }
    }
}