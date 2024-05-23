<div>
    @if($detail->is_action_done == '0')
        @switch($detail->message_tag)
            @case('msg.new_member_request')
                <a href="{{ route('dashboard.notification.action', ['action' => encrypt(['id' => $detail->id, 'status' => '1'])]) }}" class="btn btn-success text-white">Accept</a>
                <a href="{{ route('dashboard.notification.action', ['action' => encrypt(['id' => $detail->id, 'status' => '-1'])]) }}" class="btn btn-default text-danger">Reject</a>
            @break
        @endswitch
    @else
        <span class="text-warning fw-bold">Action already performed.</span>
    @endif
</div>
