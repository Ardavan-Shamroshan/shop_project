<aside id="sidebar" class="sidebar col-md-3">
    <form action="{{ route('customer.products', request()->category) }}" method="get">

        <input type="hidden" name="sort" value="{{ request()->sort }}">

        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
            <!-- start sidebar nav-->
            <section class="sidebar-nav">
                <section class="sidebar-nav-item">
                    @include('customer.layouts.partials.sidebar-categories', ['parentCategories' => $parentCategories])
                </section>
            </section>
            <!--end sidebar nav-->
        </section>

        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
            <section class="content-header mb-3">
                <section class="d-flex justify-content-between align-items-center">
                    <h2 class="content-header-title content-header-title-small">
                        جستجو در نتایج
                    </h2>
                    <section class="content-header-link">
                        <!--<a href="#">مشاهده همه</a>-->
                    </section>
                </section>
            </section>

            <section class="">
                <input class="sidebar-input-text" type="text" placeholder="جستجو بر اساس نام، برند ..." name="search" value="{{ request()->search }}">
            </section>
        </section>

        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
            <section class="content-header mb-3">
                <section class="d-flex justify-content-between align-items-center">
                    <h2 class="content-header-title content-header-title-small">
                        برند
                    </h2>
                    <section class="content-header-link">
                        <!--<a href="#">مشاهده همه</a>-->
                    </section>
                </section>
            </section>

            <section class="sidebar-brand-wrapper">
                @forelse($brands as $brand)
                    <section class="form-check sidebar-brand-item">
                        <input class="form-check-input" type="checkbox" name="brands[]" value="{{ $brand->id }}" id="brand_{{ $brand->id }}"
                                @checked(request()->has('brands') && in_array($brand->id, request()->brands))
                        >
                        <label class="form-check-label d-flex justify-content-between" for="brand_{{ $brand->id }}">
                            <span>{{ $brand->persian_name ?? '-' }}</span>
                            <span>{{ $brand->original_name ?? '-' }}</span>
                        </label>
                    </section>
                @empty
                @endforelse
            </section>
        </section>


        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
            <section class="content-header mb-3">
                <section class="d-flex justify-content-between align-items-center">
                    <h2 class="content-header-title content-header-title-small">
                        محدوده قیمت
                    </h2>
                    <section class="content-header-link">
                        <!--<a href="#">مشاهده همه</a>-->
                    </section>
                </section>
            </section>
            <section class="sidebar-price-range d-flex justify-content-between">
                <section class="p-1"><input type="text" placeholder="قیمت از ..." name="min_price" value="{{ request()->min_price }}"></section>
                <section class="p-1"><input type="text" placeholder="قیمت تا ..." name="max_price" value="{{ request()->max_price }}"></section>
            </section>
        </section>

        <section class="content-wrapper bg-white p-3 rounded-2 mb-3">
            <section class="sidebar-filter-btn d-grid gap-2">
                <button class="btn btn-danger" type="submit">اعمال فیلتر</button>
            </section>
        </section>

    </form>


</aside>
