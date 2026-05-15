@extends('frontend.layouts.user_panel')

@section('panel_content')
    <style>
        .ecm-page-panel{background:#fff;border:1px solid #edf2f7;border-radius:20px;padding:24px}
        .ecm-page-title{font-size:18px;font-weight:800;margin:0;color:#1e293b}
        .ecm-page-subtitle{color:#64748b;font-size:14px;margin:4px 0 0}
        .ecm-conversation-list{display:grid;gap:14px}
        .ecm-conversation-item{align-items:flex-start;background:#f8fbfe;border:1.5px solid #e3f3fb;border-radius:14px;display:grid;gap:16px;grid-template-columns:auto 1fr auto;padding:18px;transition:box-shadow .25s ease,transform .25s ease,border-color .25s ease}
        .ecm-conversation-item:hover{border-color:#3c9bd3;box-shadow:0 10px 36px rgba(60,155,211,.16);transform:translateY(-2px)}
        .ecm-conversation-avatar{background:#fff;border:1px solid #edf2f7;border-radius:50%;height:54px;overflow:hidden;width:54px}
        .ecm-conversation-avatar img{height:100%;object-fit:cover;width:100%}
        .ecm-conversation-name{color:#111;font-size:14px;font-weight:800;text-decoration:none}
        .ecm-conversation-name:hover,.ecm-conversation-title:hover{color:#227eb8;text-decoration:none}
        .ecm-conversation-time{color:#94a3b8;font-size:12px;font-weight:700}
        .ecm-conversation-title{color:#1e293b;display:inline-flex;font-size:15px;font-weight:800;line-height:1.35;text-decoration:none}
        .ecm-conversation-message{color:#64748b;display:-webkit-box;font-size:14px;line-height:1.45;margin:7px 0 0;overflow:hidden;-webkit-box-orient:vertical;-webkit-line-clamp:2}
        .ecm-new-badge{background:#dc2626;border-radius:999px;color:#fff;font-size:10px;font-weight:800;margin-left:8px;padding:4px 9px;text-transform:uppercase}
        .ecm-open-link{align-items:center;background:#f0f8fd;border-radius:5px;color:#3d98d1;display:inline-flex;font-size:13px;font-weight:800;justify-content:center;min-height:38px;padding:8px 12px;text-decoration:none;white-space:nowrap}
        .ecm-open-link:hover{background:#3d98d1;color:#fff;text-decoration:none}
        .ecm-empty{background:linear-gradient(180deg,#fff,#f8fafc);border:1px solid #edf2f7;border-radius:14px;padding:54px 24px;text-align:center}
        .ecm-empty img{height:auto;max-width:180px}.ecm-empty-title{color:#1e293b;font-size:18px;font-weight:800;margin:18px 0 0}
        @media(max-width:767.98px){.ecm-page-panel{padding:20px}.ecm-conversation-item{grid-template-columns:auto 1fr}.ecm-open-link{grid-column:1 / -1;width:100%}}
    </style>

    <div class="ecm-page-panel">
        <div class="mb-3">
            <h1 class="ecm-page-title">{{ translate('Conversations')}}</h1>
            <p class="ecm-page-subtitle">{{ translate('Select a conversation to view all messages')}}</p>
        </div>

        @if (count($conversations) > 0)
            <div class="ecm-conversation-list mb-4">
                @foreach ($conversations as $key => $conversation)
                    @if ($conversation->receiver != null && $conversation->sender != null)
                        @php
                            $is_sender = Auth::user()->id == $conversation->sender_id;
                            $person = $is_sender ? $conversation->receiver : $conversation->sender;
                            $shop = $is_sender ? $conversation->receiver->shop : null;
                            $name = $shop ? $shop->name : $person->name;
                            $image = $shop ? uploaded_asset($shop->logo) : ($person->avatar_original ? uploaded_asset($person->avatar_original) : static_asset('assets/img/avatar-place.png'));
                            $last_message = $conversation->messages->last();
                            $is_new = ($is_sender && $conversation->sender_viewed == 0) || (!$is_sender && $conversation->receiver_viewed == 0);
                        @endphp
                        <div class="ecm-conversation-item">
                            <span class="ecm-conversation-avatar">
                                <img src="{{ $image }}" alt="{{ $name }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                            </span>
                            <div>
                                @if ($shop)
                                    <a href="{{ route('shop.visit', $shop->slug) }}" class="ecm-conversation-name">{{ $name }}</a>
                                @else
                                    <div class="ecm-conversation-name">{{ $name }}</div>
                                @endif
                                <div class="ecm-conversation-time">{{ $last_message ? date('d.m.Y h:i A', strtotime($last_message->created_at)) : '' }}</div>
                                <a href="{{ route('conversations.show', encrypt($conversation->id)) }}" class="ecm-conversation-title mt-2">
                                    {{ $conversation->title }}
                                    @if ($is_new)
                                        <span class="ecm-new-badge">{{ translate('New') }}</span>
                                    @endif
                                </a>
                                <p class="ecm-conversation-message">{{ $last_message ? $last_message->message : '' }}</p>
                            </div>
                            <a href="{{ route('conversations.show', encrypt($conversation->id)) }}" class="ecm-open-link">
                                {{ translate('View Details') }}
                                <i class="las la-angle-right ml-1"></i>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="ecm-empty mb-4">
                <img src="{{ static_asset('assets/img/nothing.svg') }}" alt="Image">
                <h5 class="ecm-empty-title">{{ translate("There isn't anything added yet")}}</h5>
            </div>
        @endif

        <div class="aiz-pagination">
            {{ $conversations->links() }}
        </div>
    </div>
@endsection
