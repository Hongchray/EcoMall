@extends('frontend.layouts.user_panel')

@section('panel_content')
    <style>
        .ecm-page-panel{background:#fff;border:1px solid #edf2f7;border-radius:20px;overflow:hidden}
        .ecm-page-header{align-items:center;border-bottom:1px solid #f1f5f9;display:flex;gap:16px;justify-content:space-between;padding:24px}
        .ecm-page-title{font-size:18px;font-weight:800;margin:0;color:#1e293b}
        .ecm-create-ticket{align-items:center;background:#f0f8fd;border:0;border-radius:5px;color:#3d98d1;display:inline-flex;font-size:13px;font-weight:800;gap:8px;justify-content:center;min-height:40px;padding:10px 16px;transition:.2s ease}
        .ecm-create-ticket:hover{background:#3d98d1;color:#fff}
        .ecm-ticket-table{margin-bottom:0}
        .ecm-ticket-table thead th{background:#f8fafc;border:0;color:#64748b;font-size:12px;font-weight:800;padding:16px 24px;white-space:nowrap}
        .ecm-ticket-table tbody td{border-top:0;border-bottom:1px solid #f1f5f9;padding:18px 24px;vertical-align:middle}
        .ecm-ticket-code{color:#1e293b;font-weight:800}
        .ecm-ticket-subject{color:#111;font-weight:700}
        .ecm-status{border-radius:999px;display:inline-flex;font-size:12px;font-weight:800;justify-content:center;min-width:82px;padding:8px 12px}
        .ecm-status-pending{background:#fee2e2;color:#dc2626}.ecm-status-open{background:#f1f5f9;color:#475569}.ecm-status-solved{background:#dcfce7;color:#16a34a}
        .ecm-view-link{align-items:center;background:#f0f8fd;border-radius:5px;color:#3d98d1;display:inline-flex;font-size:13px;font-weight:800;justify-content:center;min-height:38px;padding:8px 12px;text-decoration:none;white-space:nowrap}
        .ecm-view-link:hover{background:#3d98d1;color:#fff;text-decoration:none}
        .ecm-empty{background:linear-gradient(180deg,#fff,#f8fafc);padding:54px 24px;text-align:center}
        .ecm-empty img{height:auto;max-width:180px}.ecm-empty-title{color:#1e293b;font-size:18px;font-weight:800;margin:18px 0 0}
        @media(max-width:767.98px){.ecm-page-header{align-items:flex-start;flex-direction:column;padding:20px}.ecm-create-ticket{width:100%}.ecm-ticket-table thead{display:none}.ecm-ticket-table,.ecm-ticket-table tbody,.ecm-ticket-table tr,.ecm-ticket-table td{display:block;width:100%}.ecm-ticket-table tr{border-bottom:1px solid #f1f5f9;padding:16px 20px}.ecm-ticket-table tbody td{border:0;padding:5px 0;text-align:left!important}}
    </style>

    <div class="ecm-page-panel">
        <div class="ecm-page-header">
            <h1 class="ecm-page-title">{{ translate('Support Ticket') }}</h1>
            <button type="button" class="ecm-create-ticket" data-toggle="modal" data-target="#ticket_modal">
                <i class="las la-plus fs-18"></i>
                {{ translate('Create a Ticket') }}
            </button>
        </div>

        @if (count($tickets) > 0)
            <div class="table-responsive">
                <table class="table aiz-table ecm-ticket-table">
                    <thead>
                        <tr>
                            <th>{{ translate('Ticket ID') }}</th>
                            <th>{{ translate('Sending Date') }}</th>
                            <th>{{ translate('Subject')}}</th>
                            <th>{{ translate('Status')}}</th>
                            <th class="text-right">{{ translate('Options')}}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($tickets as $key => $ticket)
                            <tr>
                                <td class="ecm-ticket-code">#{{ $ticket->code }}</td>
                                <td>{{ date('Y.m.d h:i A', strtotime($ticket->created_at)) }}</td>
                                <td class="ecm-ticket-subject">{{ $ticket->subject }}</td>
                                <td>
                                    @if ($ticket->status == 'pending')
                                        <span class="ecm-status ecm-status-pending">{{ translate('Pending')}}</span>
                                    @elseif ($ticket->status == 'open')
                                        <span class="ecm-status ecm-status-open">{{ translate('Open')}}</span>
                                    @else
                                        <span class="ecm-status ecm-status-solved">{{ translate('Solved')}}</span>
                                    @endif
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('support_ticket.show', encrypt($ticket->id)) }}" class="ecm-view-link">
                                        {{ translate('View Details')}}
                                        <i class="la la-angle-right ml-1"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <div class="ecm-empty">
                <img src="{{ static_asset('assets/img/nothing.svg') }}" alt="Image">
                <h5 class="ecm-empty-title">{{ translate("There isn't anything added yet")}}</h5>
            </div>
        @endif

        <div class="p-4">
            <div class="aiz-pagination">
                {{ $tickets->links() }}
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="ticket_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title strong-600 heading-5">{{ translate('Create a Ticket')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-3 pt-3">
                    <form action="{{ route('support_ticket.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label class="fw-700">{{ translate('Subject')}}</label>
                            <input type="text" class="form-control" placeholder="{{ translate('Subject')}}" name="subject" required>
                        </div>
                        <div class="form-group">
                            <label class="fw-700">{{ translate('Provide a detailed description')}}</label>
                            <textarea type="text" class="form-control" rows="3" name="details" placeholder="{{ translate('Type your reply')}}" data-buttons="bold,underline,italic,|,ul,ol,|,paragraph,|,undo,redo" required></textarea>
                        </div>
                        <div class="form-group">
                            <label class="fw-700">{{ translate('Photo') }}</label>
                            <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                                <div class="input-group-prepend">
                                    <div class="input-group-text bg-soft-secondary font-weight-medium">{{ translate('Browse')}}</div>
                                </div>
                                <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                                <input type="hidden" name="attachments" class="selected-files">
                            </div>
                            <div class="file-preview box sm"></div>
                        </div>
                        <div class="text-right mt-4">
                            <button type="button" class="btn btn-secondary w-150px" data-dismiss="modal">{{ translate('cancel')}}</button>
                            <button type="submit" class="btn btn-primary w-150px">{{ translate('Send Ticket')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
