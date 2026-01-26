@extends('student.layouts.app')

@section('page-title', 'Materials')
@section('page-subtitle', 'Access your learning resources and downloadable materials')

@section('styles')
<style>
    .filter-tabs {
        display: flex;
        gap: 1rem;
        margin-bottom: 2rem;
        background: white;
        padding: 0.5rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        flex-wrap: wrap;
    }
    
    .filter-tab {
        padding: 0.75rem 1.5rem;
        border: none;
        background: transparent;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        color: #64748B;
    }
    
    .filter-tab.active {
        background: #00B86B;
        color: white;
    }
    
    .materials-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 1.5rem;
    }
    
    .material-card {
        background: white;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        overflow: hidden;
        transition: all 0.2s;
    }
    
    .material-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.1);
    }
    
    .material-preview {
        height: 180px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
    }
    
    .file-icon {
        font-size: 4rem;
    }
    
    .material-type-badge {
        position: absolute;
        top: 1rem;
        right: 1rem;
        padding: 0.35rem 0.75rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 700;
        background: white;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    
    .material-body {
        padding: 1.5rem;
    }
    
    .material-title {
        font-size: 1.05rem;
        font-weight: 700;
        color: #1E293B;
        margin-bottom: 0.5rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    
    .material-meta {
        display: flex;
        align-items: center;
        gap: 1rem;
        color: #64748B;
        font-size: 0.85rem;
        margin-bottom: 1rem;
    }
    
    .material-category {
        display: inline-block;
        padding: 0.35rem 0.75rem;
        border-radius: 12px;
        font-size: 0.8rem;
        font-weight: 600;
        margin-bottom: 1rem;
    }
    
    .category-grammar {
        background: #DBEAFE;
        color: #2563EB;
    }
    
    .category-vocabulary {
        background: #D1FAE5;
        color: #059669;
    }
    
    .category-reading {
        background: #FCE7F3;
        color: #BE185D;
    }
    
    .category-listening {
        background: #E0E7FF;
        color: #6366F1;
    }
    
    .category-business {
        background: #FEF3C7;
        color: #D97706;
    }
    
    .download-btn {
        width: 100%;
        padding: 0.75rem;
        border: none;
        background: #00B86B;
        color: white;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 0.5rem;
    }
    
    .download-btn:hover {
        background: #00A060;
        transform: translateY(-2px);
    }
    
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 4rem 2rem;
        background: white;
        border-radius: 12px;
    }
    
    .empty-icon {
        font-size: 4rem;
        margin-bottom: 1rem;
    }
    
    @media (max-width: 768px) {
        .materials-grid {
            grid-template-columns: 1fr;
        }
        
        .filter-tabs {
            overflow-x: auto;
        }
    }
</style>
@endsection

@section('content')
<div class="filter-tabs">
    <button class="filter-tab active">All Materials</button>
    <button class="filter-tab">Grammar</button>
    <button class="filter-tab">Vocabulary</button>
    <button class="filter-tab">Reading</button>
    <button class="filter-tab">Listening</button>
    <button class="filter-tab">Business</button>
</div>

<div class="materials-grid">
    @forelse($materials as $index => $material)
        @php
            $categories = ['grammar', 'vocabulary', 'reading', 'listening', 'business'];
            $categoryClass = 'category-' . $categories[$index % 5];
            $categoryName = ucfirst($categories[$index % 5]);
            
            $colors = [
                ['bg' => '#DBEAFE', 'icon' => '#2563EB'],
                ['bg' => '#D1FAE5', 'icon' => '#059669'],
                ['bg' => '#FCE7F3', 'icon' => '#BE185D'],
                ['bg' => '#E0E7FF', 'icon' => '#6366F1'],
                ['bg' => '#FEF3C7', 'icon' => '#D97706']
            ];
            $color = $colors[$index % 5];
        @endphp
        
        <div class="material-card">
            <div class="material-preview" style="background: {{ $color['bg'] }};">
                <div class="file-icon" style="color: {{ $color['icon'] }};">📄</div>
                <div class="material-type-badge" style="color: {{ $color['icon'] }};">PDF</div>
            </div>
            
            <div class="material-body">
                <h3 class="material-title">{{ $material->title }}</h3>
                
                <div class="material-meta">
                    <span>{{ $material->formatted_file_size }}</span>
                    <span>•</span>
                    <span>{{ $material->created_at->format('M d, Y') }}</span>
                </div>
                
                <div class="material-category {{ $categoryClass }}">
                    {{ $material->category ?? $categoryName }}
                </div>
                
                <a href="{{ route('student.materials.download', $material->id) }}" class="download-btn">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                        <polyline points="7 10 12 15 17 10"></polyline>
                        <line x1="12" y1="15" x2="12" y2="3"></line>
                    </svg>
                    Download
                </a>
            </div>
        </div>
    @empty
        <div class="empty-state">
            <div class="empty-icon">📚</div>
            <h3 style="color: #1E293B; margin-bottom: 0.5rem;">No materials available yet</h3>
            <p style="color: #94A3B8;">Your learning materials will appear here once shared by your teachers</p>
        </div>
    @endforelse
</div>
@endsection
