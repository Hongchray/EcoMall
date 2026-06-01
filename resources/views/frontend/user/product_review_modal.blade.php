<style>
    .ec-review-modal {
        border: 0;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 24px 70px rgba(15, 23, 42, .24);
    }

    .ec-review-modal-dialog {
        max-width: 520px;
    }

    .ec-review-modal .modal-header {
        padding: 18px 24px;
        border-bottom: 1px solid #e8eef5;
    }

    .ec-review-modal .modal-title {
        color: #071429;
        font-size: 18px;
        font-weight: 700;
    }

    .ec-review-modal__close {
        width: 34px;
        height: 34px;
        margin-left: auto;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border: 0;
        border-radius: 50%;
        background: transparent;
        color: #6b7280;
        font-size: 28px;
        font-weight: 300;
        line-height: 1;
        opacity: 1;
        cursor: pointer;
        transition: background .2s ease, color .2s ease;
    }

    .ec-review-modal__close:hover,
    .ec-review-modal__close:focus {
        background: #f1f5f9;
        color: #111827;
        outline: none;
    }

    .ec-review-modal__body {
        padding: 22px 24px 8px;
    }

    .ec-review-field {
        margin-bottom: 20px;
    }

    .ec-review-label {
        margin-bottom: 8px;
        display: block;
        color: #6b7280;
        font-size: 13px;
        font-weight: 600;
    }

    .ec-review-product {
        margin: 0;
        color: #071429;
        font-size: 15px;
        font-weight: 600;
    }

    .ec-review-rating.rating-input {
        display: inline-flex;
        flex-direction: row-reverse;
        gap: 3px;
    }

    .ec-review-rating.rating-input label {
        margin: 0;
        cursor: pointer;
    }

    .ec-review-rating.rating-input i {
        color: #c8ced6;
        font-size: 24px;
        transition: color .15s ease, transform .15s ease;
    }

    .ec-review-rating.rating-input label:hover i,
    .ec-review-rating.rating-input label:hover ~ label i,
    .ec-review-rating.rating-input input:checked ~ i {
        color: #f5a400;
    }

    .ec-review-rating.rating-input label:hover i {
        transform: translateY(-1px);
    }

    .ec-review-textarea {
        min-height: 118px;
        padding: 14px 16px;
        border: 1px solid #d8e1ea;
        border-radius: 8px;
        color: #111827;
        resize: vertical;
    }

    .ec-review-textarea:focus {
        border-color: #3498d3;
        box-shadow: 0 0 0 3px rgba(52, 152, 211, .12);
    }

    .ec-review-upload .input-group-text,
    .ec-review-upload .file-amount {
        min-height: 44px;
        border-color: #d8e1ea;
    }

    .ec-review-upload .input-group-text {
        border-radius: 8px 0 0 8px !important;
        background: #f6f9fc;
        color: #536173;
    }

    .ec-review-upload .file-amount {
        border-radius: 0 8px 8px 0 !important;
        color: #7b8494;
    }

    .ec-review-help {
        margin-top: 6px;
        display: block;
        color: #7b8494;
        font-size: 12px;
    }

    .ec-review-modal .modal-footer {
        padding: 18px 24px;
        border-top: 1px solid #e8eef5;
        gap: 10px;
    }

    .ec-review-btn {
        min-width: 120px;
        padding: 11px 18px;
        border-radius: 6px;
        font-weight: 700;
    }

    .ec-review-btn--cancel {
        border: 1px solid #d8e1ea;
        background: #f6f7fb;
        color: #4b5563;
    }

    .ec-review-btn--submit {
        border: 1px solid #3498d3;
        background: #3498d3;
        color: #fff;
    }

    .ec-review-btn--submit:hover {
        background: #2387c4;
        color: #fff;
    }

    .ec-review-existing {
        padding: 22px 24px 24px;
    }

    .ec-review-existing__comment {
        padding: 14px 16px;
        border-radius: 8px;
        background: #f8fbfd;
        color: #334155;
    }
</style>

<div class="ec-review-modal">
    <div class="modal-header">
        <h5 class="modal-title">{{ translate('Review') }}</h5>
        <button type="button" class="ec-review-modal__close" data-dismiss="modal" data-bs-dismiss="modal"
            onclick="$('#product-review-modal').modal('hide');" aria-label="{{ translate('Close') }}">
            <span aria-hidden="true">×</span>
        </button>
    </div>

    @if ($review == null)
        <!-- Add new review -->
        <form action="{{ route('reviews.store') }}" method="POST">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <div class="modal-body ec-review-modal__body">
                <div class="ec-review-field">
                    <label class="ec-review-label">{{ translate('Product') }}</label>
                    <p class="ec-review-product">{{ $product->getTranslation('name') }}</p>
                </div>

                <!-- Rating -->
                <div class="ec-review-field">
                    <label class="ec-review-label">{{ translate('Rating') }}</label>
                    <div class="rating rating-input ec-review-rating">
                        @for ($i = 5; $i >= 1; $i--)
                            <label>
                                <input type="radio" name="rating" value="{{ $i }}" @if ($i == 1) required @endif>
                                <i class="las la-star"></i>
                            </label>
                        @endfor
                    </div>
                </div>

                <!-- Comment -->
                <div class="ec-review-field">
                    <label class="ec-review-label">{{ translate('Comment') }}</label>
                    <textarea class="form-control ec-review-textarea" rows="4" name="comment"
                        placeholder="{{ translate('Your review') }}" required></textarea>
                </div>

                <!-- Review Images -->
                <div class="ec-review-field">
                    <label class="ec-review-label" for="photos">{{ translate('Review Images') }}</label>
                    <div class="ec-review-upload">
                        <div class="input-group" data-toggle="aizuploader" data-type="image" data-multiple="true">
                            <div class="input-group-prepend">
                                <div class="input-group-text font-weight-medium">{{ translate('Browse') }}</div>
                            </div>
                            <div class="form-control file-amount">{{ translate('Choose File') }}</div>
                            <input type="hidden" name="photos[]" class="selected-files">
                        </div>
                        <div class="file-preview box sm"></div>
                        <small class="ec-review-help">{{ translate('These images are visible in product review page gallery. Upload square images') }}</small>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn ec-review-btn ec-review-btn--cancel" data-dismiss="modal"
                    data-bs-dismiss="modal" onclick="$('#product-review-modal').modal('hide');">{{ translate('Cancel') }}</button>
                <button type="submit" class="btn ec-review-btn ec-review-btn--submit">{{ translate('Submit review') }}</button>
            </div>
        </form>
    @else
        <!-- Existing review -->
        <div class="ec-review-existing">
            <div class="ec-review-field">
                <label class="ec-review-label">{{ translate('Rating') }}</label>
                <p class="rating rating-sm mb-0">
                    @for ($i = 0; $i < $review->rating; $i++)
                        <i class="las la-star active"></i>
                    @endfor
                    @for ($i = 0; $i < 5 - $review->rating; $i++)
                        <i class="las la-star"></i>
                    @endfor
                </p>
            </div>
            <div class="ec-review-field">
                <label class="ec-review-label">{{ translate('Comment') }}</label>
                <div class="ec-review-existing__comment">{{ $review->comment }}</div>
            </div>
            @if ($review->photos != null)
                <div class="ec-review-field mb-0">
                    <label class="ec-review-label">{{ translate('Images') }}</label>
                    <div class="d-flex flex-wrap">
                        @foreach (explode(',', $review->photos) as $photo)
                            <div class="mr-3 mb-3 size-90px">
                                <img class="img-fit h-100 lazyload border rounded"
                                    src="{{ static_asset('assets/img/placeholder.jpg') }}"
                                    data-src="{{ uploaded_asset($photo) }}"
                                    onerror="this.onerror=null;this.src='{{ static_asset('assets/img/placeholder.jpg') }}';">
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    @endif
</div>
