<swiper-container class="relative w-full mx-auto mb-6 h-fit" pagination="true" pagination-clickable="true"
    space-between="30" centered-slides="true" autoplay-delay="5000" autoplay-disable-on-interaction="false" effect="fade">
    {!! $renderData->renderChildren('carousel-item') !!}
</swiper-container>
