@extends('frontend.layouts.user_panel')

@section('panel_content')
    <style>
        .ecm-ticket-detail{background:#fff;border:1px solid #e7edf3;border-radius:8px;overflow:hidden;box-shadow:0 8px 22px rgba(17,24,39,.045)}
        .ecm-ticket-detail-header{padding:20px;border-bottom:1px solid #edf2f7}
        .ecm-ticket-detail-title{color:#111827;font-size:20px;font-weight:800;line-height:1.3;margin:0;overflow-wrap:anywhere}
        .ecm-ticket-meta{align-items:center;display:flex;flex-wrap:wrap;gap:8px;margin-top:12px}
        .ecm-ticket-meta-name{color:#111827;font-size:13px;font-weight:800}.ecm-ticket-meta-date{color:#64748b;font-size:12px;font-weight:700}
        .ecm-ticket-status{background:#f1f5f9;border-radius:999px;color:#475569;display:inline-flex;font-size:12px;font-weight:800;min-height:28px;padding:7px 12px}
        .ecm-ticket-detail-body{padding:20px}
        .ecm-ticket-reply-box{background:#f8fafc;border:1px solid #edf2f7;border-radius:8px;margin-bottom:18px;padding:14px}
        .ecm-ticket-message{border-bottom:1px solid #edf2f7;padding:14px 0}.ecm-ticket-message:last-child{border-bottom:0}
        .ecm-ticket-message-head{align-items:flex-start;display:flex;gap:10px;margin-bottom:10px}
        .ecm-ticket-message-body{color:#111827;font-size:14px;line-height:1.55;overflow-wrap:anywhere}
        .ecm-ticket-message-body img{height:auto;max-width:100%}
        @media(max-width:767.98px){.ecm-ticket-detail{border-left:0;border-right:0;border-radius:0;margin:0 -15px 76px}.ecm-ticket-detail-header{padding:16px 12px}.ecm-ticket-detail-title{font-size:18px}.ecm-ticket-detail-body{padding:12px}.ecm-ticket-reply-box{padding:12px}.ecm-ticket-meta{display:grid;grid-template-columns:1fr;gap:6px}.ecm-ticket-message{background:#fff;border:1px solid #edf2f7;border-radius:12px;margin-bottom:10px;padding:12px}.ecm-ticket-message:last-child{border-bottom:1px solid #edf2f7}.ecm-ticket-message-head{gap:8px}.ecm-ticket-detail .w-150px{width:100%!important}.ecm-ticket-detail .form-group.mb-0.text-right{text-align:stretch!important}}
    </style>

    <div class="ecm-ticket-detail">
        <!-- Ticket info -->
        <div class="ecm-ticket-detail-header">
            <div class="text-center text-md-left">
                <h5 class="ecm-ticket-detail-title">{{ $ticket->subject }} #{{ $ticket->code }}</h5>
               <div class="ecm-ticket-meta">
                   <span class="ecm-ticket-meta-name">{{ $ticket->user->name }}</span>
                   <span class="ecm-ticket-meta-date">{{ $ticket->created_at }}</span>
                   <span class="ecm-ticket-status">{{ translate(ucfirst($ticket->status)) }}</span>
               </div>
            </div>
        </div>
        
        <div class="ecm-ticket-detail-body">
            <!-- Reply form -->
            <form class="ecm-ticket-reply-box" action="{{route('support_ticket.seller_store')}}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="ticket_id" value="{{$ticket->id}}" required>
                <input type="hidden" name="user_id" value="{{$ticket->user_id}}">
                <div class="form-group">
                    <textarea class="aiz-text-editor rounded-0" name="reply" data-buttons='[["font", ["bold", "underline", "italic"]],["para", ["ul", "ol"]],["view", ["undo","redo"]]]' required></textarea>
                </div>
                <div class="form-group row">
                    <div class="col-md-12">
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                            <div class="input-group-prepend">
                                <div class="input-group-text bg-soft-secondary font-weight-medium rounded-0">{{ translate('Browse')}}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="attachments" class="selected-files">
                        </div>
                        <div class="file-preview box sm">
                        </div>
                    </div>
                </div>
                <div class="form-group mb-0 text-right">
                    <button type="submit" class="btn btn-sm btn-primary rounded-0 w-150px" onclick="submit_reply('pending')">{{ translate('Send Reply') }}</button>
                </div>
            </form>
            
            <div class="pad-top">
                <ul class="list-group list-group-flush mt-3">
                    <!-- Replies -->
                    @foreach($ticket->ticketreplies as $ticketreply)
                        <li class="list-group-item px-0 border-bottom-0 ecm-ticket-message">
                            <div class="media ecm-ticket-message-head">
                                <a class="media-left" href="#">
                                    @if($ticketreply->user->avatar_original != null)
                                        <span class="avatar avatar-sm mr-3">
                                            <img src="{{ uploaded_asset($ticketreply->user->avatar_original) }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                                        </span>
                                    @else
                                        <span class="avatar avatar-sm mr-3">
                                            <img src="{{ static_asset('assets/img/avatar-place.png') }}">
                                        </span>
                                    @endif
                                </a>
                                <div class="media-body">
                                    <div class="comment-header">
                                        <span class="fs-14 fw-700 text-dark">{{ $ticketreply->user->name }}</span>
                                        <p class="text-muted text-sm fs-12 mt-2">{{ date('d.m.Y h:i:m', strtotime($ticketreply->created_at)) }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="ecm-ticket-message-body">
                                {!! $ticketreply->reply !!}
                                <br>
                                <br>
                                @foreach ((explode(",",$ticketreply->files)) as $key => $file)
                                    @php $file_detail = get_single_uploaded_file($file) @endphp
                                    @if($file_detail != null)
                                        <a href="{{ uploaded_asset($file) }}" download="" class="badge badge-lg badge-inline badge-light mb-1">
                                            <i class="las la-download text-muted">{{ $file_detail->file_original_name.'.'.$file_detail->extension }}</i>
                                        </a>
                                        <br>
                                    @endif
                                @endforeach
                            </div>
                        </li>
                    @endforeach

                    <!-- Ticket Details -->
                    <li class="list-group-item px-0 ecm-ticket-message">
                        <div class="media ecm-ticket-message-head">
                            <a class="media-left" href="#">
                                @if($ticket->user->avatar_original != null)
                                    <span class="avatar avatar-sm mr-3">
                                        <img src="{{ uploaded_asset($ticket->user->avatar_original) }}" onerror="this.onerror=null;this.src='{{ static_asset('assets/img/avatar-place.png') }}';">
                                    </span>
                                @else
                                    <span class="avatar avatar-sm mr-3">
                                        <img src="{{ static_asset('assets/img/avatar-place.png') }}">
                                    </span>
                                @endif
                            </a>
                            <div class="media-body">
                                <div class="comment-header">
                                    <span class="fs-14 fw-700 text-dark">{{ $ticket->user->name }}</span>
                                    <p class="text-muted text-sm fs-12 mt-2">{{ date('d.m.Y h:i:m', strtotime($ticket->created_at)) }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="ecm-ticket-message-body">
                            {!! $ticket->details !!}
                            <br>
                            <br>
                            @foreach ((explode(",",$ticket->files)) as $key => $file)
                                @php $file_detail = get_single_uploaded_file($file) @endphp
                                @if($file_detail != null)
                                    <a href="{{ uploaded_asset($file) }}" download="" class="badge badge-lg badge-inline badge-light mb-1">
                                        <i class="las la-download text-muted">{{ $file_detail->file_original_name.'.'.$file_detail->extension }}</i>
                                    </a>
                                    <br>
                                @endif
                            @endforeach
                        </div>
                    </li>
                    
                </ul>
            </div>

        </div>
    </div>
@endsection
