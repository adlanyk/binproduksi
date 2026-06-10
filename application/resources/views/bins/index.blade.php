@extends('layouts.app')

@section('content')
<div class="space-y-10">
    @php
        $config = [
            'grinding' => [
                'bg' => 'from-emerald-600 to-teal-700',
                'icon' => 'fa-industry',
                'title' => '🏭 BIN GRINDING',
                'count' => '8 Bin',
                'badge' => 'bg-emerald-100 text-emerald-800'
            ],
            'pelleting' => [
                'bg' => 'from-amber-600 to-orange-700',
                'icon' => 'fa-cogs',
                'title' => '⚙️ BIN PELLETING',
                'count' => '6 Bin',
                'badge' => 'bg-amber-100 text-amber-800'
            ],
            'dosing' => [
                'bg' => 'from-blue-600 to-cyan-700',
                'icon' => 'fa-weight-hanging',
                'title' => '⚖️ BIN DOSING',
                'count' => '25 Bin',
                'badge' => 'bg-blue-100 text-blue-800'
            ],
            'makro' => [
                'bg' => 'from-purple-600 to-pink-700',
                'icon' => 'fa-chart-line',
                'title' => '📈 BIN MAKRO',
                'count' => '6 Bin',
                'badge' => 'bg-purple-100 text-purple-800'
            ],
            'bagging' => [
                'bg' => 'from-rose-600 to-red-700',
                'icon' => 'fa-box',
                'title' => '📦 BIN BAGGING',
                'count' => '12 Bin',
                'badge' => 'bg-rose-100 text-rose-800'
            ],
        ];
    @endphp

    @foreach($grouped as $type => $bins)
        @if($bins->count() > 0)
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden border border-gray-100">
            {{-- Category Header --}}
            <div class="category-header bg-gradient-to-r {{ $config[$type]['bg'] }} px-6 py-4">
                <div class="flex flex-wrap items-center justify-between gap-3">
                    <div class="flex items-center space-x-3">
                        <div class="bg-white/20 p-2 rounded-xl">
                            <i class="fas {{ $config[$type]['icon'] }} text-2xl text-white"></i>
                        </div>
                        <div>
                            <h2 class="text-xl md:text-2xl font-bold text-white">{{ $config[$type]['title'] }}</h2>
                            <p class="text-sm text-white/80">{{ $config[$type]['count'] }}</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="bg-white/20 px-3 py-1 rounded-full text-sm font-medium text-white">
                            <i class="fas fa-chart-simple mr-1"></i> {{ $bins->where('is_filled', true)->count() }} Terisi
                        </div>
                        <div class="bg-white/20 px-3 py-1 rounded-full text-sm font-medium text-white">
                            <i class="fas fa-ban mr-1"></i> {{ $bins->where('is_filled', false)->count() }} Kosong
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Grid Bin Cards --}}
            <div class="p-6">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-5">
                    @foreach($bins as $bin)
                        @php
                            $currentItem = $bin->current_item;
                            $isFilled = $bin->is_filled;
                            $fillPercent = $isFilled ? min(95, max(25, ($currentItem->quantity ?? 0) / 100)) : 5;
                        @endphp
                        
                        <div class="bin-card rounded-xl overflow-hidden shadow-lg cursor-pointer group" 
                             onclick="openDetailModal({{ $bin->id }}, '{{ $bin->code }}', '{{ addslashes($currentItem->item_name ?? '') }}', '{{ addslashes($currentItem->item_code ?? '') }}', {{ $currentItem->quantity ?? 0 }})">
                            
                            {{-- Card Body --}}
                            <div class="p-4 {{ $isFilled ? 'bin-filled text-white' : 'bin-empty text-gray-700' }} text-center relative">
                                {{-- Badge Status --}}
                                <div class="absolute top-2 right-2">
                                    <span class="pill-status text-xs px-2 py-1 rounded-full {{ $isFilled ? 'bg-green-500 text-white' : 'bg-gray-500 text-white' }}">
                                        <i class="fas {{ $isFilled ? 'fa-check-circle' : 'fa-clock' }} mr-1"></i>
                                        {{ $isFilled ? 'Terisi' : 'Kosong' }}
                                    </span>
                                </div>
                                
                                {{-- Kode Bin besar --}}
                                <div class="text-5xl md:text-6xl font-black tracking-wider mt-2">
                                    {{ $bin->code }}
                                </div>
                                <div class="text-xs md:text-sm mt-1 opacity-80">
                                    {{ $bin->name }}
                                </div>
                                
                                {{-- Level Bar Visual --}}
                                <div class="mt-4">
                                    <div class="bg-black/20 rounded-full h-2.5 overflow-hidden">
                                        <div class="level-bar bg-gradient-to-r from-yellow-400 to-orange-500 h-full rounded-full" style="width: {{ $fillPercent }}%"></div>
                                    </div>
                                </div>
                                
                                {{-- Item Info --}}
                                @if($isFilled)
                                    <div class="mt-3">
                                        <div class="text-sm font-bold truncate px-1" title="{{ $currentItem->item_name }}">
                                            <i class="fas fa-boxes mr-1"></i>
                                            {{ Str::limit($currentItem->item_name, 18) }}
                                        </div>
                                        @if($currentItem->quantity > 0)
                                            <div class="text-xs mt-1 font-semibold">
                                                <i class="fas fa-balance-scale mr-1"></i> 
                                                {{ number_format($currentItem->quantity) }} {{ $currentItem->unit }}
                                            </div>
                                        @endif
                                        @if($currentItem->item_code)
                                            <div class="text-xs mt-1 opacity-75">
                                                <i class="fas fa-barcode mr-1"></i> {{ $currentItem->item_code }}
                                            </div>
                                        @endif
                                    </div>
                                @else
                                    <div class="mt-3 py-2">
                                        <div class="text-sm font-semibold">
                                            <i class="fas fa-inbox mr-1"></i> 
                                            <span class="text-gray-500">Belum ada item</span>
                                        </div>
                                    </div>
                                @endif
                                
                                {{-- Last Update --}}
                                <div class="mt-2 text-xs opacity-70">
                                    <i class="far fa-clock mr-1"></i> 
                                    {{ $currentItem ? $currentItem->created_at->diffForHumans() : 'Belum pernah diisi' }}
                                </div>
                            </div>
                            
                            {{-- Footer Button --}}
                            <div class="bg-gray-50 px-4 py-3 flex justify-between items-center border-t border-gray-200">
                                <div class="text-xs text-gray-500">
                                    <i class="fas fa-history mr-1"></i> {{ $bin->items->count() }}x perubahan
                                </div>
                                <button onclick="event.stopPropagation(); openEditModal({{ $bin->id }}, '{{ $bin->code }}')" 
                                        class="bg-gradient-to-r from-blue-500 to-blue-700 hover:from-blue-600 hover:to-blue-800 text-white px-4 py-1.5 rounded-lg font-medium transition shadow-md text-sm flex items-center gap-2">
                                    <i class="fas fa-pen"></i> Pilih Item
                                </button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
    @endforeach
</div>

{{-- MODAL UNTUK PILIH ITEM --}}
<div id="editModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 backdrop-blur-sm" onclick="closeModal()">
    <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full mx-4 transform transition-all" onclick="event.stopPropagation()">
        <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-t-2xl px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2 text-white">
                <i class="fas fa-edit text-xl"></i>
                <h3 class="text-xl font-bold">🎯 Pilih Item untuk Bin <span id="modalBinCode" class="text-yellow-300"></span></h3>
            </div>
            <button onclick="closeModal()" class="text-white hover:text-gray-200 text-2xl">&times;</button>
        </div>
        
        <form id="editForm" method="POST" class="p-6 space-y-4">
            @csrf
            <input type="hidden" id="binId" name="bin_id">
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-tag text-blue-500 mr-1"></i> Nama Item *
                </label>
                <input type="text" name="item_name" id="itemName" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Contoh: Jagung Giling, Dedak Halus, Konsentrat A">
                <p class="text-xs text-gray-400 mt-1">Masukkan nama material yang diisi ke bin ini</p>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-barcode text-blue-500 mr-1"></i> Kode Item (Opsional)
                </label>
                <input type="text" name="item_code" id="itemCode"
                       class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500"
                       placeholder="Misal: JG-001, DK-02">
            </div>
            
            <div class="grid grid-cols-2 gap-3">
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-weight-hanging text-blue-500 mr-1"></i> Jumlah
                    </label>
                    <input type="number" name="quantity" id="quantity" step="0.01" placeholder="0"
                           class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500">
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-700 mb-2">
                        <i class="fas fa-chart-simple text-blue-500 mr-1"></i> Satuan
                    </label>
                    <select name="unit" id="unit" class="w-full px-4 py-3 border border-gray-300 rounded-xl">
                        <option value="kg">kg</option>
                        <option value="ton">Ton</option>
                        <option value="sak">Sak</option>
                        <option value="liter">Liter</option>
                        <option value="karung">Karung</option>
                    </select>
                </div>
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-sticky-note text-blue-500 mr-1"></i> Catatan (Opsional)
                </label>
                <textarea name="notes" id="notes" rows="2"
                          class="w-full px-4 py-3 border border-gray-300 rounded-xl focus:ring-2 focus:ring-blue-500"
                          placeholder="Info tambahan..."></textarea>
            </div>
            
            <div class="flex gap-3 pt-3">
                <button type="submit" class="flex-1 bg-gradient-to-r from-green-500 to-emerald-600 text-white py-3 rounded-xl font-semibold hover:shadow-lg transition">
                    <i class="fas fa-save mr-2"></i> Simpan Item
                </button>
                <button type="button" onclick="clearBin()" class="flex-1 bg-gradient-to-r from-red-500 to-rose-600 text-white py-3 rounded-xl font-semibold hover:shadow-lg transition">
                    <i class="fas fa-trash-alt mr-2"></i> Kosongkan
                </button>
            </div>
        </form>
    </div>
</div>

{{-- MODAL DETAIL LIHAT ITEM --}}
<div id="detailModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50 backdrop-blur-sm" onclick="closeDetailModal()">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4" onclick="event.stopPropagation()">
        <div class="bg-gradient-to-r from-gray-800 to-gray-900 rounded-t-2xl px-6 py-4 flex justify-between items-center">
            <div class="flex items-center space-x-2 text-white">
                <i class="fas fa-info-circle text-xl"></i>
                <h3 class="text-xl font-bold">📋 Detail Bin <span id="detailBinCode"></span></h3>
            </div>
            <button onclick="closeDetailModal()" class="text-white hover:text-gray-300 text-2xl">&times;</button>
        </div>
        <div class="p-6" id="detailContent">
            <!-- Isi dari JavaScript -->
        </div>
        <div class="px-6 pb-6">
            <button onclick="closeDetailModal(); openEditModalFromDetail()" id="detailEditBtn" class="w-full bg-blue-600 text-white py-2 rounded-xl font-semibold hover:bg-blue-700 transition">
                <i class="fas fa-edit mr-2"></i> Ganti Item
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
    let currentBinId = null;
    let currentBinCode = null;
    let detailBinId = null;
    let detailBinCode = null;
    
    // Open Edit Modal (Pilih Item)
    function openEditModal(binId, binCode) {
        currentBinId = binId;
        currentBinCode = binCode;
        
        document.getElementById('modalBinCode').textContent = binCode;
        document.getElementById('binId').value = binId;
        document.getElementById('editForm').action = `/bin/${binId}/update-item`;
        
        // Reset form
        document.getElementById('itemName').value = '';
        document.getElementById('itemCode').value = '';
        document.getElementById('quantity').value = '';
        document.getElementById('unit').value = 'kg';
        document.getElementById('notes').value = '';
        
        document.getElementById('editModal').classList.remove('hidden');
        document.getElementById('editModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    // Open Detail Modal (Lihat Item)
    function openDetailModal(binId, binCode, itemName, itemCode, quantity) {
        detailBinId = binId;
        detailBinCode = binCode;
        
        document.getElementById('detailBinCode').textContent = binCode;
        
        let content = '';
        if (itemName && itemName !== 'Kosong') {
            content = `
                <div class="text-center">
                    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 p-5 rounded-xl mb-4">
                        <div class="text-6xl mb-3">📦</div>
                        <p class="text-sm text-gray-500 mb-1">Item yang sedang terisi</p>
                        <p class="text-xl font-bold text-gray-800">${itemName}</p>
                        ${itemCode ? `<p class="text-sm text-gray-600 mt-2"><i class="fas fa-barcode"></i> Kode: ${itemCode}</p>` : ''}
                        ${quantity ? `<p class="text-sm text-gray-600 mt-1"><i class="fas fa-weight-hanging"></i> Jumlah: ${Number(quantity).toLocaleString()} kg</p>` : ''}
                    </div>
                    <div class="text-xs text-gray-400">
                        <i class="far fa-clock"></i> Terakhir diupdate: ${new Date().toLocaleString()}
                    </div>
                </div>
            `;
        } else {
            content = `
                <div class="text-center">
                    <div class="bg-gray-100 p-5 rounded-xl mb-4">
                        <div class="text-6xl mb-3">🗑️</div>
                        <p class="text-base font-semibold text-gray-600">Bin dalam keadaan KOSONG</p>
                        <p class="text-sm text-gray-400 mt-2">Belum ada item yang dipilih</p>
                    </div>
                </div>
            `;
        }
        
        document.getElementById('detailContent').innerHTML = content;
        document.getElementById('detailModal').classList.remove('hidden');
        document.getElementById('detailModal').classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
    
    function openEditModalFromDetail() {
        closeDetailModal();
        openEditModal(detailBinId, detailBinCode);
    }
    
    function closeDetailModal() {
        document.getElementById('detailModal').classList.add('hidden');
        document.getElementById('detailModal').classList.remove('flex');
        document.body.style.overflow = '';
        detailBinId = null;
    }
    
    // Clear Bin
    function clearBin() {
        if (!currentBinId) return;
        
        Swal.fire({
            title: '⚠️ Kosongkan Bin?',
            text: `Apakah Anda yakin ingin mengosongkan bin ${currentBinCode}?`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Ya, Kosongkan!',
            cancelButtonText: 'Batal'
        }).then((result) => {
            if (result.isConfirmed) {
                fetch(`/bin/${currentBinId}/clear`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Content-Type': 'application/json'
                    }
                }).then(() => {
                    closeModal();
                    Swal.fire('Berhasil!', `Bin ${currentBinCode} telah dikosongkan`, 'success');
                    setTimeout(() => location.reload(), 1000);
                });
            }
        });
    }
    
    // Close Modal
    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('editModal').classList.remove('flex');
        document.body.style.overflow = '';
        currentBinId = null;
    }
    
    // Close modal on escape key
    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            closeModal();
            closeDetailModal();
        }
    });
</script>
@endpush
@endsection