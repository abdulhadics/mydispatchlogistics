@extends('layouts.app')

@section('title', 'Notifications - MyDispatch')
@section('body_class', 'notifications-page')

@section('content')
    <div class="container" style="padding: 2rem 20px;">
        <div class="section-header"
            style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
            <div>
                <h1 class="h2">Notifications</h1>
                <p class="text-gray-400">Stay updated with your account activity</p>
            </div>
            <form action="{{ route('notifications.markAllRead') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline">
                    <i class="fas fa-check-double"></i> Mark All as Read
                </button>
            </form>
        </div>

        <div class="card">
            @forelse($notifications as $notification)
                <div class="notification-item {{ $notification->is_read ? '' : 'unread' }}"
                    onclick="window.location='{{ $notification->action_url ?? '#' }}'">
                    <div class="notification-icon {{ $notification->type }}">
                        <i class="fas {{ $notification->icon }}"></i>
                    </div>
                    <div class="notification-content">
                        <div class="notification-title">{{ $notification->title }}</div>
                        <div class="notification-message">{{ $notification->message }}</div>
                        <div class="notification-time">{{ $notification->created_at->diffForHumans() }}</div>
                    </div>
                </div>
            @empty
                <div style="text-align: center; padding: 4rem 2rem; color: #525252;">
                    <i class="fas fa-bell-slash" style="font-size: 3rem; margin-bottom: 1rem; display: block;"></i>
                    <p>No notifications yet</p>
                </div>
            @endforelse
        </div>

        <div style="margin-top: 2rem;">
            {{ $notifications->links() }}
        </div>
    </div>
@endsection