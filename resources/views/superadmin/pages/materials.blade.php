@extends('superadmin.layouts.app')

@section('page-title', __('messages.sa_materials'))
@section('page-subtitle', __('messages.sa_monitor_materials'))

@section('styles')
<style>
    .stats-row {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }
    
    .mini-stat {
        background: white;
        padding: 1.25rem;
        border-radius: 10px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
    }
    
    .mini-stat .value {
        font-size: 1.5rem;
        font-weight: 700;
        color: #1E293B;
    }
    
    .mini-stat .label {
        font-size: 0.8rem;
        color: #64748B;
        margin-top: 0.2rem;
    }
    
    .filter-bar {
        display: flex;
        gap: 0.5rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
    }
    
    .filter-btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: 1px solid #E2E8F0;
        background: white;
        color: #64748B;
        cursor: pointer;
        text-decoration: none;
        font-size: 0.85rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .filter-btn:hover { border-color: #7C3AED; color: #7C3AED; }
    .filter-btn.active { background: #7C3AED; color: white; border-color: #7C3AED; }
    
    .section-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
    }
    
    .section-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }
    
    .section-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1E293B;
    }
    
    .data-table {
        width: 100%;
        border-collapse: collapse;
    }
    
    .data-table th {
        text-align: left;
        padding: 0.75rem 0.5rem;
        font-size: 0.8rem;
        color: #64748B;
        font-weight: 600;
        border-bottom: 1px solid #E2E8F0;
        text-transform: uppercase;
    }
    
    .data-table td {
        padding: 0.75rem 0.5rem;
        font-size: 0.9rem;
        border-bottom: 1px solid #F1F5F9;
        color: #1E293B;
    }
    
    .data-table tr:hover { background: #FAFAFA; }
    
    .category-badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
        background: #EDE9FE;
        color: #7C3AED;
    }
    
    .file-size {
        color: #64748B;
        font-size: 0.85rem;
    }
    
    @media (max-width: 768px) {
        .stats-row {
            grid-template-columns: repeat(2, 1fr);
        }
    }
</style>
@endsection

@section('content')

<!-- Stats -->
<div class="stats-row">
    <div class="mini-stat">
        <div class="value">{{ $totalMaterials }}</div>
        <div class="label">{{ __('messages.sa_total_materials') }}</div>
    </div>
    @foreach($categories as $cat)
    <div class="mini-stat">
        <div class="value">{{ \App\Models\Material::where('category', $cat)->count() }}</div>
        <div class="label">{{ ucfirst($cat) }}</div>
    </div>
    @endforeach
</div>

<!-- Filters -->
<div class="filter-bar">
    <a href="{{ route('superadmin.materials') }}" class="filter-btn {{ !$category ? 'active' : '' }}">{{ __('messages.sa_all') }}</a>
    @foreach($categories as $cat)
    <a href="{{ route('superadmin.materials', ['category' => $cat]) }}" class="filter-btn {{ $category === $cat ? 'active' : '' }}">{{ ucfirst($cat) }}</a>
    @endforeach
</div>

<!-- Materials Table -->
<div class="section-card">
    <div class="section-header">
        <h3 class="section-title">{{ __('messages.sa_all_materials') }}</h3>
        <span style="font-size: 0.85rem; color: #64748B;">{{ $materials->count() }} {{ __('messages.sa_records') }}</span>
    </div>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('messages.sa_title') }}</th>
                <th>{{ __('messages.sa_category') }}</th>
                <th>{{ __('messages.sa_teacher') }}</th>
                <th>{{ __('messages.sa_file_name') }}</th>
                <th>{{ __('messages.sa_file_size') }}</th>
                <th>{{ __('messages.sa_uploaded') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($materials as $material)
            <tr>
                <td>#{{ $material->id }}</td>
                <td>{{ $material->title }}</td>
                <td><span class="category-badge">{{ ucfirst($material->category) }}</span></td>
                <td>{{ $material->teacher->name ?? '-' }}</td>
                <td>{{ $material->file_name }}</td>
                <td class="file-size">{{ $material->file_size ? number_format($material->file_size / 1024, 1) . ' KB' : '-' }}</td>
                <td>{{ $material->created_at->format('M d, Y') }}</td>
            </tr>
            @empty
            <tr><td colspan="7" style="text-align:center; color:#94A3B8; padding:2rem;">{{ __('messages.sa_no_data') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
