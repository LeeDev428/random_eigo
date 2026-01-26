@extends('admin.layouts.app')

@section('page-title', __('messages.lesson_materials'))
@section('page-subtitle', date('l, F d, Y'))

@section('styles')
<style>
    .materials-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
    }
    
    .materials-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1E293B;
    }
    
    .upload-btn {
        background: #00B86B;
        color: white;
        border: none;
        padding: 0.75rem 1.5rem;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    
    .upload-btn:hover {
        background: #00915A;
    }
    
    .category-tabs {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
    }
    
    .category-tab {
        padding: 0.5rem 1.5rem;
        border-radius: 20px;
        background: white;
        border: 2px solid #E2E8F0;
        color: #64748B;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .category-tab.active {
        background: #00B86B;
        color: white;
        border-color: #00B86B;
    }
    
    .category-tab:hover {
        border-color: #00B86B;
    }
    
    .materials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
        gap: 1.5rem;
    }
    
    .material-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
    }
    
    .material-header {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    
    .file-icon {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .file-icon.yellow {
        background: #FEF3C7;
        color: #F59E0B;
    }
    
    .file-icon.blue {
        background: #DBEAFE;
        color: #3B82F6;
    }
    
    .file-icon.pink {
        background: #FCE7F3;
        color: #EC4899;
    }
    
    .file-icon.green {
        background: #D1FAE5;
        color: #10B981;
    }
    
    .file-icon.orange {
        background: #FFEDD5;
        color: #F97316;
    }
    
    .material-info {
        flex: 1;
    }
    
    .material-title {
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 0.25rem;
        font-size: 1rem;
    }
    
    .material-meta {
        color: #64748B;
        font-size: 0.85rem;
    }
    
    .material-actions {
        display: flex;
        gap: 0.5rem;
    }
    
    .action-btn {
        flex: 1;
        padding: 0.75rem;
        border-radius: 8px;
        border: none;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }
    
    .open-btn {
        background: #00B86B;
        color: white;
    }
    
    .open-btn:hover {
        background: #00915A;
    }
    
    .download-btn {
        background: #F1F5F9;
        color: #64748B;
        padding: 0.75rem;
        width: 48px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .download-btn:hover {
        background: #E2E8F0;
    }
    
    /* Upload Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        z-index: 1000;
        align-items: center;
        justify-content: center;
    }
    
    .modal.active {
        display: flex;
    }
    
    .modal-content {
        background: white;
        border-radius: 12px;
        padding: 2rem;
        max-width: 500px;
        width: 90%;
    }
    
    .modal-header {
        font-size: 1.3rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
    }
    
    .form-group {
        margin-bottom: 1.5rem;
    }
    
    .form-label {
        display: block;
        margin-bottom: 0.5rem;
        font-weight: 600;
        color: #1E293B;
    }
    
    .form-input, .form-select {
        width: 100%;
        padding: 0.75rem;
        border: 1px solid #E2E8F0;
        border-radius: 8px;
        font-size: 1rem;
    }
    
    .form-actions {
        display: flex;
        gap: 1rem;
    }
    
    .submit-btn {
        flex: 1;
        padding: 0.75rem;
        background: #00B86B;
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }
    
    .cancel-btn {
        flex: 1;
        padding: 0.75rem;
        background: #F1F5F9;
        color: #64748B;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
    }
    
    @media (max-width: 768px) {
        .materials-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endsection

@section('content')
<div class="materials-header">
    <h2 class="materials-title">Lesson Materials</h2>
    
    <button class="upload-btn" onclick="openUploadModal()">
        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="12" y1="5" x2="12" y2="19"></line>
            <line x1="5" y1="12" x2="19" y2="12"></line>
        </svg>
        Upload Material
    </button>
</div>

<div class="category-tabs">
    <a href="{{ route('admin.materials') }}" class="category-tab {{ $category === 'all' ? 'active' : '' }}">
        All Materials
    </a>
    @foreach($categories as $cat)
        <a href="{{ route('admin.materials', ['category' => $cat]) }}" 
           class="category-tab {{ $category === $cat ? 'active' : '' }}">
            {{ $cat }}
        </a>
    @endforeach
</div>

<div class="materials-grid">
    @php
        $icons = ['yellow', 'blue', 'pink', 'green', 'orange'];
    @endphp
    
    @forelse($materials as $index => $material)
        <div class="material-card">
            <div class="material-header">
                <div class="file-icon {{ $icons[$index % count($icons)] }}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                    </svg>
                </div>
                
                <div class="material-info">
                    <div class="material-title">{{ $material->title }}</div>
                    <div class="material-meta">
                        Added {{ $material->created_at->format('M d, Y') }} • {{ $material->formatted_file_size }}
                    </div>
                </div>
            </div>
            
            <div class="material-actions">
                <a href="{{ Storage::url($material->file_path) }}" target="_blank" class="action-btn open-btn">
                    Open
                </a>
                <a href="{{ Storage::url($material->file_path) }}" download class="action-btn download-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                </a>
            </div>
        </div>
    @empty
        <div style="grid-column: 1/-1; text-align: center; padding: 3rem; color: #94A3B8;">
            No materials uploaded yet.
        </div>
    @endforelse
</div>

<!-- Upload Modal -->
<div class="modal" id="uploadModal">
    <div class="modal-content">
        <h3 class="modal-header">Upload New Material</h3>
        
        <form action="{{ route('admin.materials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-input" required>
            </div>
            
            <div class="form-group">
                <label class="form-label">Category</label>
                <select name="category" class="form-select" required>
                    @foreach($categories as $cat)
                        <option value="{{ $cat }}">{{ $cat }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="form-group">
                <label class="form-label">File</label>
                <input type="file" name="file" class="form-input" required>
            </div>
            
            <div class="form-actions">
                <button type="button" class="cancel-btn" onclick="closeUploadModal()">Cancel</button>
                <button type="submit" class="submit-btn">Upload</button>
            </div>
        </form>
    </div>
</div>

<script>
function openUploadModal() {
    document.getElementById('uploadModal').classList.add('active');
}

function closeUploadModal() {
    document.getElementById('uploadModal').classList.remove('active');
}

// Close modal when clicking outside
document.getElementById('uploadModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeUploadModal();
    }
});
</script>
@endsection
