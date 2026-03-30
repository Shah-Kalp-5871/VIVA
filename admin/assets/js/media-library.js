/**
 * VIVA ENGINEERING - Media Library Manager
 * Handles AJAX-based image selection and management
 */

const MediaManager = {
    modal: null,
    callback: null,
    options: {
        multiple: false,
        type: 'image'
    },
    selectedItems: [],
    currentPage: 1,
    itemsPerPage: 12,

    init: function() {
        console.log('MediaManager: Initializing machinery asset system...');
        if (!document.getElementById('media-modal')) {
            this.createModalMarkup();
        }
        this.modal = document.getElementById('media-modal');
        this.bindEvents();
        console.log('MediaManager: Active and ready.');
    },

    createModalMarkup: function() {
        const modalHTML = `
            <div id="media-modal" class="fixed inset-0 z-[9999] hidden flex items-center justify-center bg-black/80 backdrop-blur-sm p-4">
                <div class="media-modal-content w-full max-w-6xl h-[85vh] flex flex-col rounded-2xl overflow-hidden shadow-2xl animate-fade-in border border-gray-800">
                    <!-- Modal Header -->
                    <div class="px-8 py-5 border-b border-gray-800 flex items-center justify-between bg-gray-900/50">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-orange-600/10 rounded-xl flex items-center justify-center text-orange-600">
                                <i class="fas fa-images"></i>
                            </div>
                            <h3 class="text-xl font-bold text-white">Media Library</h3>
                        </div>
                        <div class="flex items-center space-x-4">
                            <button id="media-sync-btn" title="Sync Files with DB" class="w-10 h-10 rounded-full bg-orange-600/10 hover:bg-orange-600/20 transition-all text-orange-600 flex items-center justify-center border border-orange-600/20">
                                <i class="fas fa-sync-alt"></i>
                            </button>
                            <button id="close-media-modal" class="w-10 h-10 rounded-full hover:bg-white/5 transition-colors text-gray-400 hover:text-white flex items-center justify-center">
                                <i class="fas fa-times text-lg"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Modal Body -->
                    <div class="flex-1 flex overflow-hidden">
                        <!-- Main Content Area -->
                        <div class="flex-1 flex flex-col bg-gray-950">
                            <!-- Tabs -->
                            <div class="px-8 border-b border-gray-800 flex space-x-8">
                                <button class="media-tab py-4 text-sm font-bold border-b-2 border-orange-600 text-orange-600" data-tab="browse">Browse Library</button>
                                <button class="media-tab py-4 text-sm font-bold border-b-2 border-transparent text-gray-400 hover:text-white" data-tab="upload">Upload New</button>
                            </div>

                            <!-- Browse Content -->
                            <div id="media-tab-browse" class="flex-1 overflow-y-auto p-8 media-scroll flex flex-col">
                                <div id="media-library-grid" class="media-grid">
                                    <!-- AJAX loaded items -->
                                    <div class="col-span-full py-20 text-center text-gray-500">
                                        <i class="fas fa-circle-notch fa-spin text-3xl mb-4 text-orange-600"></i>
                                        <p>Loading your media...</p>
                                    </div>
                                </div>
                                <div id="media-pagination" class="pagination-container mt-auto pt-6">
                                    <!-- Pagination logic -->
                                </div>
                            </div>

                            <!-- Upload Content -->
                            <div id="media-tab-upload" class="hidden flex-1 p-8">
                                <div id="media-dropzone" class="w-full h-full border-2 border-dashed border-gray-800 rounded-3xl flex flex-col items-center justify-center p-12 hover:border-orange-600/50 hover:bg-orange-600/5 transition-all text-center">
                                    <div class="w-20 h-20 bg-orange-600/10 rounded-full flex items-center justify-center text-orange-600 mb-6 transform group-hover:scale-110 transition-transform">
                                        <i class="fas fa-cloud-upload-alt text-3xl"></i>
                                    </div>
                                    <h4 class="text-2xl font-bold text-white mb-2">Drag and drop images here</h4>
                                    <p class="text-gray-500 mb-8 max-w-sm">Upload multiple images at once. Supported formats: JPG, PNG, WEBP (Max 5MB per file)</p>
                                    <input type="file" id="media-file-input" multiple class="hidden">
                                    <button id="media-upload-btn" class="bg-orange-600 hover:bg-orange-700 text-white px-10 py-4 rounded-xl font-bold uppercase tracking-wider transition-all shadow-xl shadow-orange-600/20 active:scale-95">
                                        Select Files
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Info Sidebar Area -->
                        <div class="media-sidebar w-80 flex flex-col bg-gray-900/40 p-6">
                            <h4 class="text-gray-500 text-[11px] font-black uppercase tracking-widest mb-6">Attachment Details</h4>
                            <div id="media-details" class="flex-1 text-center py-20 text-gray-500 italic text-sm">
                                <p>Select an image to view details</p>
                            </div>
                        </div>
                    </div>

                    <!-- Modal Footer -->
                    <div class="px-8 py-5 border-t border-gray-800 bg-gray-900/50 flex items-center justify-between">
                        <div id="media-selection-info" class="text-sm text-gray-400">
                            No files selected
                        </div>
                        <div class="flex items-center space-x-4">
                            <button id="media-cancel-btn" class="px-8 py-3 rounded-xl text-gray-400 font-bold hover:text-white transition-all">Cancel</button>
                            <button id="media-select-btn" disabled class="bg-orange-600 hover:bg-orange-700 disabled:opacity-30 disabled:hover:bg-orange-600 text-white px-10 py-3 rounded-xl font-black uppercase tracking-widest transition-all">
                                Select
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        document.body.insertAdjacentHTML('beforeend', modalHTML);
    },

    bindEvents: function() {
        const _this = this;

        // Close Modal
        document.getElementById('close-media-modal').onclick = () => this.close();
        document.getElementById('media-cancel-btn').onclick = () => this.close();
        
        // Tab Switching
        document.querySelectorAll('.media-tab').forEach(tab => {
            tab.onclick = function() {
                const target = this.dataset.tab;
                document.querySelectorAll('.media-tab').forEach(t => {
                    t.classList.remove('border-orange-600', 'text-orange-600');
                    t.classList.add('border-transparent', 'text-gray-400');
                });
                this.classList.add('border-orange-600', 'text-orange-600');
                this.classList.remove('border-transparent', 'text-gray-400');

                document.getElementById('media-tab-browse').classList.toggle('hidden', target !== 'browse');
                document.getElementById('media-tab-upload').classList.toggle('hidden', target !== 'upload');
                
                if (target === 'browse') _this.loadMedia();
            };
        });

        // Upload Handling
        const dropzone = document.getElementById('media-dropzone');
        const fileInput = document.getElementById('media-file-input');
        
        document.getElementById('media-upload-btn').onclick = () => fileInput.click();
        
        fileInput.onchange = function() {
            _this.uploadFiles(this.files);
        };

        dropzone.ondragover = function(e) {
            e.preventDefault();
            this.classList.add('border-orange-600', 'bg-orange-600/5');
        };

        dropzone.ondragleave = function(e) {
            e.preventDefault();
            this.classList.remove('border-orange-600', 'bg-orange-600/5');
        };

        dropzone.ondrop = function(e) {
            e.preventDefault();
            this.classList.remove('border-orange-600', 'bg-orange-600/5');
            _this.uploadFiles(e.dataTransfer.files);
        };

        // Selection
        document.getElementById('media-select-btn').onclick = () => {
            if (_this.callback && _this.selectedItems.length > 0) {
                _this.callback(_this.options.multiple ? _this.selectedItems : _this.selectedItems[0]);
                _this.close();
            }
        };
    },

    open: function(options, callback) {
        this.options = { ...this.options, ...options };
        this.callback = callback;
        this.selectedItems = [];
        this.currentPage = 1;
        this.init();
        this.modal.classList.remove('hidden');
        this.modal.classList.add('flex');
        this.loadMedia(1);
        this.updateSelection();
    },

    close: function() {
        if (this.modal) {
            this.modal.classList.add('hidden');
            this.modal.classList.remove('flex');
        }
    },

    loadMedia: function(page = 1) {
        this.currentPage = page;
        const grid = document.getElementById('media-library-grid');
        const pagination = document.getElementById('media-pagination');
        const adminUrl = window.VIVA_ADMIN_URL || '/VIVA/admin';
        
        fetch(`${adminUrl}/api/media.php?action=fetch&page=${page}&limit=${this.itemsPerPage}`)
            .then(res => {
                if (!res.ok) throw new Error(`HTTP error! status: ${res.status}`);
                return res.json();
            })
            .then(res => {
                if (res.success) {
                    if (res.data.length === 0) {
                        grid.innerHTML = `<div class="col-span-full py-20 text-center text-gray-500 italic">Your library is empty.</div>`;
                        pagination.innerHTML = '';
                        return;
                    }

                    grid.innerHTML = res.data.map(item => `
                        <div class="media-item rounded-xl group ${this.selectedItems.find(i => i.id == item.id) ? 'selected' : ''}" 
                             data-id="${item.id}" data-path="${item.file_path}" data-name="${item.file_name}">
                            <div class="image-container">
                                <img src="${adminUrl}/../${item.file_path}" alt="${item.file_name}">
                            </div>
                            <div class="item-footer">
                                <div class="filename">${item.file_name}</div>
                            </div>
                        </div>
                    `).join('');

                    this.renderPagination(res.pagination);
                    this.bindItemEvents();
                } else {
                    grid.innerHTML = `<div class="col-span-full py-20 text-center text-red-500 italic">Error: ${res.message}</div>`;
                }
            })
            .catch(err => {
                console.error('Media Library Error:', err);
                grid.innerHTML = `
                    <div class="col-span-full py-20 text-center">
                        <i class="fas fa-exclamation-triangle text-3xl text-red-500 mb-4"></i>
                        <p class="text-red-500 font-bold">Failed to load media</p>
                        <p class="text-xs text-gray-600 mt-2">${err.message}</p>
                        <button onclick="MediaManager.loadMedia(${page})" class="mt-6 px-6 py-2 bg-orange-600/10 text-orange-600 border border-orange-600/30 rounded-lg hover:bg-orange-600 hover:text-white transition-all text-xs font-bold uppercase">Retry</button>
                    </div>
                `;
            });
    },

    renderPagination: function(meta) {
        const container = document.getElementById('media-pagination');
        if (!meta || meta.pages <= 1) {
            container.innerHTML = '';
            return;
        }

        let html = '';
        
        // Previous
        html += `<button class="page-btn ${meta.page <= 1 ? 'disabled' : ''}" 
                 ${meta.page <= 1 ? 'disabled' : ''} onclick="MediaManager.loadMedia(${meta.page - 1})">
                 Prev</button>`;

        // Pages
        for (let i = 1; i <= meta.pages; i++) {
            if (i === 1 || i === meta.pages || (i >= meta.page - 1 && i <= meta.page + 1)) {
                html += `<button class="page-btn ${meta.page === i ? 'active' : ''}" onclick="MediaManager.loadMedia(${i})">${i}</button>`;
            } else if (i === meta.page - 2 || i === meta.page + 2) {
                html += `<span class="px-1 text-gray-600">...</span>`;
            }
        }

        // Next
        html += `<button class="page-btn next ${meta.page >= meta.pages ? 'disabled' : ''}" 
                 ${meta.page >= meta.pages ? 'disabled' : ''} onclick="MediaManager.loadMedia(${meta.page + 1})">
                 Next &raquo;</button>`;

        container.innerHTML = html;
    },

    bindItemEvents: function() {
        const _this = this;
        document.querySelectorAll('.media-item').forEach(item => {
            item.onclick = function() {
                const id = this.dataset.id;
                const path = this.dataset.path;
                const name = this.dataset.name;

                if (_this.options.multiple) {
                    const idx = _this.selectedItems.findIndex(i => i.id == id);
                    if (idx > -1) {
                        _this.selectedItems.splice(idx, 1);
                        this.classList.remove('selected');
                    } else {
                        _this.selectedItems.push({ id, path, name });
                        this.classList.add('selected');
                    }
                } else {
                    document.querySelectorAll('.media-item').forEach(i => i.classList.remove('selected'));
                    _this.selectedItems = [{ id, path, name }];
                    this.classList.add('selected');
                }

                _this.updateSelection();
                _this.showDetails(_this.selectedItems[_this.selectedItems.length - 1]);
            };
        });
    },

    updateSelection: function() {
        const btn = document.getElementById('media-select-btn');
        const info = document.getElementById('media-selection-info');
        
        if (this.selectedItems.length > 0) {
            btn.disabled = false;
            info.innerText = `${this.selectedItems.length} file(s) selected`;
        } else {
            btn.disabled = true;
            info.innerText = `No files selected`;
        }
    },

    showDetails: function(item) {
        if (!item) return;
        const sidebar = document.getElementById('media-details');
        const adminUrl = window.VIVA_ADMIN_URL || '/VIVA/admin';
        sidebar.innerHTML = `
            <div class="space-y-6">
                <div class="p-4 bg-black rounded-xl border border-gray-800">
                    <img src="${adminUrl}/../${item.path}" class="max-w-full h-auto rounded-lg">
                </div>
                <div class="text-left space-y-4">
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest pl-1 mb-1">Filname</label>
                        <div class="text-xs text-white break-all bg-white/5 p-2 rounded border border-gray-800">${item.name}</div>
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-gray-500 uppercase tracking-widest pl-1 mb-1">URL / Path</label>
                        <div class="text-[10px] font-mono text-gray-400 break-all bg-black p-2 rounded border border-gray-800">${item.path}</div>
                    </div>
                </div>
                <button onclick="MediaManager.deleteItem(${item.id})" class="w-full py-3 text-xs font-bold text-red-500 hover:text-white hover:bg-red-500/20 border border-red-500/30 rounded-lg transition-all">
                    Permanently Delete
                </button>
            </div>
        `;
    },

    uploadFiles: function(files) {
        if (!files.length) return;
        
        const formData = new FormData();
        for (let i = 0; i < files.length; i++) {
            formData.append('files[]', files[i]);
        }

        const dropzone = document.getElementById('media-dropzone');
        const originalContent = dropzone.innerHTML;
        
        dropzone.innerHTML = `
            <div class="text-center">
                <i class="fas fa-circle-notch fa-spin text-4xl text-orange-600 mb-4"></i>
                <p class="text-white font-bold">Uploading ${files.length} file(s)...</p>
            </div>
        `;

        fetch(window.VIVA_ADMIN_URL + '/api/media.php?action=upload', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                document.querySelector('.media-tab[data-tab="browse"]').click();
            } else {
                alert(res.errors ? res.errors.join('\n') : res.message);
                dropzone.innerHTML = originalContent;
                this.bindEvents();
            }
        });
    },

    deleteItem: function(id) {
        if (!confirm('Are you sure you want to delete this image permanently?')) return;
        
        const formData = new FormData();
        formData.append('id', id);

        fetch(window.VIVA_ADMIN_URL + '/api/media.php?action=delete', {
            method: 'POST',
            body: formData
        })
        .then(res => res.json())
        .then(res => {
            if (res.success) {
                this.loadMedia();
                document.getElementById('media-details').innerHTML = '<p>Select an image to view details</p>';
                this.selectedItems = [];
                this.updateSelection();
            }
        });
        document.getElementById('media-sync-btn').onclick = () => this.syncMedia();
    },

    syncMedia: function() {
        const btn = document.getElementById('media-sync-btn');
        const icon = btn.querySelector('i');
        const grid = document.getElementById('media-library-grid');
        
        icon.classList.add('fa-spin');
        btn.disabled = true;
        
        grid.innerHTML = `
            <div class="col-span-full py-20 text-center">
                <i class="fas fa-cog fa-spin text-4xl text-orange-600 mb-4"></i>
                <p class="text-white font-bold">Synchronizing Machine Assets...</p>
                <p class="text-xs text-gray-500 mt-2 italic">Scanning folders and indexing files...</p>
            </div>
        `;

        const adminUrl = window.VIVA_ADMIN_URL || '/VIVA/admin';
        fetch(adminUrl + '/sync_media.php')
            .then(res => res.text())
            .then(text => {
                console.log('Sync result:', text);
                this.loadMedia();
                icon.classList.remove('fa-spin');
                btn.disabled = false;
            })
            .catch(err => {
                console.error('Sync error:', err);
                this.loadMedia();
                icon.classList.remove('fa-spin');
                btn.disabled = false;
            });
    }
};

// Initialize on page load
document.addEventListener('DOMContentLoaded', () => MediaManager.init());
