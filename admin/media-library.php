<?php
$page_title = 'Media Library';
require_once 'includes/header.php';
?>

<div class="space-y-8">
    <div class="flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-heading font-bold">Media <span class="text-orange-600">Library</span></h1>
            <p class="text-sm text-gray-400">Manage all your uploaded images and assets in one place.</p>
        </div>
        <div class="flex items-center space-x-4">
            <button onclick="syncStandalone(this)" id="standalone-sync-btn" title="Sync with Filesystem" class="bg-gray-800 hover:bg-gray-700 text-orange-600 font-bold w-10 h-10 rounded-lg transition-all flex items-center justify-center border border-gray-700">
                <i class="fas fa-sync-alt"></i>
            </button>
            <button onclick="document.getElementById('media-file-input-standalone').click()" class="bg-orange-600 hover:bg-orange-700 text-white font-bold py-2 px-6 rounded-lg transition-all shadow-md active:scale-95 flex items-center text-sm">
                <i class="fas fa-upload mr-2"></i> Upload New
            </button>
            <input type="file" id="media-file-input-standalone" multiple class="hidden" onchange="uploadStandalone(this.files)">
        </div>
    </div>

    <!-- Quick Stats -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="card p-6 flex items-center space-x-4">
            <div class="w-12 h-12 bg-blue-600/10 rounded-xl flex items-center justify-center text-blue-500">
                <i class="fas fa-file-image text-xl"></i>
            </div>
            <div>
                <p class="text-xs text-gray-500 uppercase font-bold tracking-widest">Total Images</p>
                <h3 class="text-2xl font-bold text-white tracking-tight" id="total-media-count">0</h3>
            </div>
        </div>
    </div>

    <!-- Media Grid Container -->
    <div class="card p-8 min-h-[60vh] border-gray-800/50 shadow-2xl flex flex-col">
        <div id="standalone-media-grid" class="media-grid">
            <!-- Loaded via JS -->
            <div class="col-span-full py-20 text-center text-gray-500">
                <i class="fas fa-circle-notch fa-spin text-3xl mb-4 text-orange-600"></i>
                <p class="font-medium">Initializing library...</p>
            </div>
        </div>
        <div id="standalone-pagination" class="pagination-container mt-auto pt-8">
            <!-- Pagination logic -->
        </div>
    </div>
</div>

<script>
let currentStandalonePage = 1;
const itemsPerPage = 12;

document.addEventListener('DOMContentLoaded', function() {
    loadStandaloneMedia(1);
});

function loadStandaloneMedia(page = 1) {
    currentStandalonePage = page;
    const grid = document.getElementById('standalone-media-grid');
    const pagination = document.getElementById('standalone-pagination');
    const adminUrl = window.VIVA_ADMIN_URL || '/VIVA/admin';
    
    fetch(`${adminUrl}/api/media.php?action=fetch&page=${page}&limit=${itemsPerPage}`)
        .then(res => {
            if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
            return res.json();
        })
        .then(res => {
            if (res.success) {
                document.getElementById('total-media-count').innerText = res.pagination.total;
                if (res.data.length === 0) {
                    grid.innerHTML = `
                        <div class="col-span-full py-20 text-center">
                            <i class="fas fa-images text-4xl text-gray-700 mb-4"></i>
                            <p class="text-gray-500 italic">Your library is empty. Click Upload to begin.</p>
                        </div>
                    `;
                    pagination.innerHTML = '';
                    return;
                }

                grid.innerHTML = res.data.map(item => `
                    <div class="media-item rounded-xl group relative overflow-hidden transition-all bg-white border border-gray-200">
                        <div class="image-container bg-gray-50">
                            <img src="${adminUrl}/../${item.file_path}" class="p-2 transition-transform duration-500 group-hover:scale-110">
                        </div>
                        <div class="item-footer">
                            <p class="filename">${item.file_name}</p>
                        </div>
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition-all flex items-center justify-center p-4">
                            <div class="flex space-x-2">
                                <button onclick="copyToClipboard('${adminUrl}/../${item.file_path}')" class="w-9 h-9 bg-blue-600 rounded-lg flex items-center justify-center text-white hover:bg-blue-700 shadow-lg" title="Copy Path">
                                    <i class="fas fa-link text-xs"></i>
                                </button>
                                <button onclick="deleteStandalone(${item.id})" class="w-9 h-9 bg-red-600 rounded-lg flex items-center justify-center text-white hover:bg-red-700 shadow-lg" title="Delete">
                                    <i class="fas fa-trash text-xs"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                `).join('');

                renderStandalonePagination(res.pagination);
            } else {
                throw new Error(res.message || 'Unknown error');
            }
        })
        .catch(err => {
            console.error('Media Load Error:', err);
            grid.innerHTML = `
                <div class="col-span-full py-20 text-center">
                    <i class="fas fa-exclamation-triangle text-3xl text-red-500 mb-4"></i>
                    <p class="text-red-500 font-bold">Failed to load media</p>
                    <p class="text-xs text-gray-500 mt-2">${err.message}</p>
                    <button onclick="loadStandaloneMedia(${page})" class="mt-6 px-8 py-3 bg-orange-600/10 text-orange-600 border border-orange-600/30 rounded-xl text-xs font-bold uppercase transition-all hover:bg-orange-600 hover:text-white">Retry Loading</button>
                </div>
            `;
        });
}

function renderStandalonePagination(meta) {
    const container = document.getElementById('standalone-pagination');
    if (!meta || meta.pages <= 1) {
        container.innerHTML = '';
        return;
    }

    let html = '';
    html += `<button class="page-btn ${meta.page <= 1 ? 'disabled' : ''}" 
             ${meta.page <= 1 ? 'disabled' : ''} onclick="loadStandaloneMedia(${meta.page - 1})">
             Prev</button>`;

    for (let i = 1; i <= meta.pages; i++) {
        if (i === 1 || i === meta.pages || (i >= meta.page - 1 && i <= meta.page + 1)) {
            html += `<button class="page-btn ${meta.page === i ? 'active' : ''}" onclick="loadStandaloneMedia(${i})">${i}</button>`;
        } else if (i === meta.page - 2 || i === meta.page + 2) {
            html += `<span class="px-1 text-gray-500">...</span>`;
        }
    }

    html += `<button class="page-btn next ${meta.page >= meta.pages ? 'disabled' : ''}" 
             ${meta.page >= meta.pages ? 'disabled' : ''} onclick="loadStandaloneMedia(${meta.page + 1})">
             Next &raquo;</button>`;

    container.innerHTML = html;
}

function syncStandalone(btn) {
    const icon = btn.querySelector('i');
    const grid = document.getElementById('standalone-media-grid');
    
    icon.classList.add('fa-spin');
    btn.disabled = true;
    grid.innerHTML = `<div class="col-span-full py-20 text-center"><i class="fas fa-cog fa-spin text-3xl mb-4 text-orange-600"></i><p>Synchronizing assets...</p></div>`;

    const adminUrl = window.VIVA_ADMIN_URL || '/VIVA/admin';
    fetch(adminUrl + '/sync_media.php')
        .then(() => {
            loadStandaloneMedia(1);
            icon.classList.remove('fa-spin');
            btn.disabled = false;
        })
        .catch(err => {
            alert('Sync failed: ' + err.message);
            loadStandaloneMedia(currentStandalonePage);
            icon.classList.remove('fa-spin');
            btn.disabled = false;
        });
}

function uploadStandalone(files) {
    if (!files.length) return;
    const grid = document.getElementById('standalone-media-grid');
    grid.innerHTML = `<div class="col-span-full py-20 text-center"><i class="fas fa-circle-notch fa-spin text-3xl mb-4 text-orange-600"></i><p>Uploading files...</p></div>`;

    const formData = new FormData();
    for (let i = 0; i < files.length; i++) formData.append('files[]', files[i]);

    fetch(window.VIVA_ADMIN_URL + '/api/media.php?action=upload', {
        method: 'POST',
        body: formData
    }).then(res => res.json()).then(res => {
        if (res.success) loadStandaloneMedia(1);
        else {
            alert(res.message);
            loadStandaloneMedia(currentStandalonePage);
        }
    }).catch(err => {
        alert('Upload failed: ' + err.message);
        loadStandaloneMedia(currentStandalonePage);
    });
}

function deleteStandalone(id) {
    if (!confirm('Permanently delete this item?')) return;
    const formData = new FormData();
    formData.append('id', id);

    fetch(window.VIVA_ADMIN_URL + '/api/media.php?action=delete', {
        method: 'POST',
        body: formData
    }).then(res => res.json()).then(res => {
        if (res.success) loadStandaloneMedia();
    });
}

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        alert('Path copied to clipboard!');
    });
}
</script>

<style>
/* Standalone specific overrides if any */
</style>

<?php require_once 'includes/footer.php'; ?>
