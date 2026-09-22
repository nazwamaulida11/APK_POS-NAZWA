<?php

namespace App\Policies;

use App\Models\User;
use App\Models\ItemPenjualan;

class ItemPenjualanPolicy
{
    public function delete(User $user, ItemPenjualan $itemPenjualan): bool
    {
        $penjualan = $itemPenjualan->penjualan;

        // Transaksi yang sudah COMPLETED tidak boleh dihapus itemnya
        if ($penjualan->status !== 'OPEN') {
            return false;
        }

        // Admin boleh hapus item di transaksi manapun (selama OPEN)
        if ($user->role->name === 'admin') {
            return true;
        }

        // Kasir hanya boleh hapus item di transaksinya sendiri
        return $user->role->name === 'kasir' && $user->id === $penjualan->user_id;
    }
}