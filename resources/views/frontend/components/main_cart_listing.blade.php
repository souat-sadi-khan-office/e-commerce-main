@if(count($items) > 0)
    @foreach($items as $item)
        <div class="item">
            <div class="image">
                <img src="{{ asset($item->product->thumb_image) }}" alt="{{ $item->product->name }}" width="47" height="47">
            </div>
            <div class="info">
                <div class="name">
                    {{ $item->product->name }}
                </div>
                <span class="amount">{{ $item->price }}</span>
                <i class="fas fa-times"></i>
                <span>{{ $item->quantity }} </span>
                <span class="eq">=</span>
                <span class="total">{{ $item->quantity * $item->price }}</span>
            </div>

            <div class="remove-item-from-cart" data-id="{{ $item->id }}" data-bs-toggle="tooltip" data-bs-placement="Top" title="Remove">
                <i class="fas fa-trash"></i>
            </div>
        </div>
    @endforeach
@else
    <div class="empty-content">
        <p class="text-center">Your shopping cart is empty!</p>
    </div>
@endif    