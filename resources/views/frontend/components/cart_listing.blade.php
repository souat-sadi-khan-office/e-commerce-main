@if(count($items) > 0)
    @foreach($items as $item)
        <li>
            <a href="javascript:;" class="item_remove">
                <i class="ion-close"></i>
            </a>
            <a href="{{ $item->product->slug }}">
                <img src="{{ asset($item->product->thumb_image) }}" alt="{{ $item->product->name }}">
                {{ $item->product->name }}
            </a>
            <span class="cart_quantity"> 
                {{ $item->quantity }} x <span class="cart_amount"> 
                    <span class="price_symbole">$</span></span>{{ $item->price }}
            </span>
        </li>
    @endforeach
@else
    <p>Your cart is empty!</p>
@endif