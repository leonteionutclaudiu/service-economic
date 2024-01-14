@twillBlockTitle('Carousel Item')
@twillBlockIcon('image')
@twillBlockGroup('app')

<x-twill::medias name="16/9" label="Image" note="Se va folosi aspect ratio 3/1" />
<x-twill::input name="description" label="Textul dorit" placeholder="Text" />
<x-twill::input name="link" label="Linkul dorit" placeholder="Link"
    note="Se va pune doar ce este dupa serviceeconomic.ro ( de exemplu /contact )" />
@php
    $options = [
        [
            'value' => 'white',
            'label' => 'Alb',
        ],
        [
            'value' => 'black',
            'label' => 'Negru',
        ],
        [
            'value' => 'green',
            'label' => 'Verde',
        ],
    ];
@endphp

<x-twill::radios name="color" label="Culoare text" default="white" :inline="true" :options="$options" />
