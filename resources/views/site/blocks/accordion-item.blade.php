<div class="group flex flex-col gap-2 white border border-economic-darkgreen rounded-md p-5 text-black" tabindex="1">
    <div class="flex cursor-pointer items-center justify-between gap-4">
        <i class="fa fa-question-circle text-economic-darkgreen"></i>
        <span class="text-lg font-semibold text-economic-red transition duration-300 ease-in-out hover:text-economic-darkgreen"> {!! $block->content['title'] !!} </span>
        <span
            class="text-center text-3xl h-8 w-8 transition-all duration-500 group-focus:-rotate-180 text-economic-darkgreen">&cudarrl;</span>
    </div>
    <div
        class="invisible h-auto max-h-0 items-center opacity-0 transition-all group-focus:visible group-focus:max-h-screen group-focus:opacity-100 group-focus:duration-1000 border-t border-economic-darkgreen text-lg text-economic-darkgreen pt-1">
        {!! $block->content['content'] !!}
    </div>
</div>
