<section class="item">
    <section class="lazyload-item-wrapper">
        <section class="product">
            <section class="product-add-to-cart">
                <a href="#" data-bs-toggle="tooltip" data-bs-placement="left" title="افزودن به سبد خرید"><i class="fa fa-cart-plus"></i></a>
            </section>

            @auth
                @if($relatedProduct->users->contains(auth()->user()->id))
                    <section class="product-add-to-favorite">
                        <button data-bs-toggle="tooltip" data-bs-placement="left" title="حذف از علاقه مندی" data-url="{{ route('customer.market.product.add-to-favorite', $relatedProduct) }}">
                            <i class="fa fa-heart text-danger"></i></button>
                    </section>
                @else
                    <section class="product-add-to-favorite">
                        <button data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه از علاقه مندی" data-url="{{ route('customer.market.product.add-to-favorite', $relatedProduct) }}">
                            <i class="fa fa-heart"></i></button>
                    </section>
                @endif
            @endauth
            @guest
                <section class="product-add-to-favorite">
                    <button data-bs-toggle="tooltip" data-bs-placement="left" title="اضافه از علاقه مندی" data-url="{{ route('customer.market.product.add-to-favorite', $relatedProduct) }}">
                        <i class="fa fa-heart"></i></button>
                </section>
            @endguest

            <a class="product-link" href="{{ route('customer.market.product', $relatedProduct) }}">

                <section class="product-image">
                    <img class="" src="{{ asset($relatedProduct->image['indexArray'][$relatedProduct->image['currentImage']]) }}" alt="{{ $relatedProduct->title }}">
                </section>
                <section class="product-colors"></section>
                <section class="product-name">
                    <h3>{{ $relatedProduct->name }}</h3>
                </section>

                @if (!empty($relatedProduct->activeAmazingSales()))
                    @php
                        $amazingSaleProductPrice = ($relatedProduct->price * $relatedProduct->activeAmazingSales()->percentage) / 100;
                    @endphp
                    <section class="product-price-wrapper">
                        <section class="product-discount">
                            <span class="product-old-price text-decoration-line-through">{{ priceFormat($relatedProduct->price) }} </span>
                            <span class="product-discount-amount">{{ discountFormat($relatedProduct->activeAmazingSales()->percentage) }}</span>
                        </section>
                        <section class="product-price content-header-title">{{ priceFormat($relatedProduct->price - $amazingSaleProductPrice) }}</section>
                    </section>
                @else
                    <section class="product-price-wrapper">
                        <section class="product-price content-header-title">{{ priceFormat($relatedProduct->price) }}</section>
                    </section>
                @endif

                <section class="product-colors">
                    @if ($relatedProduct->colors->isNotEmpty())
                        @forelse ($relatedProduct->colors as $key => $color)
                            <section class="product-colors-item" style="background-color: {{ $color->color ?? '#fff' }};;"></section>
                        @empty @endforelse
                    @endif
                </section>
            </a>
        </section>
    </section>
</section>
