<div class="p-6 border border-economic-darkgreen rounded-lg w-full max-w-7xl mx-auto transition duration-300 shadow-md hover:shadow-lg wow animate__animated animate__fadeIn">
    <p class="text-2xl font-bold uppercase text-economic-darkgreen max-w-[75ch]">{!! $block->content['title'] !!}</p>
    <p class="block mb-6 max-w-[75ch] px-2">{!! $block->content['job'] !!}</p>
    <button @click="contactModalForm = true" class="block px-6 py-3 border border-economic-darkgreen w-fit rounded-full text-economic-darkgreen font-bold transition duration-300 ease-out hover:text-economic-red hover:border-economic-red cursor-pointer">Contacteaza-ne acum &nearhk;</button>
</div>
