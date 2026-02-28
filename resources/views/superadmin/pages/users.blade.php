@extends('superadmin.layouts.app')

@section('page-title', __('messages.sa_users'))
@section('page-subtitle', __('messages.sa_manage_users'))

@section('styles')
<style>
    .filters {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
        flex-wrap: wrap;
        align-items: center;
    }
    
    .filter-btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: 1px solid #E2E8F0;
        background: white;
        color: #64748B;
        text-decoration: none;
        font-size: 0.9rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .filter-btn:hover {
        border-color: #7C3AED;
        color: #7C3AED;
    }
    
    .filter-btn.active {
        background: #7C3AED;
        color: white;
        border-color: #7C3AED;
    }
    
    .search-box {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        margin-left: auto;
    }
    
    .search-input {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: 1px solid #E2E8F0;
        font-size: 0.9rem;
        outline: none;
        width: 250px;
    }
    
    .search-input:focus {
        border-color: #7C3AED;
    }
    
    .search-btn {
        padding: 0.5rem 1rem;
        border-radius: 8px;
        border: none;
        background: #7C3AED;
        color: white;
        cursor: pointer;
        font-size: 0.9rem;
    }
    
    .section-card {
        background: white;
        padding: 1.5rem;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        border: 1px solid #E2E8F0;
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
    
    .data-table tr:hover {
        background: #FAFAFA;
    }
    
    .role-badge {
        display: inline-block;
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 600;
    }
    
    .role-admin { background: #E0F7EE; color: #00B86B; }
    .role-student { background: #DBEAFE; color: #3B82F6; }
    
    .view-btn {
        padding: 0.3rem 0.75rem;
        border-radius: 6px;
        border: 1px solid #7C3AED;
        color: #7C3AED;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .view-btn:hover {
        background: #7C3AED;
        color: white;
    }
    
    .user-count {
        color: #64748B;
        font-size: 0.9rem;
        margin-bottom: 1rem;
    }
    
    @media (max-width: 768px) {
        .filters {
            flex-direction: column;
        }
        
        .search-box {
            margin-left: 0;
            width: 100%;
        }
        
        .search-input {
            width: 100%;
        }
        
        .data-table {
            font-size: 0.85rem;
        }
    }
</style>
@endsection

@section('content')

<!-- Filters -->
<div class="filters">
    <a href="{{ route('superadmin.users', ['role' => 'all', 'search' => $search]) }}" class="filter-btn {{ $role === 'all' ? 'active' : '' }}">{{ __('messages.sa_all') }}</a>
    <a href="{{ route('superadmin.users', ['role' => 'admin', 'search' => $search]) }}" class="filter-btn {{ $role === 'admin' ? 'active' : '' }}">{{ __('messages.sa_teachers') }}</a>
    <a href="{{ route('superadmin.users', ['role' => 'student', 'search' => $search]) }}" class="filter-btn {{ $role === 'student' ? 'active' : '' }}">{{ __('messages.sa_students') }}</a>
    
    <form class="search-box" method="GET" action="{{ route('superadmin.users') }}">
        <input type="hidden" name="role" value="{{ $role }}">
        <input type="text" name="search" class="search-input" placeholder="{{ __('messages.sa_search_users') }}" value="{{ $search }}">
        <button type="submit" class="search-btn">{{ __('messages.sa_search') }}</button>
    </form>
</div>

<div class="section-card">
    <div class="user-count">{{ $users->count() }} {{ __('messages.sa_users_found') }}</div>
    <table class="data-table">
        <thead>
            <tr>
                <th>ID</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.email') }}</th>
                <th>{{ __('messages.sa_role') }}</th>
                <th>{{ __('messages.sa_joined') }}</th>
                <th>{{ __('messages.sa_action') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $user)
            <tr>
                <td>#{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td><span class="role-badge role-{{ $user->role }}">{{ $user->role === 'admin' ? 'Teacher' : ucfirst($user->role) }}</span></td>
                <td>{{ $user->created_at->format('M d, Y') }}</td>
                <td><a href="{{ route('superadmin.users.show', $user->id) }}" class="view-btn">{{ __('messages.sa_view') }}</a></td>
            </tr>
            @empty
            <tr><td colspan="6" style="text-align:center; color:#94A3B8; padding:2rem;">{{ __('messages.sa_no_data') }}</td></tr>
            @endforelse
        </tbody>
    </table>
</div>

@endsection
