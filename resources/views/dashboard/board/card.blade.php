<div class="bg-gray-div p-4 rounded-10 border border-grey">
    <h4 class="fs-16 fw-semibold body-font mb-2">{{ $item->title }}</h4>
    <span class="fs-14 fw-semibold d-block mb-3 text-gray-dark">{{ $item->slug }}</span>
    <div class="d-flex justify-content-between align-items-center">
        <span class="text-muted">{{ $item->created_at->format('j F, Y') }}</span>
        <ul class="ps-0 mb-0 list-unstyled d-flex">
            <li>
                <img src="{{ $item->reporter->profile }}" class="wh-25 rounded-circle border border-dark" alt="{{ $item->reporter->name }}">
            </li>
            <li class="ms-8">
                <img src="{{ $item->assignee->profile }}" class="wh-25 rounded-circle border border-dark" alt="{{ $item->assignee->name }}">
            </li>
        </ul>
    </div>
</div>
