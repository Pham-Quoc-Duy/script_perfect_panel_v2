@extends('clients.theme-default.layouts.app')

@section('title', 'Hỗ trợ')

@section('content')
<div class="app-content">
    <div class="page-head">
        <div class="container-fluid"></div>
        <div class="page-head-bg">
            <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev/svgjs" width="100%" height="250" preserveAspectRatio="none" viewBox="0 0 1440 250"><g mask="url(&quot;#SvgjsMask1003&quot;)" fill="none"><path d="M36 250L286 0L604 0L354 250z" fill="url(&quot;#SvgjsLinearGradient1004&quot;)"></path><path d="M258.6 250L508.6 0L634.6 0L384.6 250z" fill="url(&quot;#SvgjsLinearGradient1004&quot;)"></path><path d="M484.20000000000005 250L734.2 0L956.2 0L706.2 250z" fill="url(&quot;#SvgjsLinearGradient1004&quot;)"></path><path d="M740.8000000000001 250L990.8000000000001 0L1311.8000000000002 0L1061.8000000000002 250z" fill="url(&quot;#SvgjsLinearGradient1004&quot;)"></path><path d="M1428 250L1178 0L866 0L1116 250z" fill="url(&quot;#SvgjsLinearGradient1005&quot;)"></path><path d="M1157.4 250L907.4000000000001 0L788.9000000000001 0L1038.9 250z" fill="url(&quot;#SvgjsLinearGradient1005&quot;)"></path><path d="M961.8 250L711.8 0L572.3 0L822.3 250z" fill="url(&quot;#SvgjsLinearGradient1005&quot;)"></path><path d="M691.1999999999999 250L441.19999999999993 0L214.69999999999993 0L464.69999999999993 250z" fill="url(&quot;#SvgjsLinearGradient1005&quot;)"></path><path d="M1199.0621593075448 250L1440 9.062159307544675L1440 250z" fill="url(&quot;#SvgjsLinearGradient1004&quot;)"></path><path d="M0 250L240.93784069245532 250L 0 9.062159307544675z" fill="url(&quot;#SvgjsLinearGradient1005&quot;)"></path></g><defs><mask id="SvgjsMask1003"><rect width="1440" height="250" fill="var(--tw)"></rect></mask><linearGradient x1="0%" y1="100%" x2="100%" y2="0%" id="SvgjsLinearGradient1004"><stop stop-color="var(--mc)" offset="0"></stop><stop stop-opacity="0" stop-color="var(--main-bg)" offset="0.66"></stop></linearGradient></defs></svg>
        </div>
    </div>

    <!-- Main content -->
    <div class="container-fluid container-dashboard">
        <div class="top-box">
            <div class="top-text">
                <h4>Hỗ trợ</h4>
                <p>Quản lý tickets hỗ trợ của bạn</p>
            </div>
            <a class="btn btn-primary d-flex align-items-center" href="{{ route('client.tickets.create') }}">
                <i class="fal fa-plus me-2"></i><strong>Tạo Ticket Mới</strong>
            </a>
        </div>

        <div class="row">
            <!-- Filters -->
            <div class="col-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <form method="GET" class="row g-3">
                            <div class="col-md-6">
                                <label class="search-box ticket-search">
                                    <input type="text" class="search-box--input" name="search" 
                                           value="{{ request('search') }}" placeholder="Tìm kiếm theo tiêu đề...">
                                    <div class="search-box--icon">
                                        <i class="far fa-search"></i>
                                    </div>
                                </label>
                            </div>
                            <div class="col-md-3">
                                <select class="form-control" name="status">
                                    <option value="">Tất cả trạng thái</option>
                                    <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Đang mở</option>
                                    <option value="answered" {{ request('status') == 'answered' ? 'selected' : '' }}>Đã trả lời</option>
                                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Đã đóng</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="submit" class="btn btn-primary w-100">
                                    <i class="far fa-filter"></i> Lọc
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tickets List -->
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <i class="far fa-comment-check"></i>
                        <span>Danh sách Tickets</span>
                    </div>
                    <div class="card-body">
                        @if($tickets->count() > 0)
                            @foreach($tickets as $ticket)
                            <div class="ticket-item {{ $ticket->unread_count > 0 ? 'new-ticket' : '' }}">
                                @if($ticket->unread_count > 0)
                                    <span class="new-badge">{{ $ticket->unread_count }} tin nhắn mới</span>
                                @endif
                                
                                <div class="ticket-item-top">
                                    <div class="tit-first">
                                        <div class="ticket-id">#{{ $ticket->id }}</div>
                                        <div class="ticket-title">
                                            <span>
                                                <a href="{{ route('client.tickets.show', $ticket->id) }}">
                                                    {{ Str::limit($ticket->subject, 50) }}
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="tit-last">
                                        @if($ticket->status == 'open')
                                            <div class="oc-status pending"><span>Đang mở</span></div>
                                        @elseif($ticket->status == 'answered')
                                            <div class="oc-status completed"><span>Đã trả lời</span></div>
                                        @else
                                            <div class="oc-status canceled"><span>Đã đóng</span></div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="ticket-item-bottom">
                                    <div class="tib-first">
                                        <span class="date">
                                            <i class="far fa-calendar-week primary-color"></i>
                                            <strong>{{ $ticket->created_at->format('d/m/Y H:i') }}</strong>
                                        </span>
                                        @if($ticket->priority)
                                            <span class="priority priority-{{ $ticket->priority }}">
                                                <i class="far fa-flag"></i>
                                                @if($ticket->priority == 'high')
                                                    Cao
                                                @elseif($ticket->priority == 'medium')
                                                    Trung bình
                                                @else
                                                    Thấp
                                                @endif
                                            </span>
                                        @endif
                                    </div>
                                    <div class="tib-last">
                                        <a class="btn-ticket" href="{{ route('client.tickets.show', $ticket->id) }}">
                                            <span>Xem</span>
                                            <i class="far fa-angle-right"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <!-- Pagination -->
                            @if($tickets->hasPages())
                            <div class="d-flex justify-content-center mt-4">
                                {{ $tickets->withQueryString()->links() }}
                            </div>
                            @endif
                        @else
                            <div class="text-center py-5">
                                <div class="text-muted">
                                    <i class="far fa-ticket-alt" style="font-size: 48px; margin-bottom: 16px; display: block;"></i>
                                    <h5>Chưa có ticket nào</h5>
                                    <p>Bạn chưa tạo ticket hỗ trợ nào. Hãy tạo ticket mới để được hỗ trợ.</p>
                                    <a href="{{ route('client.tickets.create') }}" class="btn btn-primary">
                                        <i class="far fa-plus"></i> Tạo Ticket Đầu Tiên
                                    </a>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications wrapper -->
    <div id="notify-wrapper" class="alert alert-success hidden" style="display: none;"></div>
</div>

<style>
.priority {
    margin-left: 10px;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 12px;
    font-weight: bold;
}
.priority-high {
    background-color: #dc3545;
    color: white;
}
.priority-medium {
    background-color: #ffc107;
    color: #212529;
}
.priority-low {
    background-color: #6c757d;
    color: white;
}
.new-ticket {
    border-left: 4px solid var(--mc);
}
.new-badge {
    background-color: #dc3545;
    color: white;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 11px;
    position: absolute;
    top: 10px;
    right: 10px;
}
</style>
@endsection
