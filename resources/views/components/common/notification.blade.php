<div>
    @if($detail->is_action_done == '0')
        {{-- No actionable notification types remaining --}}
    @else
        <span class="text-warning fw-bold">Action already performed.</span>
    @endif
</div>
