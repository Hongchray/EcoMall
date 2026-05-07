<div class="card-columns">
    @forelse ($categories->childrenCategories as $key => $category)
        <div class="card shadow-none border-0">
            <ul class="list-unstyled mb-3">
                <li class="fs-14 fw-700 mb-3">
                    <a class="text-reset hov-text-primary" href="{{ route('products.category', $category->slug) }}">
                        {{ $category->getTranslation('name') }}
                    </a>
                </li>
                @if($category->childrenCategories->count())
                    @foreach ($category->childrenCategories as $key => $child_category)
                        <li class="mb-2 fs-14 pl-2">
                            <a class="text-reset hov-text-primary animate-underline-primary" href="{{ route('products.category', $child_category->slug) }}">
                                {{ $child_category->getTranslation('name') }}
                            </a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    @empty
        <div class="card shadow-none border-0">
            <ul class="list-unstyled mb-3">
                <li class="fs-14 fw-700 mb-3">
                    <a class="text-reset hov-text-primary" href="{{ route('products.category', $categories->slug) }}">
                        {{ $categories->getTranslation('name') }}
                    </a>
                </li>
            </ul>
        </div>
    @endforelse
</div>
