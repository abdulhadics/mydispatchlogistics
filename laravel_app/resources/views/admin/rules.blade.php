@extends('layouts.app')

@section('title', 'Manage Rules - MyDispatch Admin')
@section('body_class', 'admin-page')

@section('content')
    <div class="container" style="padding: 2rem 20px;">
        <div class="section-header"
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <h1 class="h2">Manage Rules</h1>
                <p class="text-gray-400">Create and manage business rules and policies</p>
            </div>
            <button onclick="openModal('addRuleModal')" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Rule
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
                        <th>Rule Name</th>
                        <th>Type</th>
                        <th>Severity</th>
                        <th>Status</th>
                        <th>Created By</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rules as $rule)
                        <tr>
                            <td>
                                <div>
                                    <span style="font-weight: 500; display: block;">{{ $rule->name }}</span>
                                    <span
                                        style="color: #525252; font-size: 0.75rem;">{{ Str::limit($rule->description, 60) }}</span>
                                </div>
                            </td>
                            <td>
                                <span style="text-transform: capitalize;">{{ $rule->type }}</span>
                            </td>
                            <td>
                                <span class="severity-badge {{ $rule->severity }}">{{ ucfirst($rule->severity) }}</span>
                            </td>
                            <td>
                                <span class="status-badge {{ $rule->is_active ? 'active' : 'inactive' }}">
                                    {{ $rule->is_active ? 'Active' : 'Inactive' }}
                                </span>
                            </td>
                            <td style="color: #737373;">{{ $rule->creator->name ?? 'System' }}</td>
                            <td>
                                <form action="{{ route('admin.rules.destroy', $rule) }}" method="POST" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-outline btn-sm"
                                        style="padding: 0.5rem 0.75rem; color: #ef4444; border-color: rgba(239, 68, 68, 0.3);"
                                        onclick="return confirm('Delete this rule?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem; color: #525252;">
                                <i class="fas fa-gavel" style="font-size: 2rem; margin-bottom: 1rem; display: block;"></i>
                                No rules defined yet. Click "Add Rule" to create one.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{ $rules->links() }}
    </div>

    <!-- Add Rule Modal -->
    <div id="addRuleModal" class="modal" style="display: none;">
        <div class="modal-content">
            <div class="modal-header">
                <h3>Add New Rule</h3>
                <button onclick="closeModal('addRuleModal')" class="modal-close">&times;</button>
            </div>
            <form action="{{ route('admin.rules.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-4">
                        <label class="form-label">Rule Name</label>
                        <input type="text" name="name" class="form-input" placeholder="e.g., Speed Limit Compliance"
                            required>
                    </div>
                    <div class="form-group mb-4">
                        <label class="form-label">Description</label>
                        <textarea name="description" class="form-input" rows="3"
                            placeholder="Detailed description of the rule" required></textarea>
                    </div>
                    <div class="form-row" style="display: grid; grid-template-columns: 1fr 1fr; gap: 1rem;">
                        <div class="form-group">
                            <label class="form-label">Type</label>
                            <select name="type" class="form-input" required>
                                <option value="safety">Safety</option>
                                <option value="compliance">Compliance</option>
                                <option value="operational">Operational</option>
                                <option value="financial">Financial</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="form-label">Severity</label>
                            <select name="severity" class="form-input" required>
                                <option value="low">Low</option>
                                <option value="medium" selected>Medium</option>
                                <option value="high">High</option>
                                <option value="critical">Critical</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" onclick="closeModal('addRuleModal')" class="btn btn-outline">Cancel</button>
                    <button type="submit" class="btn btn-primary">Create Rule</button>
                </div>
            </form>
        </div>
    </div>
@endsection