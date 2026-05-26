<div class="aiz-category-menu bg-white rounded-0 border-top" id="category-sidebar" style="width:270px;">
    <ul class="list-unstyled categories no-scrollbar mb-0 text-left">
        @foreach (\App\Models\Category::with('subcategories')->where('parent_id', 0)->orderBy('order_level', 'desc')->get() as $key => $category)
            @php
                $category_name = $category->getTranslation('name');
                $category_icon = $category->icon ?: static_asset('assets/img/placeholder.jpg');
            @endphp
            <li class="category-nav-element border border-top-0" data-id="{{ $category->id }}">
                <a href="{{ route('products.category', $category->slug) }}"
                    class="text-truncate text-dark px-4 fs-14 d-block hov-column-gap-1">
                    <img class="cat-image mr-2" src="{{ $category_icon }}" width="16" alt="{{ $category_name }}"
                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                    <span class="cat-name has-transition">{{ $category_name }}</span>
                </a>

                @if ($category->subcategories->count())
                    <ul class="list-unstyled mb-2">
                        @foreach ($category->subcategories as $subcategory)
                            @php
                                $subcategory_image = $subcategory->image ?: static_asset('assets/img/placeholder.jpg');
                            @endphp
                            <li>
                                <a href="{{ route('products.subcategory', [$category->slug, $subcategory->slug]) }}"
                                    class="text-truncate text-dark pl-5 pr-4 py-2 fs-13 d-block hov-bg-soft-primary">
                                    <img class="cat-image mr-2" src="{{ $subcategory_image }}" width="16" alt="{{ $subcategory->name }}"
                                        onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                                    {{ $subcategory->getTranslation('name') }}
                                </a>
                            </li>
                        @endforeach
                    </ul>
                @endif

            </li>
        @endforeach
    </ul>
</div>
