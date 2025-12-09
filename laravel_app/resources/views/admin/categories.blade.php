@extends('layouts.app')

@section('title', 'Manage Categories - MyDispatch Admin')
@section('body_class', 'admin-page')

@section('content')
    <div class="container" style="padding: 2rem 20px;">
        <div class="section-header"
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <h1 class="h2">Manage Categories</h1>
                <p class="text-gray-400">Create and manage service categories</p>
            </div>
            <button onclick="openModal('addCategoryModal')" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Category
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success"
                style="background: rgba(34, 197, 94, 0.1); border: 1px solid rgba(34, 197, 94, 0.2); color: #22c55e; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1.5rem;">
                <i class="fas fa-check-circle"></i> {{ session('success') }}
            </div>
        @endif

        <div class="card">
            <table class="admin-table">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Description</th>
                        <th>Icon</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                        <tr>
                            <td>
                                <div style="display: flex; align-items: center; gap: 0.75rem;">
                                    <div
                                        style="width: 36px; height: 36px; background: {{ $category->color }}20; color: {{ $category->color }}; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                        <i class="fas {{ $category->icon ?? 'fa-folder' }}"></i>
                                    </div>
                                    <span style="font-weight: 500;">{{ $category->name }}</span>
                                </div>
                            </td>
                            <td style="color: #737373;">{{ Str::limit($category->description, 50) }}</td>
                            <td><code
                                    style="background: rgba(255,255,255,0.05); padding: 0.25rem 0.5rem; border-radius: 4px;">{{ $category->icon }}</code>
                            </td>
                            <td>
                                <span class="status-badge {{ $category->is_active ? 'active' : 'inactive' }}">
                                    {{ $category->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td>
                                <form action="{{ route('admin.categories.destroy', $category) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline btn-sm"
                                        style="padding: 0.5rem 0.75rem; color: #ef4444; border-color: rgba(239, 68, 68, 0.3);"
                                        onclick="return confirm('Delete this category?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 3rem; color: #525252;">
                                <i class="fas fa-folder-open" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                                No categories yet. Click "Add Category" to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $categories->links() }}
    </div>

    <!-- Add Category Modal -->
    <div id="addCategoryModal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Category</h3>
                <button onclick="closeModal('addCategoryModal')" class="modal-close">&times;</button>
            </div>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-input" placeholder="e.g., Freight Services" required>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-input" rows="3"
                            placeholder="Brief description of this category"></textarea>
                    </div>
                    <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label class="form-label">Icon (Font Awesome)</label>
                            <input type="text" name="icon" class="form-input" placeholder="fa-truck" value="fa-folder">
                        </div>
                        <div class="form-group">
                            <label class="form-label">Color</label>
                            <input type="color" name="color" class="form-input" value="#8b5cf6" style="height: 42px;">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="closeModal('addCategoryModal')" class="btn btn-outline">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Category</button>
                </div>
            </form>
        </div>
    </div>
@endsection