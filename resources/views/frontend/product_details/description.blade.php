<style>
    .ec-description-panel {
        margin-bottom: 24px;
        overflow: hidden;
        border: 1px solid #dceef8;
        border-radius: 16px;
        background: #ffffff;
        box-shadow: 0 14px 36px rgba(34, 126, 184, 0.08);
    }

    .ec-description-tabs {
        gap: 8px;
        padding: 16px 18px 0;
        border-bottom: 1px solid #edf5f9;
        background: linear-gradient(135deg, rgba(60, 155, 211, 0.08), rgba(255, 255, 255, 0));
    }

    .ec-description-tabs a {
        margin: 0 8px 0 0 !important;
        padding: 11px 16px !important;
        border: 1px solid transparent;
        border-bottom: 0;
        border-radius: 10px 10px 0 0;
        color: #667582 !important;
        font-size: 14px !important;
        font-weight: 800 !important;
        text-decoration: none;
        transition: background .2s ease, border-color .2s ease, color .2s ease;
    }

    .ec-description-tabs a:hover,
    .ec-description-tabs a.active {
        border-color: #dceef8;
        background: #ffffff;
        color: #217fb8 !important;
    }

    .ec-description-content {
        padding: 24px;
    }

    .ec-description-copy {
        padding: 22px;
        border: 1px solid #edf5f9;
        border-radius: 14px;
        background: #f8fbfe;
        color: #283744;
        font-size: 15px;
        line-height: 1.8;
    }

    .ec-description-copy p:last-child {
        margin-bottom: 0;
    }

    .ec-description-copy ul,
    .ec-description-copy ol {
        padding-left: 20px;
    }

    .ec-description-copy img {
        max-width: 100%;
        height: auto;
        border-radius: 12px;
    }

    .ec-description-video {
        overflow: hidden;
        border: 1px solid #dceef8;
        border-radius: 14px;
        background: #111820;
    }

    .ec-description-download {
        padding: 36px 20px;
        border: 1px dashed #b9dff2;
        border-radius: 14px;
        background: #f8fbfe;
    }

    .ec-description-download .btn {
        min-height: 44px;
        border: 0;
        border-radius: 8px;
        padding: 11px 22px;
        background: #3c9bd3;
        font-weight: 800;
        box-shadow: 0 10px 22px rgba(60, 155, 211, 0.22);
    }

    @media (max-width: 575.98px) {
        .ec-description-tabs {
            padding: 12px 12px 0;
        }

        .ec-description-tabs a {
            flex: 1 1 auto;
            margin-right: 4px !important;
            padding: 10px 12px !important;
            text-align: center;
        }

        .ec-description-content {
            padding: 14px;
        }

        .ec-description-copy {
            padding: 16px;
            font-size: 14px;
        }
    }
</style>

<div class="ec-description-panel">
    <!-- Tabs -->
    <div class="nav aiz-nav-tabs ec-description-tabs">
        <a href="#tab_default_1" data-toggle="tab"
            class="mr-5 pb-2 fs-16 fw-700 text-reset active show">{{ translate('Description') }}</a>
        @if ($detailedProduct->video_link != null)
            <a href="#tab_default_2" data-toggle="tab"
                class="mr-5 pb-2 fs-16 fw-700 text-reset">{{ translate('Video') }}</a>
        @endif
        @if ($detailedProduct->pdf != null)
            <a href="#tab_default_3" data-toggle="tab"
                class="mr-5 pb-2 fs-16 fw-700 text-reset">{{ translate('Downloads') }}</a>
        @endif
    </div>

    <!-- Description -->
    <div class="tab-content pt-0 ec-description-content">
        <!-- Description -->
        <div class="tab-pane fade active show" id="tab_default_1">
            <div>
                <div class="ec-description-copy mw-100 overflow-hidden text-left aiz-editor-data">
                    <?php echo $detailedProduct->getTranslation('description'); ?>
                </div>
            </div>
        </div>

        <!-- Video -->
        <div class="tab-pane fade" id="tab_default_2">
            <div>
                <div class="ec-description-video embed-responsive embed-responsive-16by9">
                    @if ($detailedProduct->video_provider == 'youtube' && isset(explode('=', $detailedProduct->video_link)[1]))
                        <iframe class="embed-responsive-item"
                            src="https://www.youtube.com/embed/{{ get_url_params($detailedProduct->video_link, 'v') }}"></iframe>
                    @elseif ($detailedProduct->video_provider == 'dailymotion' && isset(explode('video/', $detailedProduct->video_link)[1]))
                        <iframe class="embed-responsive-item"
                            src="https://www.dailymotion.com/embed/video/{{ explode('video/', $detailedProduct->video_link)[1] }}"></iframe>
                    @elseif ($detailedProduct->video_provider == 'vimeo' && isset(explode('vimeo.com/', $detailedProduct->video_link)[1]))
                        <iframe
                            src="https://player.vimeo.com/video/{{ explode('vimeo.com/', $detailedProduct->video_link)[1] }}"
                            width="500" height="281" frameborder="0" webkitallowfullscreen
                            mozallowfullscreen allowfullscreen></iframe>
                    @endif
                </div>
            </div>
        </div>
        
        <!-- Download -->
        <div class="tab-pane fade" id="tab_default_3">
            <div class="ec-description-download text-center">
                <a href="{{ uploaded_asset($detailedProduct->pdf) }}"
                    class="btn btn-primary">{{ translate('Download') }}</a>
            </div>
        </div>
    </div>
</div>
