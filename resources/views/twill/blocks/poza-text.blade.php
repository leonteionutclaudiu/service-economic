@twillBlockTitle('Poza Text')
@twillBlockIcon('text')
@twillBlockGroup('app')

<x-twill::medias name="highlight" label="Image" />

<x-twill::wysiwyg name="text" label="Textul dorit" placeholder="Text" :toolbar-options="[
    ['header' => [2, 3, 4, 5, 6, false]],
    'bold',
    'italic',
    'underline',
    'strike',
    'blockquote',
    'code-block',
    'ordered',
    'bullet',
    'hr',
    'code',
    'link',
    'clean',
    'table',
]" />
