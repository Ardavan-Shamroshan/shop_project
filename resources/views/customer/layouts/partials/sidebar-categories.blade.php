@forelse($parentCategories as $category)
    <span class="sidebar-nav-item-title">
                <a href="{{ route('customer.products', ['search'=> request()->search, 'sort'=> request()->sort, 'min_price' => request()->min_price, 'max_price' => request()->max_price, 'brands' => request()->brands, 'category' => $category]) }}" class="d-inline">{{ $category->name ?? '-' }}</a>
        @if($category->children->isNotEmpty())
            <i class="fa fa-angle-left"></i>
        @endif
</span>
    @include('customer.layouts.partials.sidebar-subcategories', ['subParentCategories' => $category->children])
@empty
@endforelse


